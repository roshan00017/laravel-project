<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstDepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_department')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'code' => '03',
                'name_en' => 'Rajaswa Sakha',
                'name_np' => 'राजश्रव शाखा',
                'status' => true,
            ],
            [
                'client_id' => 20,
                'code' => '05',
                'name_en' => 'IT',
                'name_np' => 'सुचना प्रबिधि शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '08',
                'name_en' => 'Women And Child Department',
                'name_np' => 'महिला तथा बालबालिका शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '02',
                'name_en' => 'Internal Management Branch (Administration)',
                'name_np' => 'आन्तरिक व्यवस्थापन शाखा (प्रशासन)',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '22',
                'name_en' => 'Reconstruction Branch',
                'name_np' => ',पुन निर्माण शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '09',
                'name_en' => 'PM Employment Section',
                'name_np' => 'प्रधानमन्त्री रोजगार  शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '07',
                'name_en' => 'National Identity and Vital Registration Section',
                'name_np' => 'राष्ट्रिय परिचय पत्र तथा पञ्जिकरण शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '06',
                'name_en' => 'Economic Management Section',
                'name_np' => 'आर्थिक व्यवस्थापन शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '04',
                'name_en' => 'Health Service Section',
                'name_np' => 'स्वास्थ्य सेवा शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '01',
                'name_en' => 'Registration & Dispatch Section',
                'name_np' => 'दर्ता र प्रेषण खण्ड',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '10',
                'name_en' => 'Infrastructure Development Section',
                'name_np' => 'पूर्वाधार विकास शाखा',
                'status' => true,

            ],

            [
                'client_id' => 20,
                'code' => '11',
                'name_en' => 'Store Management Section',
                'name_np' => 'जिन्सी व्यवस्थापन शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '12',
                'name_en' => 'Education, Youth and Sports Development Section',
                'name_np' => 'शिक्षा, युवा तथा खेलकुद विकास शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '13',
                'name_en' => 'Industry Development and Organization Registration Section',
                'name_np' => 'उध्याेग बिकाश तथा संघ संस्था दर्ता शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '14',
                'name_en' => 'Policy and Planning Formulation Section',
                'name_np' => 'नीति तथा योजना तर्जुमा शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '15',
                'name_en' => 'Agriculture Development Section',
                'name_np' => 'कृषि बिकास शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '16',
                'name_en' => 'Vetnary Section',
                'name_np' => 'पशुपन्छी विकास शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '17',
                'name_en' => 'Ward Office',
                'name_np' => 'वडा कार्यालय',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '18',
                'name_en' => 'Chief Administrative Officer',
                'name_np' => 'प्रमुख प्रशासकिय अधिकृत',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '19',
                'name_en' => 'Cooperative Development Section',
                'name_np' => 'सहकारी बिकास शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '20',
                'name_en' => 'Judiciary Section',
                'name_np' => 'न्याय सम्पादन शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '21',
                'name_en' => 'Disaster Management Branch',
                'name_np' => 'विपत् ब्यावस्थापन शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '24',
                'name_en' => 'Surveyor Branch',
                'name_np' => 'नापी शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '25',
                'name_en' => 'Commission for Resolving Land Problem',
                'name_np' => 'भूमी सम्बन्धी समस्या समाधान आयोग',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '001',
                'name_en' => 'Revenue Branch',
                'name_np' => 'राजश्व शाखा',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '500',
                'name_en' => 'Ward No 14',
                'name_np' => 'वडा नं. १४',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '501',
                'name_en' => 'Ward No 13',
                'name_np' => 'वडा नं. १३',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '502',
                'name_en' => 'Ward No 11',
                'name_np' => 'वाडा  न. ११',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '504',
                'name_en' => 'Ward No 10',
                'name_np' => 'वडा न. १०',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '503',
                'name_en' => 'Ward No 12',
                'name_np' => 'वडा नं. १२',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '505',
                'name_en' => 'Ward No 9',
                'name_np' => 'वडा नं. ९',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '506',
                'name_en' => 'Ward No 5',
                'name_np' => 'वडा नं. ५',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '508',
                'name_en' => 'Ward No 7',
                'name_np' => 'वडा नं. ७',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '509',
                'name_en' => 'Ward No 8',
                'name_np' => 'वडा नं. ८',
                'status' => true,

            ],

            [
                'client_id' => 20,
                'code' => '510',
                'name_en' => 'Ward No 1',
                'name_np' => 'वडा नं. १',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '513',
                'name_en' => 'Ward No 4',
                'name_np' => 'वडा न‌  ४',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '512',
                'name_en' => 'Ward No 3',
                'name_np' => 'वडा नं. ३',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '25',
                'name_en' => 'Mr. Chief',
                'name_np' => 'श्रीमान प्रमुख ज्यू',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '02',
                'name_en' => 'Ward No 2',
                'name_np' => 'वडा नं. २',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '06',
                'name_en' => 'Ward No 6',
                'name_np' => 'वडा नं. ६',
                'status' => true,

            ],
            [
                'client_id' => 20,
                'code' => '1003',
                'name_en' => 'Ward Secretary Shankar Prasad Ojha',
                'name_np' => 'वडा सचिव,शंकर प्रसाद ओझा',
                'status' => true,

            ],
        ];
        DB::table('mst_department')->insert($rows);
    }
}
