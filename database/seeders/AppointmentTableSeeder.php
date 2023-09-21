<?php

namespace Database\Seeders;

use App\Facades\NepaliDate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'fy_id' => 1,
                'appointment_status' => 1,
                'appointment_date_ad' => Carbon::now(),
                'appointment_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'appointment_month_code' => 2,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'appointment_status' => 2,
                'appointment_date_ad' => Carbon::now(),
                'appointment_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'appointment_month_code' => 3,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'appointment_status' => 1,
                'appointment_date_ad' => Carbon::now(),
                'appointment_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'appointment_month_code' => 3,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'appointment_status' => 1,
                'appointment_date_ad' => Carbon::now(),
                'appointment_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'appointment_month_code' => 2,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'appointment_status' => 2,
                'appointment_date_ad' => Carbon::now(),
                'appointment_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'appointment_month_code' => 3,

            ],
        ];
        DB::table('appointments')->insert($rows);
        //
    }
}
