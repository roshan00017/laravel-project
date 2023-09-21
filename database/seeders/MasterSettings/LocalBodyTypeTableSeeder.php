<?php

namespace Database\Seeders\MasterSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalBodyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('local_body_types')->truncate();
        $rows = [
            [
                'name_np' => 'महानगरपालिका',
                'name_en' => 'Metropolitan Municipality',
            ],
            [
                'name_np' => 'उपमहानगरपालिका',
                'name_en' => 'Sub Metropolitan Municipality',
            ],
            [
                'name_np' => 'नगरपालिका',
                'name_en' => 'Municipality',
            ],
            [
                'name_np' => 'गाउँपालिका',
                'name_en' => 'Rural municipality',
            ],
        ];
        DB::table('local_body_types')->insert($rows);
    }
}
