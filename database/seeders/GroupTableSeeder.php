<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data from the table
        DB::table('groups')->truncate();

        // Define the sample data
        $sampleData = [
            [
                'fy_id' => 1,
                'client_id' => 20,
                'name' => 'Group 1',
                'details' => 'Sample group 1 details',
                'status' => true,
                'total_members' => 2,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fy_id' => 1,
                'client_id' => 20,
                'name' => 'Group 2',
                'details' => 'Sample group 2 details',
                'status' => true,
                'total_members' => 2,
                'created_by' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        // Insert the sample data into the table
        DB::table('groups')->insert($sampleData);
    }
}
