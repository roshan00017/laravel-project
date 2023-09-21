<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_modules')->truncate();
        $rows = [
            [
                'code' => 'edmis',
                'name_np' => 'कार्यालय व्यवस्थापन प्रणाली',
                'name_en' => 'Office Automation',
            ],
            [
                'code' => 'ghs',
                'name_np' => 'गुनासो तथा सुझाव व्यवस्थापन',
                'name_en' => 'Complaint & Suggestion Management',
            ],
            [
                'code' => 'mms',
                'name_np' => 'बैठक व्यवस्थापन',
                'name_en' => 'Meeting Management',
            ],
            [
                'code' => 'dcc',
                'name_np' => 'विद्युतीय नागरिक बडापत्र',
                'name_en' => 'Digital Citizen Character',
            ],
        ];
        DB::table('service_modules')->insert($rows);
    }
}
