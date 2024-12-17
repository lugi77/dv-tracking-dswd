<?php

namespace Database\Seeders;


use App\Models\Programs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of programs to be seeded
        $program = [
            ['program' => 'ADOPTION'],
            ['program' => 'AICS'],
            ['program' => 'ANGELS HAVEN'],
            ['program' => 'BANGUN'],
            ['program' => 'BFIRST'],
            ['program' => 'BTMS'],
            ['program' => 'CBB'],
            ['program' => 'CCAM'],
            ['program' => 'CCSN'],
            ['program' => 'CENTENARIAN'],
            ['program' => 'CENTER-FO RETENTION'],
            ['program' => 'CENTER (DR)'],
            ['program' => 'CLIMATE CHANGE'],
            ['program' => 'COMM BASED'],
            ['program' => 'COMPREHENSIVE'],
            ['program' => 'CRCF'],
            ['program' => 'DRRP'],
            ['program' => 'EPAHP'],
            ['program' => 'FO/PROGRAMS/CENTERS'],
            ['program' => 'FOOD STAMP'],
            ['program' => 'GASS'],
            ['program' => 'HA'],
            ['program' => 'HGW'],
            ['program' => 'HRMDD'],
            ['program' => 'ICTMS'],
            ['program' => 'INTERNAL AUDIT'],
            ['program' => 'ISSO'],
            ['program' => 'KC - KKB'],
            ['program' => 'KC NCDDP'],
            ['program' => 'KC PAMANA'],
            ['program' => 'KC PMNP'],
            ['program' => 'LED - SEC'],
            ['program' => 'LINGAP SA MASA'],
            ['program' => 'NHTSPR'],
            ['program' => 'PAMANA - PSB'],
            ['program' => 'PAMANA - SLP'],
            ['program' => 'PAMANA-DRMD'],
            ['program' => 'PANTAWID'],
            ['program' => 'PDPB'],
            ['program' => 'PDPS'],
            ['program' => 'PROPER'],
            ['program' => 'PWD'],
            ['program' => 'QRF'],
            ['program' => 'RRCY'],
            ['program' => 'RRPTP'],
            ['program' => 'RSCC'],
            ['program' => 'SFP'],
            ['program' => 'SLP'],
            ['program' => 'SMS'],
            ['program' => 'SOCPEN'],
            ['program' => 'SOCTECH'],
            ['program' => 'STANDARDS'],
            ['program' => 'STB'],
            ['program' => 'SWIDB'],
            ['program' => 'TARA'],
            ['program' => 'TCT'],
            ['program' => 'TRUST FUND'],
        ];
        // Insert each program into the dv_inventory table
        Programs::insert($program);
    }
}