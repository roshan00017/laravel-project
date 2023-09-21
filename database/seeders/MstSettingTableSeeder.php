<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_settings')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'label_np' => 'AUTOCODE_FISCALYEAR',
                'label_en' => 'AUTOCODE_FISCALYEAR',
                'value' => 'yes',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_id' => 20,
                'label_np' => 'AUTOCODE',
                'label_en' => 'AUTOCODE',
                'value' => 'yes',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_id' => 20,
                'label_np' => 'AUTOCODE_EDIT',
                'label_en' => 'AUTOCODE_EDIT',
                'value' => 'no',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_id' => 20,
                'label_np' => 'AUTOCODE_BRANCH',
                'label_en' => 'AUTOCODE_BRANCH',
                'value' => 'yes',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_id' => 20,
                'label_np' => 'AUTOCODE_WARD',
                'label_en' => 'AUTOCODE_WARD',
                'value' => 'no',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        DB::table('mst_settings')->insert($rows);
    }
}
