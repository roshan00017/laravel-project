<?php

namespace Database\Seeders;

use App\Facades\NepaliDate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->truncate();
        $rows = [
            [
                'title_en' => 'Emergency',
                'title_np' => 'आपतकालीन',
                'notify_url' => 'eme.doc.np',
                'notify_type' => 'incident',
                'notify_date_en' => Carbon::now(),
                'notify_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'notification_read_date_en' => Carbon::now(),
                'notification_read_date_np' => NepaliDate::create(Carbon::now())->toBS(),
            ],
            [
                'title_en' => 'Late Service',
                'title_np' => 'ढिलो सेवा',
                'notify_url' => 'serv.doc.np',
                'notify_type' => 'complaint',
                'notify_date_en' => Carbon::now(),
                'notify_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'notification_read_date_en' => Carbon::now(),
                'notification_read_date_np' => NepaliDate::create(Carbon::now())->toBS(),

            ],
        ];
        DB::table('notifications')->insert($rows);
    }
}
