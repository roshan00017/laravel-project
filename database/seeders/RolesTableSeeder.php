<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        $rows = [
            [
                'name_en' => 'Super Admin',
                'name_np' => 'सुपर प्रशासक',
                'role_level' => 'system_admin',
            ],
            [
                'name_en' => 'Admin',
                'name_np' => 'मुख्य प्रशासक',
                'role_level' => 'system_admin',
            ],
            [
                'name_en' => 'Client Admin',
                'name_np' => 'प्रशासक',
                'role_level' => 'all_client',
            ],
            [
                'name_en' => 'EDMIS Admin',
                'name_np' => 'EDMIS प्रशासक',
                'role_level' => 'all_client',

            ],
            [
                'name_en' => 'Greavence Admin',
                'name_np' => 'गुनासो प्रशासक',
                'role_level' => 'all_client',
            ],
            [
                'name_en' => 'DCC Admin',
                'name_np' => 'डिजिटल सिटिजन  प्रशासक',
                'role_level' => 'all_client',
            ],
            [
                'name_en' => 'Meeting Admin',
                'name_np' => 'बैठक  प्रशासक',
                'role_level' => 'all_client',
            ],
            [
                'name_en' => 'Appointment Admin',
                'name_np' => 'भेट घाट',
                'role_level' => 'all_client',
            ],
        ];
        DB::table('roles')->insert($rows);
    }
}
