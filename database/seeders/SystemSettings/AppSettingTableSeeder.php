<?php

namespace Database\Seeders\SystemSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_settings')->truncate();
        $rows = [
            [
                'app_name' => 'e-Office',
                'app_name_np' => 'ई-कार्यालय',
                'app_short_name' => 'e-office',
                'app_short_name_np' => 'ई-कार्यालय',
                'login_attempt_limit' => '5',
                'login_title' => 'Sign In to start your session',
                'login_title_np' => 'तपाईंको सत्र सुरू गर्न कृपया लगईन गर्नुहोस्',
                'session_expire_time' => 60,
            ],
        ];
        DB::table('app_settings')->insert($rows);
    }
}
