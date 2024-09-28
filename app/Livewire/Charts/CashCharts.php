<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Cash;
use App\Models\DvInventory;
use App\Models\DvInventoryUnprocessed;
use Barryvdh\DomPDF\Facade\Pdf;

class CashCharts extends Component
{

    public $continuingCount, $currentCount;

    public function render()
    {
        // Count for Continuing and Current Appropriations where the status is "Issuance Approved"
        $this->continuingCount = Cash::where('appropriation', 'Continuing')
            ->where('status', 'Issuance Approved')
            ->count();

        $this->currentCount = Cash::where('appropriation', 'Current')
            ->where('status', 'Issuance Approved')
            ->count();

        // Processed DVs logic: Insert into DvInventory where status = "Issuance Approved"
        $approvedCashDVs = Cash::where('status', 'Issuance Approved')->get();

        foreach ($approvedCashDVs as $approvedDV) {
            DvInventory::updateOrCreate(
                ['transaction_no' => $approvedDV->transaction_no],
                [
                    'program' => $approvedDV->program,
                    'no_of_processed_dv' => 1, // Assuming 1 DV per transaction
                    'total_amount_processed' => $approvedDV->gross_amount, // Assuming total amount from gross_amount
                ]
            );
        }

        // Remove from DvInventory if status is no longer "Issuance Approved"
        $nonApprovedCashDVs = Cash::where('status', '!=', 'Issuance Approved')->get();

        foreach ($nonApprovedCashDVs as $nonApprovedDV) {
            DvInventory::where('transaction_no', $nonApprovedDV->transaction_no)->delete();
        }

        // Processed DVs grouped by program
        $processedPrograms = DvInventory::select('program')
            ->selectRaw('SUM(no_of_processed_dv) as total_processed_dvs')
            ->selectRaw('SUM(total_amount_processed) as total_processed_amount')
            ->groupBy('program')
            ->get();

        // Unprocessed DVs logic
        $unprocessedCashDVs = Cash::where('status', '!=', 'Issuance Approved')->get();

        foreach ($unprocessedCashDVs as $unprocessedDV) {
            DvInventoryUnprocessed::updateOrCreate(
                ['transaction_no' => $unprocessedDV->transaction_no],
                [
                    'program' => $unprocessedDV->program,
                    'no_of_unprocessed_dv' => 1,
                    'total_amount_unprocessed' => $unprocessedDV->gross_amount,
                ]
            );
        }

        // Sync DvInventoryUnprocessed with the latest data from the Cash table
        foreach ($approvedCashDVs as $processedDV) {
            DvInventoryUnprocessed::where('transaction_no', $processedDV->transaction_no)->delete();
        }

        $unprocessedPrograms = DvInventoryUnprocessed::select('program')
            ->selectRaw('SUM(no_of_unprocessed_dv) as total_unprocessed_dvs')
            ->selectRaw('SUM(total_amount_unprocessed) as total_unprocessed_amount')
            ->groupBy('program')
            ->get();

        return view('livewire.charts.cash-charts', [
            'continuingCount' => $this->continuingCount,
            'currentCount' => $this->currentCount,
            'processedPrograms' => $processedPrograms,
            'unprocessedPrograms' => $unprocessedPrograms,
        ]);
    }

    public function generatePdf()
    {
        $processedPrograms = DvInventory::select('program')
        ->selectRaw('SUM(no_of_processed_dv) as total_processed_dvs')
        ->selectRaw('SUM(total_amount_processed) as total_processed_amount')
        ->groupBy('program')
        ->get();
        
        $unprocessedPrograms = DvInventoryUnprocessed::select('program')
        ->selectRaw('SUM(no_of_unprocessed_dv) as total_unprocessed_dvs')
        ->selectRaw('SUM(total_amount_unprocessed) as total_unprocessed_amount')
        ->groupBy('program')
        ->get();
    
        $pdf = PDF::loadView('pdf-view', compact('processedPrograms', 'unprocessedPrograms'));
        
        return $pdf->download('dv_report.pdf'); // Download the PDF
    }

}
