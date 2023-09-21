<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $rows = [

            [
                'role_id' => 1,
                'client_id' => null,
                'full_name' => 'Super Admin',
                'full_name_np' => '	सुपर प्रशासक',
                'login_user_name' => 'superadmin',
                'email' => 'super@admin.com',
                'mobile_no' => 1234567564,
                'password' => bcrypt('Sup#23'),
                'user_module' => 'system_admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'client_id' => null,
                'full_name' => 'Admin',
                'full_name_np' => 'प्रशासक',
                'login_user_name' => 'admin',
                'email' => 'admin@admin.com',
                'mobile_no' => 456667,
                'password' => bcrypt('Admin#23'),
                'user_module' => 'system_admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'role_id' => 3,
                'client_id' => 20,
                'full_name' => 'Numana Admin',
                'full_name_np' => 'Namuna प्रशासक',
                'login_user_name' => 'clientadmin',
                'email' => 'client@admin.com',
                'mobile_no' => 12352345634,
                'password' => bcrypt('Admin#23'),
                'user_module' => 'client_admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 4,
                'client_id' => 20,
                'full_name' => 'EDMIS Admin',
                'full_name_np' => 'EDMIS प्रशासक',
                'login_user_name' => 'edmisadmin',
                'email' => 'edmis@admin.com',
                'mobile_no' => 3344444444,
                'password' => bcrypt('Admin#23'),
                'user_module' => 'edmis',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'role_id' => 5,
                'client_id' => 20,
                'full_name' => 'GH Admin',
                'full_name_np' => 'गुनासो प्रशासक',
                'login_user_name' => 'ghsadmin',
                'email' => 'ghs@admin.com',
                'mobile_no' => 4546577777,
                'password' => bcrypt('Admin#23'),
                'user_module' => 'ghs',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 6,
                'client_id' => 20,
                'full_name' => 'DCC Admin',
                'full_name_np' => 'डिजिटल सिटिजन  प्रशासक',
                'login_user_name' => 'dccadmin',
                'email' => 'dcc@admin.com',
                'mobile_no' => 2334555,
                'password' => bcrypt('Admin#23'),
                'user_module' => 'dcc',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 7,
                'client_id' => 20,
                'full_name' => 'MMS Admin',
                'full_name_np' => 'बैठक प्रशासक',
                'login_user_name' => 'mmsadmin',
                'email' => 'mms@admin.com',
                'mobile_no' => 5555534,
                'password' => bcrypt('Admin#23'),
                'user_module' => 'mms',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 8,
                'client_id' => 20,
                'full_name' => 'Appointment Admin',
                'full_name_np' => 'भेटघाट प्रशासक',
                'login_user_name' => 'appointment',
                'email' => 'app@admin.com',
                'mobile_no' => 34556,
                'password' => bcrypt('Admin#23'),
                'user_module' => 'app',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id' => 8,
                'client_id' => 20,
                'full_name' => 'Appointment User',
                'full_name_np' => 'भेटघाट ',
                'login_user_name' => 'appointmentuser',
                'email' => 'user@admin.com',
                'mobile_no' => 4546646,
                'password' => bcrypt('Admin#23'),
                'user_module' => 'app',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        DB::table('users')->insert($rows);
    }
}
