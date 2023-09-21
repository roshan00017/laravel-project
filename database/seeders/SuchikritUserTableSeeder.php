<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuchikritUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suchikrit_users')->truncate();
        $rows = [

            [
                'full_name_np' => 'Test User',
                'full_name_en' => '	परीक्षण प्रयोगकर्ता',
                'user_name' => 'user',
                'email' => 'user@test.com',
                'mobile_no' => 1234567564,
                'password' => bcrypt('User#23'),
                'password_status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        DB::table('suchikrit_users')->insert($rows);
    }
}
