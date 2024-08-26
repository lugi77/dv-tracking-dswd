<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounting')->insert([
            [
                'date_received' => Carbon::now()->subDays(5),
                'dvNum' => 'DV123456',
                'dvNum2' => 'DV123457',
                'ap_no' => 'AP123',
                'gross_amount' => 10000.00,
                'tax' => 500.00,
                'other_deduction' => 200.00,
                'net_amount' => 9300.00,
                'final_gross_amount' => 9800.00,
                'final_net_amount' => 9500.00,
                'program_unit' => 'Finance',
                'date_returned_to_end_user' => Carbon::now()->subDays(3),
                'date_compiled_to_end_user' => Carbon::now()->subDays(2),
                'no_of_days' => 3,
                'outgoing_processor' => 'John Doe',
                'outgoing_certifier' => 'Jane Smith',
                'remarks' => 'Processed without issues',
                'outgoing_date' => Carbon::now()->subDay(),
                'action' => 'Reviewed'
            ],
            [
                'date_received' => Carbon::now()->subDays(10),
                'dvNum' => 'DV123458',
                'dvNum2' => 'DV123459',
                'ap_no' => 'AP124',
                'gross_amount' => 15000.00,
                'tax' => 750.00,
                'other_deduction' => 300.00,
                'net_amount' => 13950.00,
                'final_gross_amount' => 14500.00,
                'final_net_amount' => 14000.00,
                'program_unit' => 'Operations',
                'date_returned_to_end_user' => Carbon::now()->subDays(8),
                'date_compiled_to_end_user' => Carbon::now()->subDays(6),
                'no_of_days' => 4,
                'outgoing_processor' => 'Alice Brown',
                'outgoing_certifier' => 'Bob White',
                'remarks' => 'Delayed due to missing documents',
                'outgoing_date' => Carbon::now()->subDays(5),
                'action' => 'Pending'
            ],
            [
                'date_received' => Carbon::now()->subDays(15),
                'dvNum' => 'DV123460',
                'dvNum2' => 'DV123461',
                'ap_no' => 'AP125',
                'gross_amount' => 20000.00,
                'tax' => 1000.00,
                'other_deduction' => 400.00,
                'net_amount' => 18600.00,
                'final_gross_amount' => 19500.00,
                'final_net_amount' => 19000.00,
                'program_unit' => 'Logistics',
                'date_returned_to_end_user' => Carbon::now()->subDays(12),
                'date_compiled_to_end_user' => Carbon::now()->subDays(10),
                'no_of_days' => 5,
                'outgoing_processor' => 'Charlie Green',
                'outgoing_certifier' => 'Dana Blue',
                'remarks' => 'Approved after corrections',
                'outgoing_date' => Carbon::now()->subDays(8),
                'action' => 'Approved'
            ],
        ]);
    }
}