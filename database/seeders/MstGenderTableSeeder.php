<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstGenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_gender')->truncate();
        $rows = [
            [
                'client_id' => '1',
                'code' => 'FE',
                'name_en' => 'Female',
                'name_np' => 'महिला',
            ],
            [
                'client_id' => '1',
                'code' => 'MA',
                'name_en' => 'Male',
                'name_np' => 'पुरुष',
            ],
            [
                'client_id' => '1',
                'code' => 'OT',
                'name_en' => 'Other',
                'name_np' => 'अन्य',
            ],
        ];
        DB::table('mst_gender')->insert($rows);
    }
}
