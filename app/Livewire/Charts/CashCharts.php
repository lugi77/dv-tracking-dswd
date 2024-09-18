<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Accounting;
use App\Models\Cash;
use App\Models\DvInventory;

class CashCharts extends Component
{
     // Properties for form inputs
     public $program, $no_of_dv, $total_amount_program;
 
     // Validation rules
     protected $rules = [
         'program' => 'required|string',
         'no_of_dv' => 'required|integer|min:1',
         'total_amount_program' => 'required|numeric|min:0',
     ];
 
     public function render()
     {
        // Fetch all the programs and their respective DV and total amount data
        $programs = DvInventory::select('program', 'no_of_dv', 'total_amount_program')->get();

        // Calculate totals
        $totalDv = $programs->sum('no_of_dv');
        $totalAmount = $programs->sum('total_amount_program');

        return view('livewire.charts.cash-charts', [
            'programs' => $programs,
            'totalDv' => $totalDv,
            'totalAmount' => $totalAmount,
        ]);
    }
}
