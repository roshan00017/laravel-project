<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_country')->truncate();
        $rows = [
            [
                'code' => 'NEP',
                'name_en' => 'Nepal',
                'name_np' => 'नेपाल',
                'status' => true,
            ],
            [
                'code' => '2',
                'name' => 'India',
                'name_ne' => 'इन्डिया',
                'status' => true,
            ],
        ];
        DB::table('mst_country')->insert($rows);
    }
}
