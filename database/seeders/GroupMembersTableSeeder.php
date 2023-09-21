<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data from the table
        DB::table('group_members')->truncate();

        // Define the sample data
        $sampleData = [
            [
                'fy_id' => 1,
                'client_id' => 20,
                'group_id' => 1,
                'member_id' => 1,
                'added_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fy_id' => 1,
                'client_id' => 20,
                'group_id' => 1,
                'member_id' => 7,
                'added_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fy_id' => 1,
                'client_id' => 20,
                'group_id' => 2,
                'member_id' => 1,
                'added_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fy_id' => 1,
                'client_id' => 20,
                'group_id' => 2,
                'member_id' => 7,
                'added_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data here...
        ];

        // Insert the sample data into the table
        DB::table('group_members')->insert($sampleData);
    }
}
