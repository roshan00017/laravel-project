<?php

namespace Database\Seeders;

use App\Models\Calendar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendars')->truncate();
        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '06',
            'day' => 1,
            'full_date' => '2080-01-1',
            'full_date_en' => '2023-4-14',
            'status' => true,
            'created_at' => '2023-05-09 13:58:44',
            'updated_at' => '2023-05-09 13:58:44',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '07',
            'day' => 2,
            'full_date' => '2080-01-2',
            'full_date_en' => '2023-4-15',
            'status' => true,
            'created_at' => '2023-05-09 13:58:44',
            'updated_at' => '2023-05-09 13:58:44',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '01',
            'day' => 3,
            'full_date' => '2080-01-3',
            'full_date_en' => '2023-4-16',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '02',
            'day' => 4,
            'full_date' => '2080-01-4',
            'full_date_en' => '2023-4-17',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '03',
            'day' => 5,
            'full_date' => '2080-01-5',
            'full_date_en' => '2023-4-18',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '04',
            'day' => 6,
            'full_date' => '2080-01-6',
            'full_date_en' => '2023-4-19',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '04',
            'day' => 7,
            'full_date' => '2080-01-7',
            'full_date_en' => '2023-4-20',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '06',
            'day' => 8,
            'full_date' => '2080-01-8',
            'full_date_en' => '2023-4-21',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '07',
            'day' => 9,
            'full_date' => '2080-01-9',
            'full_date_en' => '2023-4-22',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '01',
            'day' => 10,
            'full_date' => '2080-01-10',
            'full_date_en' => '2023-4-23',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '02',
            'day' => 11,
            'full_date' => '2080-01-11',
            'full_date_en' => '2023-4-24',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '03',
            'day' => 12,
            'full_date' => '2080-01-12',
            'full_date_en' => '2023-4-25',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '04',
            'day' => 13,
            'full_date' => '2080-01-13',
            'full_date_en' => '2023-4-26',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '04',
            'day' => 14,
            'full_date' => '2080-01-14',
            'full_date_en' => '2023-4-27',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '06',
            'day' => 15,
            'full_date' => '2080-01-15',
            'full_date_en' => '2023-4-28',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '07',
            'day' => 16,
            'full_date' => '2080-01-16',
            'full_date_en' => '2023-4-29',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '01',
            'day' => 17,
            'full_date' => '2080-01-17',
            'full_date_en' => '2023-4-30',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '02',
            'day' => 18,
            'full_date' => '2080-01-18',
            'full_date_en' => '2023-5-1',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '03',
            'day' => 19,
            'full_date' => '2080-01-19',
            'full_date_en' => '2023-5-2',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '04',
            'day' => 20,
            'full_date' => '2080-01-20',
            'full_date_en' => '2023-5-3',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '04',
            'day' => 21,
            'full_date' => '2080-01-21',
            'full_date_en' => '2023-5-4',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '06',
            'day' => 22,
            'full_date' => '2080-01-22',
            'full_date_en' => '2023-5-5',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '07',
            'day' => 23,
            'full_date' => '2080-01-23',
            'full_date_en' => '2023-5-6',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '01',
            'day' => 24,
            'full_date' => '2080-01-24',
            'full_date_en' => '2023-5-7',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '02',
            'day' => 25,
            'full_date' => '2080-01-25',
            'full_date_en' => '2023-5-8',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '03',
            'day' => 26,
            'full_date' => '2080-01-26',
            'full_date_en' => '2023-5-9',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '04',
            'day' => 27,
            'full_date' => '2080-01-27',
            'full_date_en' => '2023-5-10',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '04',
            'day' => 28,
            'full_date' => '2080-01-28',
            'full_date_en' => '2023-5-11',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '06',
            'day' => 29,
            'full_date' => '2080-01-29',
            'full_date_en' => '2023-5-12',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '07',
            'day' => 30,
            'full_date' => '2080-01-30',
            'full_date_en' => '2023-5-13',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '01',
            'week_day_code' => '01',
            'day' => 31,
            'full_date' => '2080-01-31',
            'full_date_en' => '2023-5-14',
            'status' => true,
            'created_at' => '2023-05-09 13:58:45',
            'updated_at' => '2023-05-09 13:58:45',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '02',
            'day' => 1,
            'full_date' => '2080-02-1',
            'full_date_en' => '2023-5-15',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '03',
            'day' => 2,
            'full_date' => '2080-02-2',
            'full_date_en' => '2023-5-16',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 3,
            'full_date' => '2080-02-3',
            'full_date_en' => '2023-5-17',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 4,
            'full_date' => '2080-02-4',
            'full_date_en' => '2023-5-18',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '06',
            'day' => 5,
            'full_date' => '2080-02-5',
            'full_date_en' => '2023-5-19',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '07',
            'day' => 6,
            'full_date' => '2080-02-6',
            'full_date_en' => '2023-5-20',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '01',
            'day' => 7,
            'full_date' => '2080-02-7',
            'full_date_en' => '2023-5-21',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '02',
            'day' => 8,
            'full_date' => '2080-02-8',
            'full_date_en' => '2023-5-22',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '03',
            'day' => 9,
            'full_date' => '2080-02-9',
            'full_date_en' => '2023-5-23',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 10,
            'full_date' => '2080-02-10',
            'full_date_en' => '2023-5-24',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 11,
            'full_date' => '2080-02-11',
            'full_date_en' => '2023-5-25',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '06',
            'day' => 12,
            'full_date' => '2080-02-12',
            'full_date_en' => '2023-5-26',
            'status' => true,
            'created_at' => '2023-05-09 14:03:41',
            'updated_at' => '2023-05-09 14:03:41',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '07',
            'day' => 13,
            'full_date' => '2080-02-13',
            'full_date_en' => '2023-5-27',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '01',
            'day' => 14,
            'full_date' => '2080-02-14',
            'full_date_en' => '2023-5-28',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '02',
            'day' => 15,
            'full_date' => '2080-02-15',
            'full_date_en' => '2023-5-29',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '03',
            'day' => 16,
            'full_date' => '2080-02-16',
            'full_date_en' => '2023-5-30',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 17,
            'full_date' => '2080-02-17',
            'full_date_en' => '2023-5-31',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 18,
            'full_date' => '2080-02-18',
            'full_date_en' => '2023-6-1',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '06',
            'day' => 19,
            'full_date' => '2080-02-19',
            'full_date_en' => '2023-6-2',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '07',
            'day' => 20,
            'full_date' => '2080-02-20',
            'full_date_en' => '2023-6-3',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '01',
            'day' => 21,
            'full_date' => '2080-02-21',
            'full_date_en' => '2023-6-4',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '02',
            'day' => 22,
            'full_date' => '2080-02-22',
            'full_date_en' => '2023-6-5',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '03',
            'day' => 23,
            'full_date' => '2080-02-23',
            'full_date_en' => '2023-6-6',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 24,
            'full_date' => '2080-02-24',
            'full_date_en' => '2023-6-7',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 25,
            'full_date' => '2080-02-25',
            'full_date_en' => '2023-6-8',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '06',
            'day' => 26,
            'full_date' => '2080-02-26',
            'full_date_en' => '2023-6-9',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '07',
            'day' => 27,
            'full_date' => '2080-02-27',
            'full_date_en' => '2023-6-10',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '01',
            'day' => 28,
            'full_date' => '2080-02-28',
            'full_date_en' => '2023-6-11',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '02',
            'day' => 29,
            'full_date' => '2080-02-29',
            'full_date_en' => '2023-6-12',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '03',
            'day' => 30,
            'full_date' => '2080-02-30',
            'full_date_en' => '2023-6-13',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 31,
            'full_date' => '2080-02-31',
            'full_date_en' => '2023-6-14',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '02',
            'week_day_code' => '04',
            'day' => 32,
            'full_date' => '2080-02-32',
            'full_date_en' => '2023-6-15',
            'status' => true,
            'created_at' => '2023-05-09 14:03:42',
            'updated_at' => '2023-05-09 14:03:42',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '06',
            'day' => 1,
            'full_date' => '2080-03-1',
            'full_date_en' => '2023-6-16',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '07',
            'day' => 2,
            'full_date' => '2080-03-2',
            'full_date_en' => '2023-6-17',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '01',
            'day' => 3,
            'full_date' => '2080-03-3',
            'full_date_en' => '2023-6-18',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '02',
            'day' => 4,
            'full_date' => '2080-03-4',
            'full_date_en' => '2023-6-19',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '03',
            'day' => 5,
            'full_date' => '2080-03-5',
            'full_date_en' => '2023-6-20',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '04',
            'day' => 6,
            'full_date' => '2080-03-6',
            'full_date_en' => '2023-6-21',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '04',
            'day' => 7,
            'full_date' => '2080-03-7',
            'full_date_en' => '2023-6-22',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '06',
            'day' => 8,
            'full_date' => '2080-03-8',
            'full_date_en' => '2023-6-23',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '07',
            'day' => 9,
            'full_date' => '2080-03-9',
            'full_date_en' => '2023-6-24',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '01',
            'day' => 10,
            'full_date' => '2080-03-10',
            'full_date_en' => '2023-6-25',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '02',
            'day' => 11,
            'full_date' => '2080-03-11',
            'full_date_en' => '2023-6-26',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '03',
            'day' => 12,
            'full_date' => '2080-03-12',
            'full_date_en' => '2023-6-27',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '04',
            'day' => 13,
            'full_date' => '2080-03-13',
            'full_date_en' => '2023-6-28',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '04',
            'day' => 14,
            'full_date' => '2080-03-14',
            'full_date_en' => '2023-6-29',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '06',
            'day' => 15,
            'full_date' => '2080-03-15',
            'full_date_en' => '2023-6-30',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '07',
            'day' => 16,
            'full_date' => '2080-03-16',
            'full_date_en' => '2023-7-1',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '01',
            'day' => 17,
            'full_date' => '2080-03-17',
            'full_date_en' => '2023-7-2',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '02',
            'day' => 18,
            'full_date' => '2080-03-18',
            'full_date_en' => '2023-7-3',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '03',
            'day' => 19,
            'full_date' => '2080-03-19',
            'full_date_en' => '2023-7-4',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '04',
            'day' => 20,
            'full_date' => '2080-03-20',
            'full_date_en' => '2023-7-5',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '04',
            'day' => 21,
            'full_date' => '2080-03-21',
            'full_date_en' => '2023-7-6',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '06',
            'day' => 22,
            'full_date' => '2080-03-22',
            'full_date_en' => '2023-7-7',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '07',
            'day' => 23,
            'full_date' => '2080-03-23',
            'full_date_en' => '2023-7-8',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '01',
            'day' => 24,
            'full_date' => '2080-03-24',
            'full_date_en' => '2023-7-9',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '02',
            'day' => 25,
            'full_date' => '2080-03-25',
            'full_date_en' => '2023-7-10',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '03',
            'day' => 26,
            'full_date' => '2080-03-26',
            'full_date_en' => '2023-7-11',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '04',
            'day' => 27,
            'full_date' => '2080-03-27',
            'full_date_en' => '2023-7-12',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '04',
            'day' => 28,
            'full_date' => '2080-03-28',
            'full_date_en' => '2023-7-13',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '06',
            'day' => 29,
            'full_date' => '2080-03-29',
            'full_date_en' => '2023-7-14',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '07',
            'day' => 30,
            'full_date' => '2080-03-30',
            'full_date_en' => '2023-7-15',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);

        Calendar::create([
            'fy_code' => '2080',
            'month_code' => '03',
            'week_day_code' => '01',
            'day' => 31,
            'full_date' => '2080-03-31',
            'full_date_en' => '2023-7-16',
            'status' => true,
            'created_at' => '2023-05-09 14:07:53',
            'updated_at' => '2023-05-09 14:07:53',
            'deleted_at' => null,
        ]);
    }
}
