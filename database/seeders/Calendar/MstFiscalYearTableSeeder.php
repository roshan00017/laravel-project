<?php

namespace Database\Seeders\Calendar;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstFiscalYearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_fiscal_year')->truncate();
        $rows = [
            [
                'client_id' => '1',
                'code' => '2079/2080',
                'date_from_bs' => '2079/04/01',
                'date_from_ad' => '2022-07-17',
                'date_to_bs' => '2080/03/31',
                'date_to_ad' => '2023-07-16',
                'status' => true,
            ],

        ];
        DB::table('mst_fiscal_year')->insert($rows);
    }
}
