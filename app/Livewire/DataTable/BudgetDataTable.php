<?php

namespace App\Livewire\DataTable;

use App\Models\Budget;
use App\Models\Accounting;
use App\Models\DvInventoryBudgetProcessed;
use App\Models\Programs;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\DvInventory;
use App\Models\ActivityLog;


#[Layout('layouts.app')]
class BudgetDataTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = '10';

    // Form inputs
    public $transaction_no, $drn_no, $incomingDate, $payee, $particulars, $etal, $program, $budget_controller, $gross_amount,
    $final_amount_norsa, $fund_cluster, $appropriation, $remarks, $orsNum,
    $outgoingDate, $status;

    // Properties for editing
    public $isEditing = false;
    public $editId;

    // Sorting
    public $sortField = 'drn_no'; // Default sort field
    public $sortDirection = 'desc'; // Default sort direction

    public $programs; // Holds the list of programs

    public function mount()
    {
        // Fetch the programs when the component is initialized
        $this->programs = Programs::all(); // Retrieves all program entries from the 'programs' table
    }

    protected $rules = [
        'transaction_no' => 'nullable|unique:budget,transaction_no',
        'drn_no' => 'required|string|max:30',
        'incomingDate' => 'required|date',
        'payee' => 'required|string|max:150',
        'particulars' => 'required|string|max:250',
        'program' => 'required|string|max:30',
        'budget_controller' => 'required|string|max:75',
        'gross_amount' => 'required|numeric|min:0',
        'final_amount_norsa' => 'nullable|numeric|',
        'fund_cluster' => 'required|string|max:50',
        'appropriation' => 'required|string|max:50',
        'remarks' => 'nullable|string',
        'orsNum' => 'required|string|max:20',
        'outgoingDate' => 'required|date',
        'status' => 'required|string|max:30',
    ];

    public function saveEntry()
    {
        $this->validate();

        $action = $this->isEditing ? 'Updated' : 'Created';

        if ($this->isEditing) {
            // Update existing record
            $entry = Budget::findOrFail($this->editId);
            $entry->update([
                'drn_no' => $this->drn_no,
                'incomingDate' => $this->incomingDate,
                'payee' => $this->payee,
                'particulars' => $this->particulars,
                'program' => $this->program,
                'budget_controller' => $this->budget_controller,
                'gross_amount' => $this->gross_amount,
                'final_amount_norsa' => $this->final_amount_norsa ?: null, // handle empty value
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
                $action = 'Sent to Accounting'; 
                $this->sendToAccounting($entry->transaction_no);
            }
        } else {

            $transaction_no = $this->generateUniqueTransactionNo();

            // Create new record
            $entry = Budget::create([
                'transaction_no' => $transaction_no,
                'drn_no' => $this->drn_no,
                'incomingDate' => $this->incomingDate,
                'payee' => $this->payee,
                'particulars' => $this->particulars,
                'program' => $this->program,
                'budget_controller' => $this->budget_controller,
                'gross_amount' => $this->gross_amount,
                'final_amount_norsa' => $this->final_amount_norsa?: null, // handle empty value
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
                $action = 'has sent to accounting'; 
                $this->sendToAccounting($entry->transaction_no);
            }

        }

        // Log the action
        ActivityLog::create([
            'user_id' => auth()->id(),
            'section' => 'Budget',
            'user_name' => auth()->user()->name,
            'dv_no' => $entry->orsNum,
            'dswd_id' => auth()->user()->dswd_id,
            'action' => $action,
            'details' => "User {$action} a budget entry with ORS Number: {$entry->orsNum}",
    ]);

        $this->resetInputFields();
        $this->dispatch('entry-saved');
    }

    protected function generateUniqueTransactionNo()
    {
        do {
            $transaction_no = mt_rand(100000, 999999); // Generate a 6-digit number
        } while (Budget::where('transaction_no', $transaction_no)->exists());

        return $transaction_no;
    }

    public function resetInputFields()
    {
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

    public function sendToAccounting($transaction_no)
    {
        // Find the Budget record by its ID
        $budgetRecord = Budget::findOrFail($transaction_no);

        $existingAccountingRecord = Accounting::where('transaction_no', $budgetRecord->transaction_no)->first();

        if ($existingAccountingRecord) {
            // Flash a message indicating that this DV number has already been sent to Cash
            session()->flash('error', 'This DV has already been sent to Accounting.');
            return;
        }
        // Create a new Accounting record with data from the Budget record
        Accounting::create([
            'transaction_no' => $budgetRecord->transaction_no,
            'date_received' => now(), // Current date when sent to accounting
            'program' => $budgetRecord->program,
            'gross_amount' => $budgetRecord->gross_amount,
            'remarks' => $budgetRecord->remarks,
            'payee' => $budgetRecord->payee,
            'orsNum' => $budgetRecord->orsNum,
            'particulars' => $budgetRecord->particulars,
            'appropriation' => $budgetRecord->appropriation,
            'status' => 'Sent from Budget', // Optional action field
            // Add other fields as necessary
        ]);

        // Update the status of the Budget record
        $budgetRecord->update([
            'status' => 'Sent to Accounting',
            'outgoingDate' => now(),
        ]);

        $this->dvbudgetinventory($budgetRecord->transaction_no);

        session()->flash('message', 'DV sent to Accounting successfully.');
    }

    public function dvbudgetinventory($transaction_no)
    {
          // Find the cash record
        $budgetRecord = Budget::findOrFail($transaction_no);

        // Check if the transaction_no already exists in the dv_inventory table
        $existingDvInventory = DvInventoryBudgetProcessed::where('transaction_no', $budgetRecord->transaction_no)->first();

        if ($existingDvInventory) {
            // If the transaction_no already exists, skip the counting to avoid duplicates
            return;
        }

        // but ensure the transaction_no is unique
        DvInventoryBudgetProcessed::create([
            'program' => $budgetRecord->program,
            'no_of_processed_dv' => 1,  // Since this is a new entry, set it to 1
            'total_amount_processed' => $budgetRecord->gross_amount,
            'transaction_no' => $budgetRecord->transaction_no,  // Store the transaction_no to track this entry
        ]);
    }


    public function edit($transaction_no)
    {
        $budget = Budget::findOrFail($transaction_no);

        // Only allow editing if the status is 'Returned from Accounting'

        // Set the properties to the values of the record being edited
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

        $this->editId = $transaction_no;
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

    #[On('refresh-budget')]
    public function render()
    {
        $programs = DvInventory::all();
        
        $budgetRecords = Budget::where('orsNum', 'like', '%' . $this->search . '%')
            ->orWhere('payee', 'like', '%' . $this->search . '%')
            ->orWhere('drn_no', 'like', '%' . $this->search . '%')
            ->orWhere('program', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection) // Apply sorting
            ->paginate($this->perPage);

        return view('livewire.data-table.budget-data-table', [
            'budgetRecords' => $budgetRecords,
        ]);
    }
}
