<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElectedPersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('elected_persons')->truncate();
        $rows = [
            [
                'name_np' => 'हरि बहादुर',
                'name_en' => 'Hari Bahadur',
                'halko_bhu_pu' => 'pre',
                'hr_designation_id' => 9,
                'tenure_start_date' => '2023-01-01',
                'tenure_end_date' => null,
                'email' => 'hari@example.com',
                'mobile' => 9876543210,
                'status' => true,
            ],
            [
                'name_np' => 'मोहना श्रेष्ठ',
                'name_en' => 'Mohana Shrestha',
                'halko_bhu_pu' => 'pre',
                'hr_designation_id' => 10,
                'tenure_start_date' => '2023-01-01',
                'tenure_end_date' => null,
                'email' => 'mohana@example.com',
                'mobile' => 984111111,
                'status' => true,
            ],
        ];
        DB::table('elected_persons')->insert($rows);

    }
}
