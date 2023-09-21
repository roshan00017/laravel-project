<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryapalikaMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyapalika_members')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'name_np' => 'Member 1 Name (Nepali)',
                'name_en' => 'Member 1 Name (English)',
                'designation' => 'Member 1 Designation',
                'email' => 'member1@example.com',
                'mobile' => '9876543210',
                'image' => 'member1.jpg',
                'status' => true,
            ],
            [
                'client_id' => 20,
                'name_np' => 'Member 2 Name (Nepali)',
                'name_en' => 'Member 2 Name (English)',
                'designation' => 'Member 2 Designation',
                'email' => 'member2@example.com',
                'mobile' => '9876543211',
                'image' => 'member2.jpg',
                'status' => true,
            ],
        ];
        DB::table('karyapalika_members')->insert($rows);
    }
}
