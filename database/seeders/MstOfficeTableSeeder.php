<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstOfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_offices')->truncate();
        $rows = [
            [
                'code' => 'OF',
                'name' => '1 No. Ward',
                'name_ne' => 'थ१ नं. वार्ड कार्यालय ',
                'status' => true,
            ],
        ];
        DB::table('mst_offices')->insert($rows);
    }
}
