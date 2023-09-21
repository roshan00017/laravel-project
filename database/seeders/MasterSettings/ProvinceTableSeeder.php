<?php

namespace Database\Seeders\MasterSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->truncate();
        $rows = [
            [
                'name_en' => 'Koshi Pradesh',
                'name_np' => 'कोशी  प्रदेश',
                'code' => 1,

            ],
            [
                'name_en' => 'Madhesh Province',
                'name_np' => 'मधेश प्रदेश',
                'code' => 2,

            ],
            [
                'name_en' => 'Bagmati Province',
                'name_np' => 'बागमती प्रदेश',
                'code' => 3,

            ],
            [
                'name_en' => 'Gandaki Province',
                'name_np' => 'गण्डकी प्रदेश',
                'code' => 4,

            ],
            [
                'name_en' => 'Lumbini Province',
                'name_np' => 'लुम्बिनी प्रदेश',
                'code' => 5,

            ],
            [
                'name_en' => 'Karnali Province',
                'name_np' => 'कर्णाली प्रदेश',
                'code' => 6,

            ],
            [
                'name_en' => 'Sudurpashchim Province',
                'name_np' => 'सुदूरपश्चिम प्रदेश',
                'code' => 7,

            ],
        ];
        DB::table('provinces')->insert($rows);
    }
}
