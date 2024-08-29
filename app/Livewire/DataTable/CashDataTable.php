<?php

namespace App\Livewire\DataTable;
use App\Models\Cash;
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
    public $date_received, $dvNum, $payment_type, $check_ada_no, $gross_amount, $net_amount, $final_net_amount, $date_issued, $receipt_no, $remarks, $payee, $particulars, $outgoing_date, $action;
    public $isEditing = false;
    public $entryId;

    protected $rules = [
        'date_received' => 'required|date',
        'dvNum' => 'required|string|max:255',
        'payment_type' => 'required|string|max:255',
        'check_ada_no' => 'required|string|max:255',
        'gross_amount' => 'required|numeric',
        'net_amount' => 'required|numeric',
        'final_net_amount' => 'required|numeric',
        'date_issued' => 'required|date',
        'receipt_no' => 'required|string|max:255',
        'remarks' => 'nullable|string|max:1000',
        'payee' => 'required|string|max:255',
        'particulars' => 'required|string|max:255',
        'outgoing_date' => 'required|date',
        'action' => 'required|string|max:255',
    ];

    public function saveEntry()
    {
        $this->validate();

        if ($this->isEditing) {
            // Update existing entry
            $entry = Cash::find($this->entryId);

            $entry->update([
                'date_received' => $this->date_received,
                'dvNum' => $this->dvNum,
                'payment_type' => $this->payment_type,
                'check_ada_no' => $this->check_ada_no,
                'gross_amount' => $this->gross_amount,
                'net_amount' => $this->net_amount,
                'final_net_amount' => $this->final_net_amount,
                'date_issued' => $this->date_issued,
                'receipt_no' => $this->receipt_no,
                'remarks' => $this->remarks,
                'payee' => $this->payee,
                'particalars' =>$this->particulars,
                'outgoing_date' => $this->outgoing_date,
                'action' => $this->action,
            ]);

            session()->flash('message', 'Entry updated successfully.');
        } else {
            // Create a new entry
            Cash::create([
                'date_received' => $this->date_received,
                'dv_no' => $this->dvNum,
                'payment_type' => $this->payment_type,
                'check_ada_no' => $this->check_ada_no,
                'gross_amount' => $this->gross_amount,
                'net_amount' => $this->net_amount,
                'final_net_amount' => $this->final_net_amount,
                'date_issued' => $this->date_issued,
                'receipt_no' => $this->receipt_no,
                'remarks' => $this->remarks,
                'payee' => $this->payee,
                'particalars' =>$this->particulars,
                'outgoing_date' => $this->outgoing_date,
                'action' => $this->action,
            ]);

            session()->flash('message', 'Entry created successfully.');
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
        $this->dvNum = '';          
        $this->payment_type = '';
        $this->check_ada_no = '';
        $this->gross_amount = '';
        $this->net_amount = '';
        $this->final_net_amount = '';
        $this->date_issued = '';
        $this->receipt_no = '';
        $this->remarks = '';
        $this->payee = '';
        $this->particulars = '';    
        $this->outgoing_date = '';
        $this->action = '';
    }

    public function editEntry($id)
    {
        $entry = Cash::findOrFail($id);
        $this->date_received = $entry->date_received;
        $this->dvNum = $entry->dvNum;
        $this->payment_type = $entry->payment_type;
        $this->check_ada_no = $entry->check_ada_no;
        $this->gross_amount = $entry->gross_amount;
        $this->net_amount = $entry->net_amount;
        $this->final_net_amount = $entry->final_net_amount;
        $this->date_issued = $entry->date_issued;
        $this->receipt_no = $entry->receipt_no;
        $this->remarks = $entry->remarks;
        $this->payee = $entry->payee;
        $this->particular = $entry->particular;
        $this->outgoing_date = $entry->outgoing_date;
        $this->action = $entry->action;

        $this->entryId = $id;
        $this->isEditing = true;
    }

    public function render()
    {
        $cashRecords = Cash::where('dvNum', 'like', '%' . $this->search . '%')
            ->orWhere('payment_type', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.data-table.cash-data-table', [
            'cashRecords' => $cashRecords,
        ]);
    }
}
