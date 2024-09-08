<?php

namespace App\Livewire\DataTable;

use App\Models\Accounting;
use Livewire\Attributes\Layout;
use App\Models\Cash;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class AccountingDataTable extends Component
{
    use WithPagination;

    public $search = '';
    public  $perPage = 10;

    // Form inputs
    public  $date_received, $dv_no, $dv_no2, $ap_no, $gross_amount, $tax, 
    $other_deduction, $net_amount, $final_gross_amount, $final_net_amount, 
    $program_unit, $date_returned_to_end_user, $date_complied_to_end_user, 
    $no_of_days, $outgoing_processor, $outgoing_certifier, $remarks,
     $outgoing_date, $status;

    public $isEditing = false;
    public $entryId;

    protected $rules = [
        'date_received' => 'required|date',
        'dv_no' => 'required|string',
        'dv_no2' => 'nullable|string',
        'ap_no' => 'nullable|string',
        'gross_amount' => 'required|numeric',
        'tax' => 'nullable|numeric',
        'other_deduction' => 'nullable|numeric',
        'net_amount' => 'required|numeric',
        'final_gross_amount' => 'nullable|numeric',
        'final_net_amount' => 'nullable|numeric',
        'program_unit' => 'nullable|string',
        'date_returned_to_end_user' => 'nullable|date',
        'date_complied_to_end_user' => 'nullable|date',
        'no_of_days' => 'nullable|integer',
        'outgoing_processor' => 'nullable|string',
        'outgoing_certifier' => 'nullable|string',
        'remarks' => 'nullable|string',
        'outgoing_date' => 'nullable|date',
        'status' => 'nullable|string',
    ];

     function saveEntry()
    {
        $this->validate();

        if ($this->isEditing) {
            // Update existing entry
            $entry = Accounting::find($this->entryId);

            $entry->update([
                'date_received' => $this->date_received,
                'dv_no' => $this->dv_no,
                'dv_no2' => $this->dv_no2,
                'ap_no' => $this->ap_no,
                'gross_amount' => $this->gross_amount,
                'tax' => $this->tax,
                'other_deduction' => $this->other_deduction,
                'net_amount' => $this->net_amount,
                'final_gross_amount' => $this->final_gross_amount,
                'final_net_amount' => $this->final_net_amount,
                'program_unit' => $this->program_unit,
                'date_returned_to_end_user' => $this->date_returned_to_end_user,
                'date_complied_to_end_user' => $this->date_complied_to_end_user,
                'no_of_days' => $this->no_of_days,
                'outgoing_processor' => $this->outgoing_processor,
                'outgoing_certifier' => $this->outgoing_certifier,
                'remarks' => $this->remarks,
                'outgoing_date' => $this->outgoing_date,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Entry updated successfully.');
        } else {
            // Create a new entry
            Accounting::create([
                'date_received' => $this->date_received,
                'dv_no' => $this->dv_no,
                'dv_no2' => $this->dv_no2,
                'ap_no' => $this->ap_no,
                'gross_amount' => $this->gross_amount,
                'tax' => $this->tax,
                'other_deduction' => $this->other_deduction,
                'net_amount' => $this->net_amount,
                'final_gross_amount' => $this->final_gross_amount,
                'final_net_amount' => $this->final_net_amount,
                'program_unit' => $this->program_unit,
                'date_returned_to_end_user' => $this->date_returned_to_end_user,
                'date_complied_to_end_user' => $this->date_complied_to_end_user,
                'no_of_days' => $this->no_of_days,
                'outgoing_processor' => $this->outgoing_processor,
                'outgoing_certifier' => $this->outgoing_certifier,
                'remarks' => $this->remarks,
                'outgoing_date' => $this->outgoing_date,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Entry created successfully.');
        }

        $this->resetInputFields();
        $this->isEditing = false;
        $this->entryId = null;

        // Emit event to close the modal
        $this->dispatch('entry-saved');
    }

     function resetInputFields()
    {
        $this->date_received = '';
        $this->dv_no = '';
        $this->dv_no = '';
        $this->ap_no = '';
        $this->gross_amount = '';
        $this->tax = '';
        $this->other_deduction = '';
        $this->net_amount = '';
        $this->final_gross_amount = '';
        $this->final_net_amount = '';
        $this->program_unit = '';
        $this->date_returned_to_end_user = '';
        $this->date_complied_to_end_user = '';
        $this->no_of_days = '';
        $this->outgoing_processor = '';
        $this->outgoing_certifier = '';
        $this->remarks = '';
        $this->outgoing_date = '';
        $this->status = '';
    }

     function editEntry($id)
    {
        $entry = Accounting::findOrFail($id);

        $this->date_received = $entry->date_received;
        $this->dv_no = $entry->dv_no;
        $this->dv_no2 = $entry->dv_no2;
        $this->ap_no = $entry->ap_no;
        $this->gross_amount = $entry->gross_amount;
        $this->tax = $entry->tax;
        $this->other_deduction = $entry->other_deduction;
        $this->net_amount = $entry->net_amount;
        $this->final_gross_amount = $entry->final_gross_amount;
        $this->final_net_amount = $entry->final_net_amount;
        $this->program_unit = $entry->program_unit;
        $this->date_returned_to_end_user = $entry->date_returned_to_end_user;
        $this->date_complied_to_end_user = $entry->date_complied_to_end_user;
        $this->no_of_days = $entry->no_of_days;
        $this->outgoing_processor = $entry->outgoing_processor;
        $this->outgoing_certifier = $entry->outgoing_certifier;
        $this->remarks = $entry->remarks;
        $this->outgoing_date = $entry->outgoing_date;
        $this->status = $entry->status;

        $this->entryId = $id;
        $this->isEditing = true;
    }

    public function sendToCash($id)
{
    // Find the Accounting record by its ID
    $accountingRecord = Accounting::findOrFail($id);

    // Check if the DV number already exists in the Cash table
    $existingCashRecord = Cash::where('dv_no', $accountingRecord->dv_no)->first();

    if ($existingCashRecord) {
        // Flash a message indicating that this DV number has already been sent to Cash
        session()->flash('error', 'This DV has already been sent to Cash.');
        return;
    }

    // Create a new Cash record with data from the Accounting record
    Cash::create([
        'date_received' => now(), // Current date when sent to cash
        'dv_no' => $accountingRecord->dv_no,
        'gross_amount' => $accountingRecord->gross_amount,
        'net_amount' => $accountingRecord->net_amount,
        'remarks' => $accountingRecord->remarks,
        'status' => $accountingRecord->status, // Optional action field
        // Add other fields as necessary
    ]);

    // Update the status of the Accounting record
    $accountingRecord->update([
        'status' => 'Sent to Cash',
        'outgoing_date' => now(),
    ]);

    // Flash a success message
    session()->flash('message', 'DV sent to Cash successfully.');
}
    
    public function render()
    {
        $accountingRecords = Accounting::where('dv_no', 'like', '%' . $this->search . '%')
            ->orWhere('program_unit', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);
    
        return view('livewire.data-table.accounting-data-table', [
            'accountingRecords' => $accountingRecords,
        ]);
    }
    
}
