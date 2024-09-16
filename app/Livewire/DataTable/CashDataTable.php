<?php

namespace App\Livewire\DataTable;
use App\Models\Accounting;
use App\Models\Cash;
use App\Models\Budget;
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
    public $transaction_no, $date_received, $dv_no, $payment_type, $check_ada_no, $gross_amount, $net_amount, $final_net_amount, $date_issued, $receipt_no, $remarks, $payee, $particulars, $outgoing_date, $status;
    public $isEditing = false;
    public $entryId;

    public $sortField = 'dv_no'; // Default sort field
    public $sortDirection = 'desc'; // Default sort direction

    protected $rules = [
        'date_received' => 'required|date',
        'dv_no' => 'required|string|max:10',
        'payment_type' => 'required|string|max:255',
        'check_ada_no' => 'required|string|max:255',
        'gross_amount' => 'required|numeric',
        'net_amount' => 'required|numeric',
        'date_issued' => 'nullable|date',
        'receipt_no' => 'nullable|string|max:255',
        'remarks' => 'string|max:1000',
        'payee' => 'nullable|string|max:255',
        'particulars' => 'nullable|string|max:255',
        'outgoing_date' => 'nullable|date',
        'status' => 'required|string|max:255',
    ];

    public function saveEntry()
    {
        $this->validate();

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
                'particulars' =>$this->particulars,
                'outgoing_date' => $this->outgoing_date,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Entry updated successfully.');

            if($this->status === 'Return to Accounting') {
                $this->sendBackToAccounting($entry->id);
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
                'particulars' =>$this->particulars,
                'outgoing_date' => $this->outgoing_date,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Entry created successfully.');

            if($this->status === 'Return to Accounting') {
                $this->sendBackToCash($entry->id);
            }
        }

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
    // Find the Accounting record by its ID
    $cashRecords = Cash::findOrFail($id);
    // Find the related Budget record using the DV number
    $accountingRecord = Accounting::where('transaction_no', $cashRecords->transaction_no)->first();
    if (!$accountingRecord) {
        session()->flash('error', 'No corresponding Accounting record found.');
        return;
    }
    // Update the status of the Accounting record to indicate it has been sent back to Budget
    $cashRecords->update([
        'status' => 'Sent Back to Accounting',
        'outgoing_date' => now(),
    ]);
    // Optionally update the status of the Budget record
    $accountingRecord->update([
        'status' => 'Returned from Cash',
    ]);
    $cashRecords->delete();
    // Flash a message to indicate success
    session()->flash('message', 'Entry sent back to Accounting successfully.');
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
