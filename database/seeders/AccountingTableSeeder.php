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
                'dv_no' => '1234345',
                'dv_no2' => '123457',
                'ap_no' => 'AP123',
                'gross_amount' => 10000.00,
                'tax' => 500.00,
                'other_deduction' => 200.00,
                'net_amount' => 9300.00,
                'final_gross_amount' => 9800.00,
                'final_net_amount' => 9500.00,
                'program_unit' => 'Finance',
                'date_returned_to_end_user' => Carbon::now()->subDays(3),
                'date_complied_to_end_user' => Carbon::now()->subDays(2),
                'no_of_days' => 3,
                'outgoing_processor' => 'John Doe',
                'outgoing_certifier' => 'Jane Smith',
                'remarks' => 'Processed without issues',
                'outgoing_date' => Carbon::now()->subDay(),
                'status' => 'Processing'
            ],
            
            
        ]);
    }
}
