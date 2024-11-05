<?php

namespace App\Exports;

use App\Models\Budget;
use App\Models\Accounting;
use App\Models\Cash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CombinedExport implements FromCollection, WithHeadings, WithCustomStartCell, WithStyles
{
    public function collection()
    {
        $combinedData = [];

        $budgets = Budget::all();
        $accountings = Accounting::all();
        $cashes = Cash::all();

        // Calculate the maximum row count to align data horizontally
        $maxRows = max($budgets->count(), $accountings->count(), $cashes->count());

        for ($i = 0; $i < $maxRows; $i++) {
            $combinedData[] = [
                // Budget Table Data
                $accountings[$i]->dv_no ?? '', $budgets[$i]->drn_no ?? '', $budgets[$i]->particulars ?? '', 
                $budgets[$i]->etal ?? '', $budgets[$i]->budget_controller ?? '', $budgets[$i]->gross_amount ?? '', 
                $budgets[$i]->final_amount_norsa ?? '', $budgets[$i]->fund_cluster ?? '', $budgets[$i]->appropriation ?? '', 
                $budgets[$i]->orsNum ?? '', $budgets[$i]->outgoingDate ?? '', $budgets[$i]->status ?? '',

                // Accounting Table Data
                $accountings[$i]->dv_no ?? '', $accountings[$i]->ap_no ?? '', $accountings[$i]->orsNum ?? '', 
                $accountings[$i]->gross_amount ?? '', $accountings[$i]->tax ?? '', $accountings[$i]->other_deduction ?? '', 
                $accountings[$i]->date_returned_to_end_user ?? '', $accountings[$i]->date_complied_to_end_user ?? '', 
                $accountings[$i]->no_of_days ?? '', $accountings[$i]->outgoing_processor ?? '', 
                $accountings[$i]->outgoing_certifier ?? '', $accountings[$i]->particulars ?? '', 
                $accountings[$i]->outgoing_date ?? '', $accountings[$i]->status ?? '', $accountings[$i]->appropriation ?? '',

                // Cash Table Data
                $cashes[$i]->date_received ?? '', $cashes[$i]->dv_no ?? '', $cashes[$i]->payment_type ?? '', 
                $cashes[$i]->check_ada_no ?? '', $cashes[$i]->gross_amount ?? '', $cashes[$i]->net_amount ?? '', 
                $cashes[$i]->program ?? '', $cashes[$i]->date_issued ?? '', $cashes[$i]->receipt_no ?? '', 
                $cashes[$i]->remarks ?? '', $cashes[$i]->payee ?? '', $cashes[$i]->appropriation ?? '', 
                $cashes[$i]->orsNum ?? '', $cashes[$i]->particulars ?? '', $cashes[$i]->outgoing_date ?? '', 
                $cashes[$i]->status ?? '',
            ];
        }

        return collect($combinedData);
    }

    public function headings(): array
    {
        return [
            // Budget Table Headers
            'DV No', 'DRN No', 'Particulars', 'Et Al', 'Budget Controller', 'Gross Amount', 'Final Amount NORSA', 
            'Fund Cluster', 'Appropriation', 'ORS Num', 'Outgoing Date', 'Status',

            // Accounting Table Headers
            'DV No', 'AP No', 'ORS Num', 'Gross Amount', 'Tax', 'Other Deduction', 'Date Returned to End User', 
            'Date Complied to End User', 'No of Days', 'Outgoing Processor', 'Outgoing Certifier', 'Particulars', 
            'Outgoing Date', 'Status', 'Appropriation',

            // Cash Table Headers
            'Date Received', 'DV No', 'Payment Type', 'Check ADA No', 'Gross Amount', 'Net Amount', 'Program', 
            'Date Issued', 'Receipt No', 'Remarks', 'Payee', 'Appropriation', 'ORS Num', 'Particulars', 
            'Outgoing Date', 'Status',
        ];
    }

    public function startCell(): string
    {
        return 'A3';  // Start data on the third row to allow space for main section headers in the second row
    }

    public function styles(Worksheet $sheet)
    {
        // Merge cells for the main section headers and apply styling
        $sheet->mergeCells('A2:L2'); // Budget header
        $sheet->mergeCells('M2:AA2'); // Accounting header
        $sheet->mergeCells('AB2:AP2'); // Cash header

        $sheet->setCellValue('A2', 'Budget');
        $sheet->setCellValue('M2', 'Accounting');
        $sheet->setCellValue('AB2', 'Cash');

        // Styling for merged headers and column headers
        return [
            'A2:AP2' => ['font' => ['bold' => true, 'size' => 12], 'alignment' => ['horizontal' => 'center']],
            'A3:AP3' => ['font' => ['bold' => true]],  // Column headers
        ];
    }
}
