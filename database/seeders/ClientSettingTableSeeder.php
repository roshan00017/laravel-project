<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_setting')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'setting_code' => 'FB',
                'value' => 'https://www.facebook.com/',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'SK',
                'value' => 'https://www.skype.com/en/',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'TW',
                'value' => 'https://twitter.com/home',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'INS',
                'value' => 'https://www.instagram.com/',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'TK',
                'value' => 'https://www.tiktok.com/en/',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'WS',
                'value' => 'https://www.whatsapp.com/',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'WU',
                'value' => 'http://127.0.0.1:8000/',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'PH',
                'value' => '01-4444444',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'E',
                'value' => 'eoffice@info.com',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'MS',
                'value' => '+977-9824374623',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'TPIA',
                'value' => ' <a class="twitter-timeline" data-width="350" data-height="400"
                               href="https://twitter.com/OfficeS2023?ref_src=twsrc%5Etfw">
                                Tweets by OfficeS2023
                            </a>',
            ],

            [
                'client_id' => 20,
                'setting_code' => 'CBAK',
                'value' => 'https://tawk.to/chat/646f1532ad80445890ef0511/1h18ulkfr',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'WIA',
                'value' => '<div style="position:fixed;top:88.5%;left:88%;">
                <a aria-label="Chat on WhatsApp" href=
                "https://wa.me/message/IKBKLJXCR2PYH1"
                   target="_blank"> <img alt="Chat on WhatsApp" src="\images\app.ico" style="width:65px; height:65px;" />
                </a>
                </div>',
            ],
            [
                'client_id' => 20,
                'setting_code' => 'FPIA',
                'value' => ' <iframe
                                    src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fviewas%3D100000686899395%26id%3D100093317810570&tabs=timeline&width=350&height=400&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                                    width="350" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                
                            </iframe>',
            ],
        ];
        DB::table('client_setting')->insert($rows);
    }
}
