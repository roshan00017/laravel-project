<?php

namespace Database\Seeders;

use App\Facades\NepaliDate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->truncate();
        $rows = [
            [
                'fy_id' => 1,
                'client_id' => 20,
                'title' => 'intentions of award of contract',
                'tag' => 'सूचना तथा समाचार',
                'file' => '<img typeof="foaf:Image" src="https://thulungdudhkoshimun.gov.np/sites/thulungdudhkoshimun.gov.np/files/intentions%20of%20award%20of%20contract.jpg" width="683" height="910" alt="" />',
                'added_date_ad' => Carbon::now(),
                'added_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
            ],
            [
                'fy_id' => 1,
                'client_id' => 20,
                'title' => 'नदिजन्य पदार्थ उत्खनन र संकलनमा प्रतिवन्ध लगाईएको सम्बन्धी सूचना',
                'tag' => 'सूचना तथा समाचार',
                'file' => '<img typeof="foaf:Image" src="https://thulungdudhkoshimun.gov.np/sites/thulungdudhkoshimun.gov.np/files/IMG_20230328_0001.jpg" width="644" height="910" alt="" />',
                'added_date_ad' => Carbon::now(),
                'added_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
            ],
        ];
        DB::table('notices')->insert($rows);
    }
}
