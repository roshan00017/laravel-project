<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeverityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('severity_types')->truncate();
        $rows = [
            [
                'code' => 'M',
                'name' => 'Medium',
                'name_ne' => 'जरुरी ',
                'status' => true,
            ],
            [
                'code' => 'N',
                'name' => 'Normal',
                'name_ne' => 'साधारण',
                'status' => true,
            ],
            [
                'code' => 'N',
                'name' => 'Urgent',
                'name_ne' => 'अति जरुरी',
                'status' => true,
            ],
            [
                'code' => 'N',
                'name' => 'Urgent',
                'name_ne' => 'ब्लकर',
                'status' => true,
            ],
        ];
        DB::table('severity_types')->insert($rows);
    }
}
