<?php

namespace App\Livewire\DataTable;
use App\Models\Accounting;
use App\Models\ActivityLog;
use App\Models\Cash;
use App\Models\DvInventory;
use App\Models\DvInventoryAccountProcessed;
use App\Models\DvInventoryUnprocessed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class CashDataTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    // Form inputs
    public $transaction_no, $date_received, $dv_no, $payment_type,
    $check_ada_no, $gross_amount, $net_amount, $program, $final_net_amount,
    $date_issued, $receipt_no, $remarks, $payee, $particulars, $outgoing_date,
    $status, $appropriation, $orsNum;
    public $isEditing = false;
    public $entryId;

    public $sortField = 'dv_no'; // Default sort field
    public $sortDirection = 'desc'; // Default sort direction

    protected $rules = [
        'date_received' => 'required|date',
        'dv_no' => 'nullable|string|max:20',
        'payment_type' => 'nullable|string|max:10',
        'check_ada_no' => 'nullable|string|max:20',
        'gross_amount' => 'required|numeric|min:0',
        'net_amount' => 'required|numeric|min:0',
        'date_issued' => 'nullable|date',
        'receipt_no' => 'nullable|string|max:20',
        'remarks' => 'string|max:1000',
        'payee' => 'nullable|string|max:30',
        'orsNum' => 'nullable|string|max:50',
        'particulars' => 'nullable|string|max:250',
        'outgoing_date' => 'nullable|date',
        'status' => 'required|string|max:50',
    ];

    public function saveEntry()
    {
        $this->validate();

        $action = $this->isEditing ? 'Updated' : 'Created';

        if ($this->isEditing) {
            // Update existing entry
            $entry = Cash::find($this->entryId);

            $entry->update([
                'date_received' => $this->date_received,
                'dv_no' => $this->dv_no,
                'payment_type' => $this->payment_type,
                'check_ada_no' => $this->check_ada_no,
                'gross_amount' => $this->gross_amount,
                'net_amount' => $this->net_amount,
                'date_issued' => $this->date_issued,
                'receipt_no' => $this->receipt_no,
                'remarks' => $this->remarks,
                'payee' => $this->payee,
                'particulars' => $this->particulars,
                'outgoing_date' => $this->outgoing_date,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Entry updated successfully.');

            if ($this->status === 'Return to Accounting') {
                $action = 'Returned a DV to Accounting'; 
                $this->sendBackToAccounting($entry->id);
            } elseif ($this->status === 'Issuance Approved') {
                $action = 'Approved'; 
                $this->issuanceApproved($entry->id);
            }

        } else {
            // Create a new entry
            $entry = Cash::create([
                'date_received' => $this->date_received,
                'dv_no' => $this->dv_no,
                'payment_type' => $this->payment_type,
                'check_ada_no' => $this->check_ada_no,
                'gross_amount' => $this->gross_amount,
                'net_amount' => $this->net_amount,
                'date_issued' => $this->date_issued,
                'receipt_no' => $this->receipt_no,
                'remarks' => $this->remarks,
                'payee' => $this->payee,
                'particulars' => $this->particulars,
                'outgoing_date' => $this->outgoing_date,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Entry created successfully.');

            if ($this->status === 'Return to Accounting') {
                $action = 'Returned a DV to Accounting';
                $this->sendBackToCash($entry->id);
            } elseif ($this->status === 'Issuance Approved') {
                $action = 'Approved'; 
                $this->issuanceApproved($entry->id);
            }
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'section' => 'Cash',
            'user_name' => auth()->user()->name,
            'dv_no' => $entry->dv_no,
            'dswd_id' => auth()->user()->dswd_id,
            'action' => $action,
            'details' => "User {$action} a cash entry with DV Number: {$entry->dv_no}",
    ]);

        $this->resetInputFields();
        $this->isEditing = false;
        $this->entryId = null;

        // Emit event to close the modal
        $this->dispatch('entry-saved');
    }

    public function resetInputFields()
    {
        $this->date_received = '';
        $this->dv_no = '';
        $this->payment_type = '';
        $this->check_ada_no = '';
        $this->gross_amount = '';
        $this->net_amount = '';
        $this->date_issued = '';
        $this->receipt_no = '';
        $this->remarks = '';
        $this->payee = '';
        $this->particulars = '';
        $this->outgoing_date = '';
        $this->status = '';
    }

    public function editEntry($id)
    {
        $entry = Cash::findOrFail($id);
        $this->date_received = $entry->date_received;
        $this->dv_no = $entry->dv_no;
        $this->payment_type = $entry->payment_type;
        $this->check_ada_no = $entry->check_ada_no;
        $this->gross_amount = $entry->gross_amount;
        $this->net_amount = $entry->net_amount;
        $this->date_issued = $entry->date_issued;
        $this->receipt_no = $entry->receipt_no;
        $this->remarks = $entry->remarks;
        $this->payee = $entry->payee;
        $this->particulars = $entry->particulars;
        $this->outgoing_date = $entry->outgoing_date;
        $this->status = $entry->status;

        $this->entryId = $id;
        $this->isEditing = true;
    }

    public function sendBackToAccounting($id)
    {
        // Find the Cash record by its ID
        $cashRecord = Cash::findOrFail($id);

        // Check if the transaction_no already exists in the dv_inventory table
        $dvInventory = DvInventory::where('transaction_no', $cashRecord->transaction_no)->first();

        if ($dvInventory) {
            // Subtract the cash record's amount from the total amount in dv_inventory
            $dvInventory->delete();
        }

        $dvInventoryunprocessed = DvInventoryUnprocessed::where('transaction_no', $cashRecord->transaction_no)->first();
        if ($dvInventoryunprocessed) {
            // Subtract the cash record's amount from the total amount in dv_inventory
            $dvInventoryunprocessed->delete();
        }

        $dvInventoryAccountProcessed = DvInventoryAccountProcessed::where('transaction_no', $cashRecord->transaction_no)->first();

        if ($dvInventoryAccountProcessed) {
            // Subtract the cash record's amount from the total amount in dv_inventory
            $dvInventoryAccountProcessed->delete();
        }

        // Find the related Accounting record using the transaction_no
        $accountingRecord = Accounting::where('transaction_no', $cashRecord->transaction_no)->first();

        if (!$accountingRecord) {
            session()->flash('error', 'No corresponding Accounting record found.');
            return;
        }

        // Update the status of the Cash record to indicate it has been sent back to Accounting
        $cashRecord->update([
            'status' => 'Sent Back to Accounting',
            'outgoing_date' => now(),
        ]);

        // Optionally update the status of the Accounting record
        $accountingRecord->update([
            'status' => 'Returned from Cash',
        ]);

        // Delete the Cash record after processing
        $cashRecord->delete();

        // Flash a message to indicate success
        session()->flash('message', 'Entry sent back to Accounting successfully.');
    }

    public function issuanceApproved($id)
    {
          // Find the cash record
        $cashRecord = Cash::findOrFail($id);

        // Check if the transaction_no already exists in the dv_inventory table
        $existingDvInventory = DvInventory::where('transaction_no', $cashRecord->transaction_no)->first();

        if ($existingDvInventory) {
            // If the transaction_no already exists, skip the counting to avoid duplicates
            return;
        }

        // but ensure the transaction_no is unique
        DvInventory::create([
            'program' => $cashRecord->program,
            'no_of_processed_dv' => 1,  // Since this is a new entry, set it to 1
            'total_amount_processed' => $cashRecord->net_amount,
            'transaction_no' => $cashRecord->transaction_no,  // Store the transaction_no to track this entry
        ]);
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
        $cashRecords = Cash::where('dv_no', 'like', '%' . $this->search . '%')
            ->orWhere('payment_type', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection) // Apply sorting
            ->paginate($this->perPage);

        return view('livewire.data-table.cash-data-table', [
            'cashRecords' => $cashRecords,
        ]);
    }
}
