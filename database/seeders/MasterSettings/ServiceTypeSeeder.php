<?php

namespace Database\Seeders\MasterSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_types')->truncate();
        $rows = [
            [
                'code' => '20235',
                'name_np' => 'सिफारिश',
                'name_en' => 'Recommendation',
            ],
            [
                'code' => '20236',
                'name_np' => 'कर',
                'name_en' => 'Tax',
            ],
        ];
        DB::table('service_types')->insert($rows);
    }
}
