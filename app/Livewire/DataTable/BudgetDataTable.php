<?php

namespace App\Livewire\DataTable;

use App\Models\Budget;
use App\Models\Accounting;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Component;

#[Layout('layouts.app')]
class BudgetDataTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = '10';

    // Form inputs
    public $dv_no, $drn_no, $incomingDate,
    $payee, $particulars, $etal, $program, $budget_controller, $gross_amount,
    $final_amount_norsa, $fund_cluster, $appropriation, $remarks, $orsNum,
    $outgoingDate, $status;

    // Properties for editing
    public $isEditing = false;
    public $editId;

     // Sorting
    public $sortField = 'dv_no'; // Default sort field
    public $sortDirection = 'asc'; // Default sort direction

    protected $rules = [
        'dv_no' => 'required|string|max:10',
        'drn_no' => 'required|string|max:100',
        'incomingDate' => 'required|date',
        'payee' => 'required|string|max:150',
        'particulars' => 'required|string|max:250',
        'program' => 'required|string|max:30',
        'budget_controller' => 'required|string|max:75',
        'gross_amount' => 'required|numeric|min:0',
        'final_amount_norsa' => 'required|numeric|min:0',
        'fund_cluster' => 'required|string|max:50',
        'appropriation' => 'required|string|max:50',
        'remarks' => 'nullable|string|max:250',
        'orsNum' => 'required|string|max:50',
        'outgoingDate' => 'required|date',
        'status' => 'required|string|max:50',
    ];
    protected $listeners = ['dataSentBackToBudget' => '$refresh'];

    public function refreshTable()
    {
        // Optionally flash a message for visual feedback
        session()->flash('message', 'New data has been received from Accounting.');

        // Refresh the table by fetching the latest data
        $this->budgetRecords = Budget::all(); // Adjust this to your data fetching logic
    }

     // Toggle sorting direction

    public function saveEntry()
    {
        $this->validate();

        if ($this->isEditing) {
            // Update existing record
            $entry = Budget::findOrFail($this->editId);
            $entry->update([
                'dv_no' => $this->dv_no,
                'drn_no' => $this->drn_no,
                'incomingDate' => $this->incomingDate,
                'payee' => $this->payee,
                'particulars' => $this->particulars,
                'program' => $this->program,
                'budget_controller' => $this->budget_controller,
                'gross_amount' => $this->gross_amount,
                'final_amount_norsa' => $this->final_amount_norsa,
                'fund_cluster' => $this->fund_cluster,
                'appropriation' => $this->appropriation,
                'remarks' => $this->remarks,
                'orsNum' => $this->orsNum,
                'outgoingDate' => $this->outgoingDate,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Entry Updated Successfully.');

            // Check if status is "FORWARD TO ACCOUNTING" and send the data
            if ($this->status === 'Forward to Accounting') {
                $this->sendToAccounting($entry->id);
            }
        } else {
            // Create new record
            $entry = Budget::create([
                'dv_no' => $this->dv_no,
                'drn_no' => $this->drn_no,
                'incomingDate' => $this->incomingDate,
                'payee' => $this->payee,
                'particulars' => $this->particulars,
                'program' => $this->program,
                'budget_controller' => $this->budget_controller,
                'gross_amount' => $this->gross_amount,
                'final_amount_norsa' => $this->final_amount_norsa,
                'fund_cluster' => $this->fund_cluster,
                'appropriation' => $this->appropriation,
                'remarks' => $this->remarks,
                'orsNum' => $this->orsNum,
                'outgoingDate' => $this->outgoingDate,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Entry Saved Successfully.');

            // Check if status is "FORWARD TO ACCOUNTING" and send the data
            if ($this->status === 'Forward to Accounting') {
                $this->sendToAccounting($entry->id);
            }
            
        }
        $this->resetInputFields();
        $this->dispatch('entry-saved');
    }

    public function resetInputFields()
    {
        $this->dv_no = '';
        $this->drn_no = '';
        $this->incomingDate = '';
        $this->payee = '';
        $this->particulars = '';
        $this->program = '';
        $this->budget_controller = '';
        $this->gross_amount = '';
        $this->final_amount_norsa = '';
        $this->fund_cluster = '';
        $this->appropriation = '';
        $this->remarks = '';
        $this->orsNum = '';
        $this->outgoingDate = '';
        $this->status = '';
        $this->isEditing = false;
        $this->editId = null;
    }
    
    public function sendToAccounting($id)
    {
        // Find the Budget record by its ID
        $budgetRecord = Budget::findOrFail($id);

        $existingAccountingRecord = Accounting::where('dv_no', $budgetRecord->dv_no)->first();

        if ($existingAccountingRecord) {
            // Flash a message indicating that this DV number has already been sent to Cash
            session()->flash('error', 'This DV has already been sent to Accounting.');
            return;
        }

        // Create a new Accounting record with data from the Budget record
        Accounting::create([
            'date_received' => now(), // Current date when sent to accounting
            'dv_no' => $budgetRecord->dv_no,
            'program' => $budgetRecord->program,
            'gross_amount' => $budgetRecord->gross_amount,
            'net_amount' => $budgetRecord->final_amount_norsa, // Assuming final_amount_norsa as net_amount
            'remarks' => $budgetRecord->remarks,
            'status' => $budgetRecord->status, // Optional action field
            // Add other fields as necessary
        ]);

        // Update the status of the Budget record
        $budgetRecord->update([
            'status' => 'Sent to Accounting',
            'outgoingDate' => now(),
        ]);

        session()->flash('message', 'DV sent to Accounting successfully.');
    }

    public function edit($id)
    {
        $budget = Budget::findOrFail($id);

        // Only allow editing if the status is 'Returned from Accounting'
    if ($budget->status !== 'Returned from Accounting') {
        session()->flash('error', 'This entry cannot be edited because it has not been returned from Accounting.');
        return;
    }

        // Set the properties to the values of the record being edited
        $this->dv_no = $budget->dv_no;
        $this->drn_no = $budget->drn_no;
        $this->incomingDate = $budget->incomingDate;
        $this->payee = $budget->payee;
        $this->particulars = $budget->particulars;
        $this->program = $budget->program;
        $this->budget_controller = $budget->budget_controller;
        $this->gross_amount = $budget->gross_amount;
        $this->final_amount_norsa = $budget->final_amount_norsa;
        $this->fund_cluster = $budget->fund_cluster;
        $this->appropriation = $budget->appropriation;
        $this->remarks = $budget->remarks;
        $this->orsNum = $budget->orsNum;
        $this->outgoingDate = $budget->outgoingDate;
        $this->status = $budget->status;
        
        $this->editId = $id;
        $this->isEditing = true;

        // Open the modal for editing
        $this->dispatch('open-edit-modal');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc'; // Reset to asc when switching fields
        }

        $this->sortField = $field;
    }


    public function render()
    {
        $budgetRecords = Budget::where('dv_no', 'like', '%' . $this->search . '%')
            ->orWhere('payee', 'like', '%' . $this->search . '%')
            ->orWhere('dv_no', 'like', '%' . $this->search . '%')
            ->orWhere('program', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection) // Apply sorting
            ->paginate($this->perPage);

        return view('livewire.data-table.budget-data-table', [
            'budgetRecords' => $budgetRecords,
        ]);
    }
}
