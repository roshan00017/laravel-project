<?php

namespace Database\Seeders\SystemSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mail_settings')->truncate();
        $rows = [
            [
                'mail_driver' => 'smtp',
                'client_id' => 20,
                'mail_host_name' => 'sandbox.smtp.mailtrap.io',
                'mail_port' => '2525',
                'mail_user_name' => '70c1d6b37e70b3',
                'mail_password' => '46dd75cdc0efb9',
                'mail_encryption' => 'tls',
                'mail_from_address' => 'support@admin.com',
            ],
        ];
        DB::table('mail_settings')->insert($rows);
    }
}
