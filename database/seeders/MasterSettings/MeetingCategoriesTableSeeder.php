<?php

namespace Database\Seeders\MasterSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetingCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_meeting_categories')->truncate();
        $rows = [

            [
                'code' => 01,
                'name_np' => 'वडापालिका',
                'name_en' => 'Ward Palika',

            ],
            [
                'code' => 02,
                'name_np' => 'कार्यपालिका',
                'name_en' => 'Karya Palika',

            ],
        ];
        DB::table('mst_meeting_categories')->insert($rows);
    }
}
