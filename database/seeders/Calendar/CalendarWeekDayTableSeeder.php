<?php

namespace Database\Seeders\Calendar;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarWeekDayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendar_week_days')->truncate();
        $rows = [
            [
                'name_np' => 'आइतबार',
                'name_en' => 'Sunday',
                'code' => '01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'सोमबार',
                'name_en' => 'Monday',
                'code' => '02',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'मंगलबार',
                'name_en' => 'Tuesday',
                'code' => '03',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'बुधबार',
                'name_en' => 'Wednesday',
                'code' => '04',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'बिहीबार',
                'name_en' => 'Thursday',
                'code' => '05',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'शुक्रबार',
                'name_en' => 'Friday',
                'code' => '06',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_np' => 'शनिबार',
                'name_en' => 'Saturday',
                'code' => '07',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        DB::table('calendar_week_days')->insert($rows);
    }
}
