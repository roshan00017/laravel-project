<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DcLetterSendingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dc_medium')->truncate();
        $rows = [
            [
                'code' => 'PO',
                'name_en' => 'Post Office',
                'name_np' => 'हुलाक',
            ],
            [
                'code' => 'C',
                'name_en' => 'Curiyar',
                'name_np' => 'कुरियर',
            ],
            [
                'code' => 'BS',
                'name_en' => 'By staff',
                'name_np' => 'कार्यालय सहयोगी मार्फत',
            ],
            [
                'code' => 'BM',
                'name_en' => 'By Mail',
                'name_np' => 'इमेल मार्फत',
            ],
            [
                'code' => 'FX',
                'name_en' => 'By Fax',
                'name_np' => 'Fax ',
            ],
        ];
        DB::table('dc_medium')->insert($rows);
    }
}
