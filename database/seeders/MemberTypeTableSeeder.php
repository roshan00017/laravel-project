<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member_types')->truncate();
        $rows = [
            [
                'code' => 1,
                'name_en' => 'President',
                'name_np' => 'अध्यक्ष',
                'description' => '',
                'status' => 'सक्रिय',
            ],
            [
                'code' => 2,
                'name_en' => 'Adhyakchya',
                'name_np' => 'अध्यक्ष',
                'description' => '',
                'status' => 'निस्क्रिय',
            ],
            [
                'code' => 3,
                'name_en' => 'Sachib',
                'name_np' => 'सचिव',
                'description' => '',
                'status' => 'सक्रिय',
            ],
            [
                'code' => 4,
                'name_en' => 'Kosha adhkshya',
                'name_np' => 'कोषाध्यक्ष',
                'description' => '',
                'status' => 'सक्रिय',
            ],
            [
                'code' => 5,
                'name_en' => 'sadasya',
                'name_np' => 'सदस्य',
                'description' => '',
                'status' => 'सक्रिय',
            ],
            [
                'code' => 61,
                'name_en' => 'sachib',
                'name_np' => 'अनुगमन समिति सदस्य सचिव',
                'description' => 'अनुगमन समिति',
                'status' => 'सक्रिय',
            ],
            [
                'code' => 62,
                'name_en' => 'Amantrit',
                'name_np' => 'आमन्त्रित',
                'description' => 'अनुगमन समिति',
                'status' => 'सक्रिय',
            ],
            [
                'code' => 63,
                'name_en' => 'Pra a',
                'name_np' => 'प्र॰अ॰',
                'description' => '',
                'status' => 'सक्रिय',
            ],
            [
                'code' => 66,
                'name_np' => 'मेयर ',
                'name_en' => 'Mayor',
                'description' => '',
                'status' => 'सक्रिय',
            ],
            [
                'code' => 67,
                'name_np' => 'उप मेयर ',
                'name_en' => 'Deputy Mayor',
                'description' => '',
                'status' => 'सक्रिय',
            ],
        ];
        DB::table('member_types')->insert($rows);
    }
}
