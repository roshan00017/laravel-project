<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_setting')->truncate();
        $rows = [
            [
                'name_en' => 'Voice Record Api Url',
                'name_np' => 'Voice Record Api Url',
                'code' => 'VRAU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Voice Record Api Token',
                'name_np' => 'Voice Record Api Token',
                'code' => 'VRAT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Voice Record Api Voice Type',
                'name_np' => 'Voice Record Api Voice Type',
                'code' => 'VRAVT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Call SMS Api Url',
                'name_np' => 'Call SMS Api Url',
                'code' => 'CSAU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Call SMS Api User Name',
                'name_np' => 'Call SMS Api User Name',
                'code' => 'CSAUN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Call SMS Api User Password',
                'name_np' => 'Call SMS Api User Password',
                'code' => 'CSAUP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Facebook Link',
                'name_np' => 'Facebook Link',
                'code' => 'FB',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Skype Link',
                'name_np' => 'Skype Link',
                'code' => 'SK',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Twitter Link',
                'name_np' => 'Twitter Link',
                'code' => 'TW',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Instagram Link',
                'name_np' => 'Instagram Link',
                'code' => 'INS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Youtube Link',
                'name_np' => 'Youtube Link',
                'code' => 'YT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Linkedin Link',
                'name_np' => 'Linkedin Link',
                'code' => 'LK',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Whatsapp Link',
                'name_np' => 'Whatsapp Link',
                'code' => 'WS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Tiktok Link',
                'name_np' => 'Tiktok Link',
                'code' => 'TK',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Whatapp Integrate Api',
                'name_np' => 'Whatapp Integrate Api',
                'code' => 'WIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Messenger Integrate Api',
                'name_np' => 'Messenger Integrate Api',
                'code' => 'MIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Facebook Page Integrate Api',
                'name_np' => 'Facebook Page Integrate Api',
                'code' => 'FPIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Twitter Page Integrate Api',
                'name_np' => 'Twitter Page Integrate Api',
                'code' => 'TPIA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Chart Bot  Api Key',
                'name_np' => 'Chart Bot  Api Key',
                'code' => 'CBAK',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Chart Bot  Property ID',
                'name_np' => 'Chart Bot  Property ID',
                'code' => 'CBPI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Chart Bot  Widget ID',
                'name_np' => 'Chart Bot  Widget ID',
                'code' => 'CBWI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Web Url',
                'name_np' => 'Web Url',
                'code' => 'WU',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Phone',
                'name_np' => 'Phone',
                'code' => 'PH',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Email',
                'name_np' => 'Email',
                'code' => 'E',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name_en' => 'Message',
                'name_np' => 'Message',
                'code' => 'MS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('master_setting')->insert($rows);
    }
}
