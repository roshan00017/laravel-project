<?php

namespace Database\Seeders\SystemSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtpSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('otp_settings')->truncate();
        $rows = [
            [
                'otp_limit' => 5,
                'otp_duration' => 10,
            ],
        ];
        DB::table('otp_settings')->insert($rows);
    }
}
