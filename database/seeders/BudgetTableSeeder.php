<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budget')->insert([
            [
                'dv_no' => '1230123',
                'drn_no' => 'DRN1234567890',
                'incomingDate' => '2024-08-25',
                'payee' => 'John Doe Enterprises',
                'particulars' => 'Office supplies purchase',
                'etal' => null,
                'program' => 'General Administration',
                'budget_controller' => 'Jane Smith',
                'gross_amount' => 2500.00,
                'final_amount_norsa' => 2400.00,
                'fund_cluster' => '101',
                'appropriation' => 'General Expenses',
                'remarks' => 'Urgent delivery required',
                'orsNum' => 'ORS98765',
                'outgoingDate' => '2024-08-30',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            

            // Add more sample entries as neededa
        ]);
    }
}

