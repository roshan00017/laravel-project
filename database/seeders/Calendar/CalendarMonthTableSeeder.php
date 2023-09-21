<?php

namespace Database\Seeders\Calendar;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarMonthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendar_months')->truncate();
        $rows = [
            [
                'name_np' => 'वैशाख',
                'name_en' => 'Baishakh',
                'code' => '01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'जेठ',
                'name_en' => 'Jestha',
                'code' => '02',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'आषाढ',
                'name_en' => 'Ashad',
                'code' => '03',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'श्रावण',
                'name_en' => 'Shrawan',
                'code' => '04',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'भाद्र',
                'name_en' => 'Bhadra',
                'code' => '05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'असोज',
                'name_en' => 'Ashwin',
                'code' => '06',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'कार्तिक',
                'name_en' => 'Kartik',
                'code' => '07',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'मङ्गसिर',
                'name_en' => 'Mangsir',
                'code' => '08',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'पौष',
                'name_en' => 'Paush',
                'code' => '09',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'माघ',
                'name_en' => 'Magh',
                'code' => '10',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'फाल्गुन',
                'name_en' => 'Falgun',
                'code' => '11',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'चैत्र',
                'name_en' => 'Chaitra',
                'code' => '12',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        DB::table('calendar_months')->insert($rows);
    }
}
