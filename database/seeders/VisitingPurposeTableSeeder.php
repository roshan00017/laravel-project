<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitingPurposeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visiting_purposes')->truncate();
        $rows = [
            [
                'code' => '1',
                'name_en' => 'Special Discussion',
                'name_np' => 'बिशेष छलफल',
                'status' => true,
            ],
            [
                'code' => '2',
                'name' => 'Complaint discussion',
                'name_ne' => 'गुनासो छलफल',
                'status' => true,
            ],
        ];
        DB::table('visiting_purposes')->insert($rows);
    }
}
