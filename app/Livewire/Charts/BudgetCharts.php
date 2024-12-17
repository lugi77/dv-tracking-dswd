<?php

namespace App\Livewire\Charts;

use App\Models\Budget;
use App\Models\DvInventoryBudgetProcessed;
use App\Models\DvInventoryBudgetUnprocessed;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class BudgetCharts extends Component
{
    public function render()
    {
        // Count DVs with status "Return to End User"
        $returnToEndUserCount = Budget::where('status', 'RETURN TO END USER')->count();

        // Count DVs with status "For Approval"
        $forApprovalCount = Budget::where('status', 'FOR APPROVAL')->count();

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
            'returnToEndUserCount' => $returnToEndUserCount,
            'forApprovalCount' => $forApprovalCount,

        ]);
    }
    // PDF generation method
    public function generatePdf()
    {
        $lastWeek = Carbon::now()->subWeek();

        $processedProgram = DvInventoryBudgetProcessed::select('program')
            ->selectRaw('SUM(no_of_processed_dv) as total_processed_dvs')
            ->selectRaw('SUM(total_amount_processed) as total_processed_amount')
            ->where('created_at', '>=', $lastWeek)
            ->groupBy('program')
            ->get();

        $unprocessedProgram = DvInventoryBudgetUnprocessed::select('program')
            ->selectRaw('SUM(no_of_unprocessed_dv) as total_unprocessed_dvs')
            ->selectRaw('SUM(total_amount_unprocessed) as total_unprocessed_amount')
            ->where('created_at', '>=', $lastWeek)
            ->groupBy('program')
            ->get();

        $pdf = PDF::loadView('livewire.pdf-views.budget-pdf-view', compact('processedProgram', 'unprocessedProgram'));
        return $pdf->download('weekly_dv_report_budget.pdf');  // Download the PDF
    }
}
