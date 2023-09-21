<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_department')->truncate();
        $rows = [
            [
                'code' => '1',
                'name_en' => 'Account Department',
                'name_np' => 'लेखा विभाग',
                'status' => true,
            ],
            [
                'code' => '6',
                'name_en' => 'Technology Department',
                'name_np' => 'प्रविधि विभाग',
                'status' => true,
            ],
        ];
        DB::table('mst_department')->insert($rows);

    }
}
