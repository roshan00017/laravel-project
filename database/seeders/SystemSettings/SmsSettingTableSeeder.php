<?php

namespace Database\Seeders\SystemSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmsSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sms_settings')->truncate();
        $rows = [
            [
                'sms_token' => 'v2_XdQGZBTY6MaqxKVTmZGf6erwEk5.8UBT',
                'sms_from' => 'InfoSMS',
                'sms_provider_name' => 'SPARROW',
            ],
        ];
        DB::table('sms_settings')->insert($rows);
    }
}
