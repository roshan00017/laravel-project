<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HrEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hr_employee')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'hr_designation_id' => 1,
                'first_name_np' => 'अजित',
                'middle_name_np' => 'कुमार',
                'last_name_np' => 'यादव',
                'first_name_en' => 'Ajit',
                'middle_name_en' => 'Kumar',
                'last_name_en' => 'Yadav',
                'branch_id' => 1,
                'ward_no' => 1,
            ],
            [
                'client_id' => 20,
                'hr_designation_id' => 2,
                'first_name_np' => 'अमर',
                'middle_name_np' => 'बहादुर',
                'last_name_np' => 'विश्वकर्मा',
                'first_name_en' => 'Amber',
                'middle_name_en' => 'Bahadur',
                'last_name_en' => 'Bishwokarma',
                'branch_id' => 1,
                'ward_no' => 1,
            ],
            [
                'client_id' => 20,
                'hr_designation_id' => 3,
                'first_name_np' => 'अदिप',
                'middle_name_np' => '',
                'last_name_np' => 'श्रेष्ठ',
                'first_name_en' => 'Adip',
                'middle_name_en' => '',
                'last_name_en' => 'Shrestha',
                'branch_id' => 1,
                'ward_no' => 1,
            ],
            [
                'client_id' => 20,
                'hr_designation_id' => 4,
                'first_name_np' => 'अनिता',
                'middle_name_np' => '',
                'last_name_np' => 'कार्की',
                'first_name_en' => 'Anita',
                'middle_name_en' => '',
                'last_name_en' => 'Karki',
                'branch_id' => 1,
                'ward_no' => 1,
            ],
            [
                'client_id' => 20,
                'hr_designation_id' => 5,
                'first_name_np' => 'अप्सरा',
                'middle_name_np' => '',
                'last_name_np' => 'दाहाल',
                'first_name_en' => 'Apsara',
                'middle_name_en' => '',
                'last_name_en' => 'Dahal',
                'branch_id' => 1,
                'ward_no' => 1,
            ],
            [
                'client_id' => 20,
                'hr_designation_id' => 6,
                'first_name_np' => 'असारी',
                'middle_name_np' => 'माया',
                'last_name_np' => 'लिम्बु',
                'first_name_en' => 'Ashari',
                'middle_name_en' => 'Maya',
                'last_name_en' => 'Limbu',
                'branch_id' => 1,
                'ward_no' => 1,
            ],
            [
                'client_id' => 20,
                'hr_designation_id' => 7,
                'first_name_np' => 'आशा',
                'middle_name_np' => '',
                'last_name_np' => 'राई',
                'first_name_en' => 'Asha',
                'middle_name_en' => '',
                'last_name_en' => 'Rai',
                'branch_id' => 1,
                'ward_no' => 1,
            ],
            [
                'client_id' => 20,
                'hr_designation_id' => 8,
                'first_name_np' => 'आशिष',
                'middle_name_np' => '',
                'last_name_np' => 'आले',
                'first_name_en' => 'Aashish',
                'middle_name_en' => '',
                'last_name_en' => 'Ashis',
                'branch_id' => 1,
                'ward_no' => 1,
            ],
            [
                'client_id' => 20,
                'hr_designation_id' => 9,
                'first_name_np' => 'इच्छा',
                'middle_name_np' => 'राम',
                'last_name_np' => 'राई',
                'first_name_en' => 'Ichha',
                'middle_name_en' => 'Ram',
                'last_name_en' => 'Rai',
                'branch_id' => 1,
                'ward_no' => 1,
            ],
            [
                'client_id' => 20,
                'hr_designation_id' => 10,
                'first_name_np' => 'इन्द्र',
                'middle_name_np' => 'बहादुर',
                'last_name_np' => 'तामाङ',
                'first_name_en' => 'Indra',
                'middle_name_en' => 'bahadur',
                'last_name_en' => 'tamang',
                'branch_id' => 1,
                'ward_no' => 1,
            ],

        ];
        DB::table('hr_employee')->insert($rows);
    }
}
