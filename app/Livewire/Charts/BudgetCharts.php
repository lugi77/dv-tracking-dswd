<?php

namespace App\Livewire\Charts;

use App\Models\Budget;
use App\Models\DvInventoryBudgetProcessed;
use App\Models\DvInventoryBudgetUnprocessed;
use Livewire\Component;

class BudgetCharts extends Component
{
    public function render()
    {

         // Processed DVs grouped by program
         $processedPrograms = DvInventoryBudgetProcessed::select('program')
         ->selectRaw('SUM(no_of_processed_dv) as total_processed_dvs')
         ->selectRaw('SUM(total_amount_processed) as total_processed_amount')
         ->groupBy('program')
         ->get();


         $unprocessedDVs = Budget::where('status', '!=', 'Sent to Accounting')->get();

         foreach ($unprocessedDVs as $unprocessedDV) {
             DvInventoryBudgetUnprocessed::updateOrCreate(
                 ['transaction_no' => $unprocessedDV->transaction_no],
                 [
                     'program' => $unprocessedDV->program,
                     'no_of_unprocessed_dv' => 1,  // Assume 1 DV per transaction
                     'total_amount_unprocessed' => $unprocessedDV->gross_amount,  // Amount unprocessed
                 ]
             );
         }
 
         // Optionally, you can remove DVs from the unprocessed table if they have been processed
         $unprocessedDVs = Budget::where('status', 'Sent to Accounting')->get();
         foreach ($unprocessedDVs as $unprocessedDV) {
             DvInventoryBudgetUnprocessed::where('transaction_no', $unprocessedDV->transaction_no)->delete();
         }

         // Fetch unprocessed DVs and group by payee
        $unprocessedPrograms = DvInventoryBudgetUnprocessed::select('program')
        ->selectRaw('SUM(no_of_unprocessed_dv) as total_unprocessed_dvs')
        ->selectRaw('SUM(total_amount_unprocessed) as total_unprocessed_amount')
        ->groupBy('program')
        ->get();


        return view('livewire.charts.budget-charts', [
            'processedPrograms' => $processedPrograms,
            'unprocessedPrograms' => $unprocessedPrograms,
            
        ]);
    }
}
