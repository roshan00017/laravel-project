<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->truncate();
        $rows = [

            [
                'code' => 1,
                'name_np' => 'Prabhu Bank',
                'name_en' => 'Prabhu Bank',
            ],

        ];
        DB::table('banks')->insert($rows);
    }
}
