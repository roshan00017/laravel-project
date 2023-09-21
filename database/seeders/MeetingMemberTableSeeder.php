<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetingMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meeting_members')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'fy_id' => 1,
                'meeting_id' => 5,
                'name_np' => 'बैठक शीर्षक',
                'name_en' => 'बैठक शीर्षक',
                'post' => 'Test',
                'office' => 'Test',
                'contact_no' => '12345678910',
                'email' => 'test@gmail.com',

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'meeting_id' => 5,
                'name_np' => 'बैठक शीर्षक',
                'name_en' => 'बैठक शीर्षक',
                'post' => 'Test1',
                'office' => 'Test1',
                'contact_no' => '12348678910',
                'email' => 'test1@gmail.com',

            ],
        ];
        DB::table('meeting_members')->insert($rows);
    }
}
