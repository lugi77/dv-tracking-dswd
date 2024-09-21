<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Accounting;
use App\Models\Cash;
use App\Models\DvInventory;

class CashCharts extends Component
{
     // Properties for form inputs
     public $program, $transaction_no,  $no_of_dv, $total_amount_program;

     public $continuingCount, $currentCount;

     public $totalDvCount, $totalUnprocessedCount;
 
     // Validation rules
     protected $rules = [
         'program' => 'required|string',
         'no_of_dv' => 'required|integer|min:1',
         'total_amount_program' => 'required|numeric|min:0',
     ];
 
     public function render()
     {
        // Calculate the count of 'Continuing' and 'Current' from the appropriation field in the cash table
        $this->continuingCount = Cash::where('appropriation', 'Continuing')
            ->where('status', 'Issuance Approved')
            ->count();

        $this->currentCount = Cash::where('appropriation', 'Current')
            ->where('status', 'Issuance Approved')
            ->count();

        // Calculate counts for ADA and Cheque
        $this->totalDvCount = Cash::where('payment_type', 'ADA')->count();

        $this->totalUnprocessedCount = Cash::where('payment_type', 'Cheque')->count();

        // Fetch all the programs and their respective DV and total amount data
        $programs = DvInventory::select('program', 'no_of_dv', 'total_amount_program')->get();

        // Calculate totals
        $totalDv = $programs->sum('no_of_dv');
        $totalAmount = $programs->sum('total_amount_program');

        return view('livewire.charts.cash-charts', [
            'continuingCount' => $this->continuingCount,
            'currentCount' => $this->currentCount,
            'programs' => $programs,
            'totalDv' => $totalDv,
            'totalAmount' => $totalAmount,
            'totalDvCount' => $this->totalDvCount,
            'totalUnprocessedCount' => $this->totalUnprocessedCount,
        ]);
    }
}
