<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data from the table
        DB::table('group_chats')->truncate();

        // Define the sample data
        $sampleData = [
            [
                'fy_id' => 1,
                'client_id' => 20,
                'group_id' => 1,
                'member_id' => 1,
                'message' => 'Sample message 1',
                'file' => null,
                'seen' => false,
                'msg_date_en' => '2023-06-01',
                'msg_date_np' => '2079-03-18',
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fy_id' => 1,
                'client_id' => 20,
                'group_id' => 1,
                'member_id' => 1,
                'message' => 'Sample message 2',
                'file' => null,
                'seen' => false,
                'msg_date_en' => '2023-06-02',
                'msg_date_np' => '2079-03-19',
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data here...
        ];

        // Insert the sample data into the table
        DB::table('group_chats')->insert($sampleData);
    }
}
