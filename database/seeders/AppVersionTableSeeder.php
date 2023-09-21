<?php

namespace Database\Seeders;

use App\Facades\NepaliDate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppVersionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_versions')->truncate();
        $rows = [
            [
                'version_update_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'version_update_date_en' => Carbon::now()->toDateString(),
                'version_number' => 0,
                'version_module' => 1,
                'version_prefix' => date('dmY'),
                'latest_version' => date('dmy').' '.'1'.'.'.'0',
            ],
        ];
        DB::table('app_versions')->insert($rows);
    }
}
