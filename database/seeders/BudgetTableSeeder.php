<?php

namespace Database\Seeders;

use App\Models\Budget;
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
        Budget::factory()->count(12)->create();
    }
}

