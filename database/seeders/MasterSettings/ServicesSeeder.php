<?php

namespace Database\Seeders\MasterSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->truncate();
        $rows = [
            [
                'code' => '3',
                'name_en' => 'Business recommendations',
                'name_np' => 'व्यवसाय सम्बन्धी सिफारिस',
                'service_type_id' => null,
                'created_at' => '2021-01-17 18:38:51',
                'updated_at' => null,
            ],
            [
                'code' => '6',
                'name_en' => 'Various recommendations ',
                'name_np' => 'बिबिध  सिफारिश ',
                'service_type_id' => null,
                'created_at' => '2021-01-17 18:40:28',
                'updated_at' => null,
            ],
            [
                'code' => '7',
                'name_np' => 'अंग्रेजी सिफारिस',
                'name_en' => 'English recommendation',
                'service_type_id' => null,
                'created_at' => '2021-01-17 18:40:59',
                'updated_at' => null,
            ],
            [
                'code' => '8',
                'name_np' => 'योजना सिफारिस ',
                'name_en' => 'Plan recommendation ',
                'service_type_id' => null,
                'created_at' => '2021-01-17 18:41:17',
                'updated_at' => null,
            ],
            [
                'code' => '9',
                'name_np' => 'खुल्ला ढाँचा',
                'name_en' => 'Open format Recommendation',
                'service_type_id' => null,
                'created_at' => '2021-01-27 10:09:41',
                'updated_at' => null,
            ],
            [

                'code' => '10',
                'name_np' => 'नेपाली नागरिकता सम्बन्धी सिफारिस',
                'name_en' => 'Nepalese citizenship Recommendation',
                'service_type_id' => null,
                'created_at' => '2021-03-09 13:43:01',
                'updated_at' => '2021-03-09 13:43:13',
            ],
            [
                'code' => '12',
                'name_np' => 'सामाजिक / पारिवारिक सिफारिस',
                'name_en' => 'Social / Family Recommendation',
                'service_type_id' => null,
                'created_at' => '2021-03-18 16:09:28',
                'updated_at' => '2021-06-27 13:46:25',
            ],
            [

                'code' => '2',
                'name_np' => 'घर जग्गा सम्बन्धी सिफारिस',
                'name_en' => 'Real estate Recommendation',
                'service_type_id' => null,
                'created_at' => '2021-01-17 18:40:05',
                'updated_at' => '2021-08-03 16:01:30',
            ],
            [
                'code' => '1',
                'name_np' => 'व्यक्तिगत सिफारिस',
                'name_en' => 'Personal Recommendation',
                'service_type_id' => null,
                'created_at' => '2021-01-17 18:38:29',
                'updated_at' => '2021-08-09 13:21:26',
            ],
            [
                'code' => '5',
                'name_np' => 'अन्य सिफारिस',
                'name_en' => 'Other Recommendation',
                'service_type_id' => null,
                'created_at' => '2021-01-17 18:39:40',
                'updated_at' => null,
            ],
            [

                'code' => '4',
                'name_np' => 'बहाल सम्बन्धी सिफारिस',
                'name_en' => 'बहाल सम्बन्धी सिफारिस',
                'service_type_id' => null,
                'created_at' => '2021-01-17 18:39:15',
                'updated_at' => null,
            ],
            [

                'code' => '13',
                'name_np' => 'मोही लगत कट्टा',
                'name_en' => 'Mohi Lagat Katta Recommendation',
                'service_type_id' => null,
                'created_at' => '2021-03-19 14:57:32',
                'updated_ar' => '2021-09-12 12:32:07',
            ],
            [

                'code' => '00SKH',
                'name_en' => 'Regarding the branch Recommendation',
                'name_np' => 'शाखा सम्बन्धि',
                'service_type_id' => null,
                'created_at' => '2021-09-16 09:53:41',
                'updated_ar' => null,
            ],
            [

                'code' => '11',
                'name_np' => 'भौतिक निर्माण सम्बन्धी सिफारिस',
                'name_en' => ' physical construction Recommendation',
                'service_type_id' => null,
                'created_at' => '2021-03-18 16:02:58',
                'updated_at' => '2023-02-13 16:31:51',
            ],
            [

                'code' => '01',
                'name_np' => 'बाणगंगा नगरपालिकाको लागि सिफारिस',
                'name_en' => 'Banganga Municipality Recommendation',
                'service_type_id' => null,
                'created_at' => '2023-01-17 14:49:42',
                'updated_at' => null,
            ],

        ];
        DB::table('services')->insert($rows);
    }
}
