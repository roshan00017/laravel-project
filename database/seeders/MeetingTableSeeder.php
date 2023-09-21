<?php

namespace Database\Seeders;

use App\Facades\NepaliDate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meetings')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'fy_id' => 1,
                'meeting_category_id' => 2,
                'title' => 'बैठक शीर्षक',
                'code' => 'MT013',
                'proposed_date_ad' => Carbon::now(),
                'proposed_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'meeting_status_id' => 5,
                'meeting_time' => '19:27:00',
                'meeting_date_ad' => Carbon::now(),
                'meeting_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'meeting_month_code' => 2,
                'is_public' => true,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'meeting_category_id' => 1,
                'title' => 'शैक्षिक सम्वन्धी बैठक',
                'code' => 'MT014',
                'proposed_date_ad' => Carbon::now(),
                'proposed_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'meeting_status_id' => 1,
                'meeting_time' => '20:27:00',
                'meeting_date_ad' => Carbon::now(),
                'meeting_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'meeting_month_code' => 2,
                'is_public' => true,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'meeting_category_id' => 2,
                'title' => 'शैक्षिक सम्वन्धी बैठक',
                'code' => 'MT015',
                'proposed_date_ad' => Carbon::now(),
                'proposed_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'meeting_status_id' => 1,
                'meeting_time' => '21:17:00',
                'meeting_date_ad' => Carbon::now(),
                'meeting_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'meeting_month_code' => 2,
                'is_public' => true,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'meeting_category_id' => 2,
                'title' => 'सम्बन्धित बैठक भ्रमण गर्दै',
                'code' => 'MT016',
                'proposed_date_ad' => Carbon::now(),
                'proposed_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'meeting_status_id' => 2,
                'meeting_time' => '19:27:00',
                'meeting_date_ad' => Carbon::now(),
                'meeting_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'meeting_month_code' => 3,
                'is_public' => true,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'meeting_category_id' => 2,
                'title' => 'कार्यपालिकाको  सम्बन्धित बैठक',
                'code' => 'MT017',
                'proposed_date_ad' => Carbon::now(),
                'proposed_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'meeting_status_id' => 1,
                'meeting_time' => '19:27:00',
                'meeting_date_ad' => Carbon::now(),
                'meeting_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'meeting_month_code' => 3,
                'is_public' => true,

            ],
        ];
        DB::table('meetings')->insert($rows);
    }
}
