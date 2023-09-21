<?php

namespace Database\Seeders\MasterSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->truncate();
        $rows = [
            [
                'code' => '101',
                'name_np' => 'ताप्लेजुङ',
                'name_en' => 'Taplejung',
                'province_code' => 1,

            ],
            [
                'code' => '102',
                'name_np' => 'संखुवासभा',
                'name_en' => 'Sankhuwasabha ',
                'province_code' => 1,

            ],
            [
                'code' => '103',
                'name_np' => 'सोलुखुम्बु',
                'name_en' => 'Solukhumbu',
                'province_code' => 1,

            ],
            [
                'code' => '104',
                'name_np' => 'ओखलढुंगा',
                'name_en' => 'Okhaldhunga',
                'province_code' => 1,

            ],
            [
                'code' => '105',
                'name_np' => 'खोटाङ',
                'name_en' => 'Khotang',
                'province_code' => 1,

            ],
            [
                'code' => '106',
                'name_np' => 'भोजपुर',
                'name_en' => 'Bhojpur',
                'province_code' => 1,

            ],
            [
                'code' => '107',
                'name_np' => 'धनकुटा',
                'name_en' => 'Dhankuta',
                'province_code' => 1,

            ],
            [
                'code' => '108',
                'name_np' => 'तेहथुम',
                'name_en' => 'Tehrathum',
                'province_code' => 1,

            ],
            [
                'code' => '109',
                'name_np' => 'पाँचथर',
                'name_en' => 'Panchthar',
                'province_code' => 1,

            ],
            [
                'code' => '110',
                'name_np' => 'ईलाम',
                'name_en' => 'Ilam',
                'province_code' => 1,

            ],
            [
                'code' => '111',
                'name_np' => 'झापा',
                'name_en' => 'Jhapa',
                'province_code' => 1,

            ],
            [
                'code' => '112',
                'name_np' => 'मोरंग',
                'name_en' => 'Morang',
                'province_code' => 1,

            ],
            [
                'code' => '113',
                'name_np' => 'सुनसरी',
                'name_en' => 'Sunsari',
                'province_code' => 1,

            ],
            [
                'code' => '114',
                'name_np' => 'उदयपुर',
                'name_en' => 'Udayapur',
                'province_code' => 1,

            ],
            [
                'code' => '201',
                'name_np' => 'सप्तरी',
                'name_en' => 'Saptari',
                'province_code' => 2,

            ],
            [
                'code' => '202',
                'name_np' => 'सिराहा',
                'name_en' => 'Siraha',
                'province_code' => 2,

            ],
            [
                'code' => '203',
                'name_np' => 'धनुषा',
                'name_en' => 'Dhanusha ',
                'province_code' => 2,

            ],
            [
                'code' => '204',
                'name_np' => 'महोत्तरी',
                'name_en' => 'Mahottari',
                'province_code' => 2,

            ],
            [
                'code' => '205',
                'name_np' => 'सर्लाही',
                'name_en' => 'Sarlahi',
                'province_code' => 2,

            ],
            [
                'code' => '206',
                'name_np' => 'रौतहट',
                'name_en' => 'Rautahat',
                'province_code' => 2,

            ],
            [
                'code' => '207',
                'name_np' => 'वारा',
                'name_en' => 'Bara',
                'province_code' => 2,

            ],
            [
                'code' => '208',
                'name_np' => 'पर्सा',
                'name_en' => 'Parsa',
                'province_code' => 2,

            ],
            [
                'code' => '301',
                'name_np' => 'दोलखा',
                'name_en' => 'Dolakha',
                'province_code' => 3,

            ],
            [
                'code' => '302',
                'name_np' => 'सिन्धुपाल्चोक',
                'name_en' => 'Sindhupalchok',
                'province_code' => 3,

            ],
            [
                'code' => '303',
                'name_np' => 'रसुवा',
                'name_en' => 'Rasuwa',
                'province_code' => 3,

            ],
            [
                'code' => '304',
                'name_np' => 'धादिङ',
                'name_en' => 'Dhading',
                'province_code' => 3,

            ],
            [
                'code' => '305',
                'name_np' => 'नुवाकोट',
                'name_en' => 'Nuwakot ',
                'province_code' => 3,

            ],
            [
                'code' => '306',
                'name_np' => 'काठमाण्डौ',
                'name_en' => 'Kathmandu',
                'province_code' => 3,

            ],
            [
                'code' => '307',
                'name_np' => 'भक्तपुर',
                'name_en' => 'Bhaktapur',
                'province_code' => 3,

            ],
            [
                'code' => '308',
                'name_np' => 'ललितपुर',
                'name_en' => 'Lalitpur',
                'province_code' => 3,

            ],
            [
                'code' => '309',
                'name_np' => 'काभ्रेपलान्चोक',
                'name_en' => 'Kavrepalanchok',
                'province_code' => 3,

            ],
            [
                'code' => '310',
                'name_np' => 'रामेछाप',
                'name_en' => 'Ramechhap',
                'province_code' => 3,

            ],
            [
                'code' => '311',
                'name_np' => 'सिन्धुली',
                'name_en' => 'Sindhuli ',
                'province_code' => 3,

            ],
            [
                'code' => '312',
                'name_np' => 'मकवानपुर',
                'name_en' => 'Makwanpur',
                'province_code' => 3,

            ],
            [
                'code' => '313',
                'name_np' => 'चितवन',
                'name_en' => 'Chitwan',
                'province_code' => 3,

            ],
            [
                'code' => '401',
                'name_np' => 'गोरखा',
                'name_en' => 'Gorkha',
                'province_code' => 4,

            ],
            [
                'code' => '402',
                'name_np' => 'मनाङ',
                'name_en' => 'Manang',
                'province_code' => 4,

            ],
            [
                'code' => '403',
                'name_np' => 'मुस्ताङ',
                'name_en' => 'Mustang ',
                'province_code' => 4,

            ],
            [
                'code' => '404',
                'name_np' => 'म्याग्दी',
                'name_en' => 'Myagdi',
                'province_code' => 4,

            ],
            [
                'code' => '405',
                'name_np' => 'कास्की',
                'name_en' => 'Kaski',
                'province_code' => 4,

            ],
            [
                'code' => '406',
                'name_np' => 'लमजुङ',
                'name_en' => 'Lamjung',
                'province_code' => 4,

            ],
            [
                'code' => '407',
                'name_np' => 'तनहुँ',
                'name_en' => 'Tanahun',
                'province_code' => 4,

            ],
            [
                'code' => '408',
                'name_np' => 'नवलपरासी (बर्दघाट सुस्ता पूर्व)',
                'name_en' => 'Nawalpur',
                'province_code' => 4,

            ],
            [
                'code' => '409',
                'name_np' => 'स्याङजा',
                'name_en' => 'Syangja',
                'province_code' => 4,

            ],
            [
                'code' => '410',
                'name_np' => 'पर्वत',
                'name_en' => 'Parbat',
                'province_code' => 4,

            ],
            [
                'code' => '411',
                'name_np' => 'वाग्लुङ',
                'name_en' => 'Baglung',
                'province_code' => 4,

            ],
            [
                'code' => '501',
                'name_np' => 'रुकुम (पूर्वी भाग)',
                'name_en' => 'Eastern Rukum',
                'province_code' => 5,

            ],
            [
                'code' => '502',
                'name_np' => 'रोल्पा',
                'name_en' => 'Rolpa ',
                'province_code' => 5,

            ],
            [
                'code' => '503',
                'name_np' => 'प्यूठान',
                'name_en' => 'Pyuthan',
                'province_code' => 5,

            ],
            [
                'code' => '504',
                'name_np' => 'गुल्मी',
                'name_en' => 'Gulmi',
                'province_code' => 5,

            ],
            [
                'code' => '505',
                'name_np' => 'अर्घाखाँची',
                'name_en' => 'Arghakhanchi',
                'province_code' => 5,

            ],
            [
                'code' => '506',
                'name_np' => 'पाल्पा',
                'name_en' => 'Palpa',
                'province_code' => 5,

            ],
            [
                'code' => '507',
                'name_np' => 'नवलपरासी (बर्दघाट सुस्ता पश्चिम)',
                'name_en' => 'Parasi',
                'province_code' => 5,

            ],
            [
                'code' => '508',
                'name_np' => 'रुपन्देही',
                'name_en' => 'Rupandehi',
                'province_code' => 5,

            ],
            [
                'code' => '509',
                'name_np' => 'कपिलबस्तु',
                'name_en' => 'Kapilvastu',
                'province_code' => 5,

            ],
            [
                'code' => '510',
                'name_np' => 'दाङ',
                'name_en' => 'Dang',
                'province_code' => 5,

            ],
            [
                'code' => '511',
                'name_np' => 'बाँके',
                'name_en' => 'Banke',
                'province_code' => 5,

            ],
            [
                'code' => '512',
                'name_np' => 'बर्दिया',
                'name_en' => 'Bardiya',
                'province_code' => 5,

            ],
            [
                'code' => '601',
                'name_np' => 'डोल्पा',
                'name_en' => 'Dolpa',
                'province_code' => 6,

            ],
            [
                'code' => '602',
                'name_np' => 'मुगु',
                'name_en' => 'Mugu',
                'province_code' => 6,

            ],
            [
                'code' => '603',
                'name_np' => 'हुम्ला',
                'name_en' => 'Humla',
                'province_code' => 6,

            ],
            [
                'code' => '604',
                'name_np' => 'जुम्ला',
                'name_en' => 'Jumla ',
                'province_code' => 6,

            ],
            [
                'code' => '605',
                'name_np' => 'कालिकोट',
                'name_en' => 'Kalikot',
                'province_code' => 6,

            ],
            [
                'code' => '606',
                'name_np' => 'दैलेख',
                'name_en' => 'Dailekh',
                'province_code' => 6,

            ],
            [
                'code' => '607',
                'name_np' => 'जाजरकोट',
                'name_en' => 'Jajarkot',
                'province_code' => 6,

            ],
            [
                'code' => '608',
                'name_np' => 'रुकुम (पश्चिम भाग)',
                'name_en' => 'Western Rukum ',
                'province_code' => 6,

            ],
            [
                'code' => '609',
                'name_np' => 'सल्यान',
                'name_en' => 'Salyan',
                'province_code' => 6,

            ],
            [
                'code' => '610',
                'name_np' => 'सुर्खेत',
                'name_en' => 'Surkhet',
                'province_code' => 6,

            ],
            [
                'code' => '701',
                'name_np' => 'बाजुरा',
                'name_en' => 'Bajura',
                'province_code' => 7,

            ],
            [
                'code' => '702',
                'name_np' => 'बझाङ',
                'name_en' => 'Bajhang',
                'province_code' => 7,

            ],
            [
                'code' => '703',
                'name_np' => 'दार्चुला',
                'name_en' => 'Darchula',
                'province_code' => 7,

            ],
            [
                'code' => '704',
                'name_np' => 'बैतडी',
                'name_en' => 'Baitadi',
                'province_code' => 7,

            ],
            [
                'code' => '705',
                'name_np' => 'डडेलधुरा',
                'name_en' => 'Dadeldhura',
                'province_code' => 7,

            ],
            [
                'code' => '706',
                'name_np' => 'डोटी',
                'name_en' => 'Doti',
                'province_code' => 7,

            ],
            [
                'code' => '707',
                'name_np' => 'अछाम',
                'name_en' => 'Achham',
                'province_code' => 7,

            ],
            [
                'code' => '708',
                'name_np' => 'कैलाली',
                'name_en' => 'Kailali',
                'province_code' => 7,

            ],
            [
                'code' => '709',
                'name_np' => 'कञ्चनपुर',
                'name_en' => 'Kanchanpur',
                'province_code' => 7,

            ],
        ];
        DB::table('districts')->insert($rows);
    }
}
