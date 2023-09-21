<?php

namespace Database\Seeders;

use App\Facades\NepaliDate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ComplaintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complaints')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'fy_id' => 1,
                'status' => 1,
                'complaint_month_code' => 3,
                'complaint_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'complaint_date_en' => Carbon::now(),

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'status' => 2,
                'complaint_month_code' => 3,
                'complaint_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'complaint_date_en' => Carbon::now(),

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'status' => 1,
                'complaint_month_code' => 2,
                'complaint_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'complaint_date_en' => Carbon::now(),

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'status' => 2,
                'complaint_month_code' => 1,
                'complaint_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'complaint_date_en' => Carbon::now(),

            ],
        ];
        DB::table('complaints')->insert($rows);
    }
}
