<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintSourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complaint_sources')->truncate();
        $rows = [
            [
                'code' => 'SK',
                'name' => 'Skype',
                'name_ne' => 'Skype',
                'status' => true,
            ],
            [
                'code' => 'SMS',
                'name' => 'SMS',
                'name_ne' => 'SMS',
                'status' => true,
            ],
            [
                'code' => 'TW',
                'name' => 'Twitter',
                'name_ne' => 'Twitter',
                'status' => true,
            ],

            [
                'code' => 'FB',
                'name' => 'Facebook',
                'name_ne' => 'Facebook',
                'status' => true,
            ],
            [
                'code' => 'NCALL',
                'name' => 'National Call',
                'name_ne' => 'National Call',
                'status' => true,
            ],
            [
                'code' => 'ICALL',
                'name' => 'International Call',
                'name_ne' => 'International Call',
                'status' => true,
            ],
            [
                'code' => 'WEBSITE',
                'name' => 'Website',
                'name_ne' => 'Website',
                'status' => true,
            ],
            [
                'code' => 'Appointment',
                'name' => 'Appointment',
                'name_ne' => 'भेटघाट',
                'status' => true,
            ],
        ];
        DB::table('complaint_sources')->insert($rows);
    }
}
