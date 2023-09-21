<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_categories')->truncate();
        $rows = [
            [
                'code' => '1',
                'name' => 'Water Supply',
                'name_ne' => 'खाने पानी',
                'status' => true,
            ],
            [
                'code' => '2',
                'name' => 'Road',
                'name_ne' => 'सडक',
                'status' => true,
            ],
            [
                'code' => '3',
                'name' => 'Appointment',
                'name_ne' => 'भेटघाट',
                'status' => true,
            ],
        ];
        DB::table('form_categories')->insert($rows);
    }
}
