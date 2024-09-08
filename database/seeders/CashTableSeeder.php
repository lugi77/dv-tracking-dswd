<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CashTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('cash')->insert([
            [
                'dv_no' => 1001,
                'payment_type' => 'Cheque',
                'check_ada_no' => 123456789,
                'gross_amount' => 15000.00,
                'net_amount' => 14500.00,
                'final_net_amount' => 14000.00,
                'date_received' => '2024-09-01',
                'date_issued' => '2024-09-02',
                'receipt_no' => 'RCPT12345',
                'remarks' => 'Payment for office supplies',
                'payee' => 'ABC Supplies Co.',
                'particulars' => 'Office supplies for Q3 2024',
                'outgoing_date' => '2024-09-03',
                'status' => 'Released',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
            // Add more sample data as needed
            ]);
    }
}
