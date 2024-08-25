<?php

namespace App\Livewire\DataTable;
use App\Models\Budget;
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
    public $dvNum, $accountID, $programID, $controllerID, $drnNum, $incomingDate,
    $payee, $particulars, $etal, $program, $controller, $gross_amount,
    $final_amount_norsa, $fund_cluster, $appropriation, $remarks, $orsNum,
    $outgoingDate, $status;

    protected $rules = [
        'dvNum' => 'required|string|max:10',
        'accountID' => 'required|string|max:20',
        'programID' => 'required|integer',
        'controllerID' => 'required|integer',
        'drnNum' => 'required|string|max:100',
        'incomingDate' => 'required|date',
        'payee' => 'required|string|max:150',
        'particulars' => 'required|string|max:250',
        'etal' => 'nullable|string|max:250',
        'program' => 'required|string|max:30',
        'controller' => 'required|string|max:75',
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
            'dvNum' => $this->dvNum,
            'accountID' => $this->accountID,
            'programID' => $this->programID,
            'controllerID' => $this->controllerID,
            'drnNum' => $this->drnNum,
            'incomingDate' => $this->incomingDate,
            'payee' => $this->payee,
            'particulars' => $this->particulars,
            'etal' => $this->etal,
            'program' => $this->program,
            'controller' => $this->controller,
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
        $this->dvNum = '';
        $this->accountID = '';
        $this->programID = '';
        $this->controllerID = '';
        $this->drnNum = '';
        $this->incomingDate = '';
        $this->payee = '';
        $this->particulars = '';
        $this->etal = '';
        $this->program = '';
        $this->controller = '';
        $this->gross_amount = '';
        $this->final_amount_norsa = '';
        $this->fund_cluster = '';
        $this->appropriation = '';
        $this->remarks = '';
        $this->orsNum = '';
        $this->outgoingDate = '';
        $this->status = '';
    }

    public function render()
    {
        $budgetRecords = Budget::where('dvNum', 'like', '%' . $this->search . '%')
            ->orWhere('payee', 'like', '%' . $this->search . '%')
            ->orWhere('drnNum', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.data-table.budget-data-table', [
            'budgetRecords' => $budgetRecords
        ]);
    }
}
