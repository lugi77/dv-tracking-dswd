<?php

namespace App\Livewire\DataTable;

use App\Models\Accounting;
use App\Models\ActivityLog;
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
    $this->validate();

    // Determine action: Editing or Creating
    $action = $this->isEditing ? 'Updated' : 'Created';

    // Convert null values to 0 for tax and other_deduction
    $taxPercentage = $this->tax ?? 0;
    $other_deduction = is_numeric($this->other_deduction) ? (float)$this->other_deduction : 0;

    // Calculate actual tax amount based on percentage
    $taxAmount = ($this->gross_amount * $taxPercentage) / 100;

    // Calculate net amount (final gross - tax amount - other deductions)
    $this->net_amount = $this->gross_amount - $taxAmount - $other_deduction;

    // Calculate the difference between the dates if both dates are provided
    if ($this->date_returned_to_end_user && $this->date_complied_to_end_user) {
        $this->no_of_days = Carbon::parse($this->date_returned_to_end_user)->diffInDays(Carbon::parse($this->date_complied_to_end_user));
    } else {
        $this->no_of_days = null; // Or set it to 0 if preferred
    }

    if ($this->isEditing) {
        // Update existing entry
        $entry = Accounting::findOrFail($this->entryId);

        // Check if there are any changes to the entry
        $hasChanges = false;
        if ($entry->date_received !== $this->date_received ||
            $entry->dv_no !== $this->dv_no ||
            $entry->ap_no !== $this->ap_no ||
            $entry->gross_amount !== $this->gross_amount ||
            $entry->tax !== $this->tax ||
            $entry->other_deduction !== $this->other_deduction ||
            $entry->net_amount !== $this->net_amount ||
            $entry->program !== $this->program ||
            $entry->date_returned_to_end_user !== $this->date_returned_to_end_user ||
            $entry->date_complied_to_end_user !== $this->date_complied_to_end_user ||
            $entry->no_of_days !== $this->no_of_days ||
            $entry->outgoing_processor !== $this->outgoing_processor ||
            $entry->outgoing_certifier !== $this->outgoing_certifier ||
            $entry->remarks !== $this->remarks ||
            $entry->outgoing_date !== $this->outgoing_date ||
            $entry->status !== $this->status) {
            $hasChanges = true;
        }

        // If no changes, return without updating
        if (!$hasChanges) {
            return; // Stop execution if no changes
        }

        // Check if DV No is provided when forwarding to Cash
        if ($this->status === 'Forward to Cash' && empty($this->dv_no)) {
            session()->flash('error-dv', 'Cannot forward to Cash: DV No is required.');
            return; // Stop execution if DV No is missing
        }

        $entry->update([
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

        // Flash message for successful update
        session()->flash('message', 'Entry updated successfully.');

        // Handle status-specific actions
        if ($this->status === 'Forward to Cash') {
            $action = 'Sent to Cash';
            $this->sendToCash($entry->id); // Proceed with forwarding to Cash
        } elseif ($this->status === 'Return to Budget') {
            $action = 'Returned to Budget';
            $this->sendBackToBudget($entry->id); // Return entry to Budget
        }

    } else {
        // Create new entry
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

        // Flash message for successful creation
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

    // Log the action only if dv_no is present
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

    // Reset the form and close the modal
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

        // Flash a success message
        session()->flash('message', 'DV sent to Cash successfully.');
    }
    public function sendBackToBudget($id)
    {
        // Find the Accounting record by its ID
        $accountingRecord = Accounting::findOrFail($id);
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
