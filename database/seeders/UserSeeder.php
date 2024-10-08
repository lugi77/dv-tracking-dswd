<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            [
                'name' => 'Admin',
                'email' => 'luigillorando7@gmail.com',
                'dswd_id' => '2020-00194',
                'section' => '0',
                'is_approved' => '1',
                'password' => bcrypt('12345678')
            ],

            [
                'name' => 'Luigi N. Llorando',
                'email' => 'llorandomario@gmail.com',
                'dswd_id' => '2020-00111',
                'section' => '1',
                'is_approved' => '1',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'Frances Manalo',
                'email' => 'cashunit1002@gmail.com',
                'dswd_id' => '2020-00222',
                'section' => '2',
                'is_approved' => '1',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'Sydrick Acaba',
                'email' => 'lnllorando@usep.edu.ph',
                'dswd_id' => '2020-00333',
                'section' => '3',
                'is_approved' => '1',
                'password' => bcrypt('12345678')
            ],
           
            // Add more sample data as needed
            ]);
        
    }
}
