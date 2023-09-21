<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DcOfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dc_office')->truncate();
        $rows = [
            [
                'code' => '001',
                'name_en' => 'Center Office......',
                'name_np' => 'थुलुङ दुधकाेशी गाउँपालिका गाउँकार्यपालिकाकाे कार्यालय मुक्ली',
                'status' => true,
            ],
            [
                'code' => '002',
                'name_en' => 'Ward no 1 Office',
                'name_np' => 'थुलुङ दुधकाेशी गाउँपालिका 1 नं वडा कार्यालय',
                'status' => true,
            ],
        ];
        DB::table('dc_office')->insert($rows);
    }
}
