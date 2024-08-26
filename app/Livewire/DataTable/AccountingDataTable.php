<?php

namespace App\Livewire\DataTable;

use App\Models\Accounting;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class AccountingDataTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 50;

    // Form inputs
    public $date_received;
    public $dvNum;
    public $dvNum2;
    public $ap_no;
    public $gross_amount;
    public $tax;
    public $other_deduction;
    public $net_amount;
    public $final_gross_amount;
    public $final_net_amount;
    public $program_unit;
    public $date_returned_to_end_user;
    public $date_compiled_to_end_user;
    public $no_of_days;
    public $outgoing_processor;
    public $outgoing_certifier;
    public $remarks;
    public $outgoing_date;
    public $action;

    public $isEditing = false;
    public $entryId;

    protected $rules = [
        'date_received' => 'required|date',
        'dvNum' => 'required|string',
        'dvNum2' => 'nullable|string',
        'ap_no' => 'nullable|string',
        'gross_amount' => 'required|numeric',
        'tax' => 'nullable|numeric',
        'other_deduction' => 'nullable|numeric',
        'net_amount' => 'required|numeric',
        'final_gross_amount' => 'nullable|numeric',
        'final_net_amount' => 'nullable|numeric',
        'program_unit' => 'nullable|string',
        'date_returned_to_end_user' => 'nullable|date',
        'date_compiled_to_end_user' => 'nullable|date',
        'no_of_days' => 'nullable|integer',
        'outgoing_processor' => 'nullable|string',
        'outgoing_certifier' => 'nullable|string',
        'remarks' => 'nullable|string',
        'outgoing_date' => 'nullable|date',
        'action' => 'nullable|string',
    ];

    public function saveEntry()
    {
        $this->validate();

        if ($this->isEditing) {
            // Update existing entry
            $entry = Accounting::find($this->entryId);

            $entry->update([
                'date_received' => $this->date_received,
                'dvNum' => $this->dvNum,
                'dvNum2' => $this->dvNum2,
                'ap_no' => $this->ap_no,
                'gross_amount' => $this->gross_amount,
                'tax' => $this->tax,
                'other_deduction' => $this->other_deduction,
                'net_amount' => $this->net_amount,
                'final_gross_amount' => $this->final_gross_amount,
                'final_net_amount' => $this->final_net_amount,
                'program_unit' => $this->program_unit,
                'date_returned_to_end_user' => $this->date_returned_to_end_user,
                'date_compiled_to_end_user' => $this->date_compiled_to_end_user,
                'no_of_days' => $this->no_of_days,
                'outgoing_processor' => $this->outgoing_processor,
                'outgoing_certifier' => $this->outgoing_certifier,
                'remarks' => $this->remarks,
                'outgoing_date' => $this->outgoing_date,
                'action' => $this->action,
            ]);

            session()->flash('message', 'Entry updated successfully.');
        } else {
            // Create a new entry
            Accounting::create([
                'date_received' => $this->date_received,
                'dvNum' => $this->dvNum,
                'dvNum2' => $this->dvNum2,
                'ap_no' => $this->ap_no,
                'gross_amount' => $this->gross_amount,
                'tax' => $this->tax,
                'other_deduction' => $this->other_deduction,
                'net_amount' => $this->net_amount,
                'final_gross_amount' => $this->final_gross_amount,
                'final_net_amount' => $this->final_net_amount,
                'program_unit' => $this->program_unit,
                'date_returned_to_end_user' => $this->date_returned_to_end_user,
                'date_compiled_to_end_user' => $this->date_compiled_to_end_user,
                'no_of_days' => $this->no_of_days,
                'outgoing_processor' => $this->outgoing_processor,
                'outgoing_certifier' => $this->outgoing_certifier,
                'remarks' => $this->remarks,
                'outgoing_date' => $this->outgoing_date,
                'action' => $this->action,
            ]);

            session()->flash('message', 'Entry created successfully.');
        }

        $this->resetInputFields();
        $this->isEditing = false;
        $this->entryId = null;

        // Emit event to close the modal
        $this->dispatchBrowserEvent('entry-saved');
    }

    public function resetInputFields()
    {
        $this->date_received = '';
        $this->dvNum = '';
        $this->dvNum2 = '';
        $this->ap_no = '';
        $this->gross_amount = '';
        $this->tax = '';
        $this->other_deduction = '';
        $this->net_amount = '';
        $this->final_gross_amount = '';
        $this->final_net_amount = '';
        $this->program_unit = '';
        $this->date_returned_to_end_user = '';
        $this->date_compiled_to_end_user = '';
        $this->no_of_days = '';
        $this->outgoing_processor = '';
        $this->outgoing_certifier = '';
        $this->remarks = '';
        $this->outgoing_date = '';
        $this->action = '';
    }

    public function editEntry($id)
    {
        $entry = Accounting::findOrFail($id);

        $this->date_received = $entry->date_received;
        $this->dvNum = $entry->dvNum;
        $this->dvNum2 = $entry->dvNum2;
        $this->ap_no = $entry->ap_no;
        $this->gross_amount = $entry->gross_amount;
        $this->tax = $entry->tax;
        $this->other_deduction = $entry->other_deduction;
        $this->net_amount = $entry->net_amount;
        $this->final_gross_amount = $entry->final_gross_amount;
        $this->final_net_amount = $entry->final_net_amount;
        $this->program_unit = $entry->program_unit;
        $this->date_returned_to_end_user = $entry->date_returned_to_end_user;
        $this->date_compiled_to_end_user = $entry->date_compiled_to_end_user;
        $this->no_of_days = $entry->no_of_days;
        $this->outgoing_processor = $entry->outgoing_processor;
        $this->outgoing_certifier = $entry->outgoing_certifier;
        $this->remarks = $entry->remarks;
        $this->outgoing_date = $entry->outgoing_date;
        $this->action = $entry->action;

        $this->entryId = $id;
        $this->isEditing = true;
    }

    public function render()
    {
        $accountingRecords = Accounting::where('dvNum', 'like', '%' . $this->search . '%')
            ->orWhere('program_unit', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.data-table.accounting-data-table', [
            'accountingRecords' => $accountingRecords,
        ]);
    }
}
