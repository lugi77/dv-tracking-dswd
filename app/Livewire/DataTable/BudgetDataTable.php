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

    public $isEditing = false;
    public $entryId;

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

    public function saveEntry()
    {
        $this->validate();

        Budget::create([
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

        $this->resetInputFields();

        // dispatch event to close the modal
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

public function render()
{
    $budgetRecords = Budget::where('dv_no', 'like', '%' . $this->search . '%')
        ->orWhere('payee', 'like', '%' . $this->search . '%')
        ->orWhere('drn_no', 'like', '%' . $this->search . '%')
        ->paginate($this->perPage);

    return view('livewire.data-table.budget-data-table', [
        'budgetRecords' => $budgetRecords,
    ]);
}

}
