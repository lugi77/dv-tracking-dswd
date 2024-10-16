<?php

namespace App\Livewire\DataTable;

use App\Models\Accounting;
use App\Models\ActivityLog;
use App\Models\DvInventoryAccountProcessed;
use App\Models\DvInventoryAccountUnprocessed;
use App\Models\DvInventoryBudgetProcessed;
use Livewire\Attributes\Layout;
use App\Models\Cash;
use App\Models\Budget;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;


#[Layout('layouts.app')]
class AccountingDataTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    // Form inputs
    public $transaction_no, $date_received, $dv_no, $ap_no, $gross_amount, $tax,
    $other_deduction, $net_amount, $program, $date_returned_to_end_user, $date_complied_to_end_user,
    $no_of_days, $outgoing_processor, $outgoing_certifier, $remarks, $payee, $appropriation,
    $outgoing_date, $status, $orsNum, $particulars;

    public $isEditing = false;
    public $entryId;
    public $sortField = 'dv_no'; // Default sort field
    public $sortDirection = 'asc'; // Default sort direction

    protected $rules = [
        'date_received' => 'required|date',
        'dv_no' => 'nullable|string|max:20',
        'ap_no' => 'nullable|string|max:20',
        'gross_amount' => 'required|numeric|min:0',
        'tax' => 'nullable|numeric',
        'other_deduction' => 'nullable|numeric|min:0',
        'program' => 'required|string|max:30',
        'date_returned_to_end_user' => 'nullable|date',
        'date_complied_to_end_user' => 'nullable|date',
        'no_of_days' => 'nullable|integer',
        'outgoing_processor' => 'nullable|string|max:30',
        'outgoing_certifier' => 'nullable|string|max:30',
        'orsNum' => 'nullable|string|max:20',
        'particulars' => 'nullable|string|max:250',
        'remarks' => 'nullable|string',
        'outgoing_date' => 'nullable|date',
        'status' => 'nullable|string',
    ];

    public function saveEntry()
    {
        // Validate form data
        $this->validate([
            'date_received' => 'required|date',
            'dv_no' => 'nullable|string',
            'ap_no' => 'nullable|string',
            'gross_amount' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'other_deduction' => 'nullable|numeric',
            'program' => 'nullable|string',
            'date_returned_to_end_user' => 'nullable|date',
            'date_complied_to_end_user' => 'nullable|date',
            'outgoing_processor' => 'nullable|string',
            'outgoing_certifier' => 'nullable|string',
            'remarks' => 'nullable|string',
            'outgoing_date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        // Determine action: Editing or Creating
        $action = $this->isEditing ? 'Updated' : 'Created';

        // Ensure numeric fields are properly cast and handled
        $this->tax = $this->tax !== '' ? (float) $this->tax : 0;
        $this->other_deduction = $this->other_deduction !== '' ? (float) $this->other_deduction : 0;

        // Calculate net_amount
        $this->net_amount = (float) $this->gross_amount - $this->tax - $this->other_deduction;

        // Calculate the difference between the dates if both dates are provided
        if ($this->date_returned_to_end_user && $this->date_complied_to_end_user) {
            try {
                $this->no_of_days = Carbon::parse($this->date_returned_to_end_user)
                    ->diffInDays(Carbon::parse($this->date_complied_to_end_user));
            } catch (\Exception $e) {
                $this->no_of_days = null;
            }
        } else {
            $this->no_of_days = null;
        }

        if ($this->isEditing) {
            // Find and update the existing entry
            $entry = Accounting::findOrFail($this->entryId);

            // Check if any field has changed
            $entry->fill([
                'date_received' => $this->date_received,
                'dv_no' => $this->dv_no,
                'ap_no' => $this->ap_no,
                'gross_amount' => $this->gross_amount,
                'tax' => $this->tax,
                'other_deduction' => $this->other_deduction,
                'net_amount' => $this->net_amount,
                'program' => $this->program,
                'date_returned_to_end_user' => $this->date_returned_to_end_user,
                'date_complied_to_end_user' => $this->date_complied_to_end_user,
                'no_of_days' => $this->no_of_days,
                'outgoing_processor' => $this->outgoing_processor,
                'outgoing_certifier' => $this->outgoing_certifier,
                'remarks' => $this->remarks,
                'outgoing_date' => $this->outgoing_date,
                'status' => $this->status,
            ]);

            // If there are no changes, return early
            if (!$entry->isDirty()) {
                session()->flash('message', 'No changes detected.');
                return;
            }

            // If forwarding to Cash, ensure DV No is present
            if ($this->status === 'Forward to Cash' && empty($this->dv_no)) {
                session()->flash('error-dv', 'Cannot forward to Cash: DV No is required.');
                return;
            }

            // Save the updated entry
            $entry->save();
            session()->flash('message', 'Entry updated successfully.');

            // Handle status-specific actions
            if ($this->status === 'Forward to Cash') {
                $action = 'Sent to Cash';
                $this->sendToCash($entry->id);
            } elseif ($this->status === 'Return to Budget') {
                $action = 'Returned to Budget';
                $this->sendBackToBudget($entry->id);
            }

        } else {
            // Create a new entry
            $entry = Accounting::create([
                'date_received' => $this->date_received,
                'dv_no' => $this->dv_no,
                'ap_no' => $this->ap_no,
                'gross_amount' => $this->gross_amount,
                'tax' => $this->tax,
                'other_deduction' => $this->other_deduction,
                'net_amount' => $this->net_amount,
                'program' => $this->program,
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

            // Handle status-specific actions
            if ($this->status === 'Forward to Cash') {
                $action = 'Sent to Cash';
                $this->sendToCash($entry->id);
            } elseif ($this->status === 'Return to Budget') {
                $action = 'Returned to Budget';
                $this->sendBackToBudget($entry->transaction_no);
            }
        }

        // Log the action only if DV No is provided
        if (!empty($this->dv_no)) {
            ActivityLog::create([
                'user_id' => auth()->id(),
                'section' => 'Accounting',
                'user_name' => auth()->user()->name,
                'dv_no' => $entry->dv_no,
                'dswd_id' => auth()->user()->dswd_id,
                'action' => $action,
                'details' => "User {$action} an accounting entry with DV Number: {$entry->dv_no}",
            ]);
        }

        // Reset form fields and close modal
        $this->resetInputFields();
        $this->isEditing = false;
        $this->entryId = null;
        $this->dispatch('entry-saved');
    }


    function resetInputFields()
    {
        $this->date_received = '';
        $this->dv_no = '';
        $this->ap_no = '';
        $this->gross_amount = '';
        $this->tax = '';
        $this->other_deduction = '';
        $this->net_amount = '';
        $this->program = '';
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
        $this->ap_no = $entry->ap_no;
        $this->gross_amount = $entry->gross_amount;
        $this->tax = $entry->tax;
        $this->other_deduction = $entry->other_deduction;
        $this->net_amount = $entry->net_amount;
        $this->program = $entry->program;
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
        $existingCashRecord = Cash::where('transaction_no', $accountingRecord->transaction_no)->first();

        if ($existingCashRecord) {
            // Flash a message indicating that this DV number has already been sent to Cash
            session()->flash('error', 'This DV has already been sent to Cash.');
            return;
        }

        // Create a new Cash record with data from the Accounting record
        Cash::create([
            'transaction_no' => $accountingRecord->transaction_no,
            'date_received' => now(), // Current date when sent to cash
            'dv_no' => $accountingRecord->dv_no,
            'gross_amount' => $accountingRecord->gross_amount,
            'net_amount' => $accountingRecord->net_amount,
            'program' => $accountingRecord->program,
            'remarks' => $accountingRecord->remarks,
            'payee' => $accountingRecord->payee,
            'orsNum' => $accountingRecord->orsNum,
            'particulars' => $accountingRecord->particulars,
            'appropriation' => $accountingRecord->appropriation,
            'status' => 'Sent from Accounting', // Optional action field
            // Add other fields as necessary
        ]);

        // Update the status of the Accounting record
        $accountingRecord->update([
            'status' => 'Sent to Cash',
            'outgoing_date' => now(),
        ]);

        $this->dvInventoryAccounting($accountingRecord->id);

        // Flash a success message
        session()->flash('message', 'DV sent to Cash successfully.');
    }

    public function dvInventoryAccounting($id)
    {
        // Find the cash record
        $accountingRecordProcessed = Accounting::findOrFail($id);

        // Check if the transaction_no already exists in the dv_inventory table
        $existingDvInventory = DvInventoryAccountProcessed::where('transaction_no', $accountingRecordProcessed->transaction_no)->first();

        if ($existingDvInventory) {
            // If the transaction_no already exists, skip the counting to avoid duplicates
            return;
        }

        // but ensure the transaction_no is unique
        DvInventoryAccountProcessed::create([
            'payee' => $accountingRecordProcessed->payee,
            'no_processed_account_dv' => 1,  // Since this is a new entry, set it to 1
            'total_processed_account_dv' => $accountingRecordProcessed->net_amount,
            'transaction_no' => $accountingRecordProcessed->transaction_no,  // Store the transaction_no to track this entry
        ]);
    }
    public function sendBackToBudget($id)
    {
        // Find the Accounting record by its ID
        $accountingRecord = Accounting::findOrFail($id);

        // Check if the transaction_no already exists in the dv_inventory table
        $dvInventory = DvInventoryAccountUnprocessed::where('transaction_no', $accountingRecord->transaction_no)->first();

        if ($dvInventory) {
            // Subtract the cash record's amount from the total amount in dv_inventory
            $dvInventory->delete();
        }

        $dvInventoryBudgetProcessed = DvInventoryBudgetProcessed::where('transaction_no', $accountingRecord->transaction_no)->first();

        if ($dvInventoryBudgetProcessed) {
            // Subtract the cash record's amount from the total amount in dv_inventory
            $dvInventoryBudgetProcessed->delete();
        }

        // Find the related Budget record using the DV number
        $budgetRecord = Budget::where('transaction_no', $accountingRecord->transaction_no)->first();
        if (!$budgetRecord) {
            session()->flash('error', 'No corresponding Budget record found.');
            return;
        }
        // Update the status of the Accounting record to indicate it has been sent back to Budget
        $accountingRecord->update([
            'status' => 'Sent Back to Budget',
            'outgoing_date' => now(),
        ]);
        // Optionally update the status of the Budget record
        $budgetRecord->update([
            'status' => 'Returned from Accounting',
        ]);

        $accountingRecord->delete();
        // Flash a message to indicate successA
        session()->flash('message', 'Entry sent back to Budget successfully.');

        $this->dispatch('refresh-budget');
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
        $accountingRecords = Accounting::where('dv_no', 'like', '%' . $this->search . '%')
            ->orWhere('program', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection) // Apply sorting
            ->paginate($this->perPage);

        return view('livewire.data-table.accounting-data-table', [
            'accountingRecords' => $accountingRecords,
        ]);
    }

}
