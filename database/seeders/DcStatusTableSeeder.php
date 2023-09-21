<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DcStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dc_status')->truncate();
        $rows = [
            [
                'name_en' => 'Work Completion',
                'name_np' => 'कार्य सम्पन्न भएको',
                'status' => true,
            ],
            [
                'name_en' => 'Recommendation Letter',
                'name_np' => 'सिफारिस गरिएको',
                'status' => true,
            ],
            [
                'name_en' => 'Particulars',
                'name_np' => 'विवरण पठाइएको वारे',
                'status' => true,
            ],
            [
                'name_en' => 'Technological and Financial Proposal Demand',
                'name_np' => 'प्राविधिक तथा आर्थिक प्रस्ताब माग गरिएको',
                'status' => true,
            ],
            [
                'name_en' => 'Work In Process',
                'name_np' => 'सम्बन्धित शाखामा पठाईएको',
                'status' => true,
            ],
            [
                'name_en' => 'Letter to Client',
                'name_np' => 'पत्राचार गरिएको',
                'status' => true,
            ],

        ];
        DB::table('dc_status')->insert($rows);
    }
}
