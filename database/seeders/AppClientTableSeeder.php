<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_client')->truncate();
        $rows = [
            [
                'id' => 19,
                'code' => 'namuna',
                'name_en' => 'Namuna Municipality',
                'name_np' => 'नमुना नगरपालिका',
                'web_url' => 'http://127.0.0.1:8000',
                'api_web_url' => 'https://suryabinayakmun.gov.np',
                'local_body_mapping_id' => 1,
            ],
            [
                'id' => 20,
                'code' => 'panauti',
                'name_en' => 'Panauti Municipality',
                'name_np' => 'पनौती नगरपालिका',
                'web_url' => 'https://panautimun.gov.np/',
                'api_web_url' => 'https://panautimun.gov.np/',
                'local_body_mapping_id' => 354,
            ],
        ];
        DB::table('app_client')->insert($rows);
    }
}
