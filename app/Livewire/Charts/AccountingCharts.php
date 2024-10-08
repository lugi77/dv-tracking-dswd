<?php

namespace App\Livewire\Charts;

use App\Models\Accounting;
use App\Models\DvInventoryAccountProcessed;
use App\Models\DvInventoryAccountUnprocessed;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class AccountingCharts extends Component
{
    public function render()
    {
        // Fetch processed DVs and group by payee
        $processedAccountingPayee = DvInventoryAccountProcessed::select('payee')
            ->selectRaw('SUM(no_processed_account_dv) as total_processed_dvs')
            ->selectRaw('SUM(total_processed_account_dv) as total_processed_amount')
            ->groupBy('payee')
            ->get();

        // Check if status is not "Sent to Cash" and update unprocessed DVs
        // Fetch DVs from Accounting that are not processed (status != 'Sent to Cash')
        $unprocessedDVs = Accounting::where('status', '!=', 'Sent to Cash')->get();

        foreach ($unprocessedDVs as $unprocessedDV) {
            DvInventoryAccountUnprocessed::updateOrCreate(
                ['transaction_no' => $unprocessedDV->transaction_no],
                [
                    'payee' => $unprocessedDV->payee,
                    'no_unprocessed_account_dv' => 1,  // Assume 1 DV per transaction
                    'total_unprocessed_account_dv' => $unprocessedDV->gross_amount,  // Amount unprocessed
                ]
            );
        }

        // Optionally, you can remove DVs from the unprocessed table if they have been processed
        $processedDVs = Accounting::where('status', 'Sent to Cash')->get();
        foreach ($processedDVs as $processedDV) {
            DvInventoryAccountUnprocessed::where('transaction_no', $processedDV->transaction_no)->delete();
        }

        // Fetch unprocessed DVs and group by payee
        $unprocessedAccountingPayee = DvInventoryAccountUnprocessed::select('payee')
            ->selectRaw('SUM(no_unprocessed_account_dv) as total_unprocessed_dvs')
            ->selectRaw('SUM(total_unprocessed_account_dv) as total_unprocessed_amount')
            ->groupBy('payee')
            ->get();

        return view('livewire.charts.accounting-charts', [
            'processedPayee' => $processedAccountingPayee,
            'unprocessedPayee' => $unprocessedAccountingPayee,
        ]);
    }

    // PDF generation method
    public function generatePdf()
    {
        $processedPayee = DvInventoryAccountProcessed::select('program')
            ->selectRaw('SUM(no_of_processed_dv) as total_processed_dvs')
            ->selectRaw('SUM(total_processed_amount) as total_processed_amount')
            ->groupBy('program')
            ->get();

        $unprocessedPayee = DvInventoryAccountUnprocessed::select('payee')
            ->selectRaw('SUM(no_unprocessed_account_dv) as total_unprocessed_dvs')
            ->selectRaw('SUM(total_unprocessed_account_dv) as total_unprocessed_amount')
            ->groupBy('payee')
            ->get();

        $pdf = PDF::loadView('pdf-view', compact('processedPayee', 'unprocessedPayee'));
        return $pdf->download('dv_report_accounting.pdf');  // Download the PDF
    }
}
