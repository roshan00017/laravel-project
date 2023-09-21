<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmergencyContactDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data from the table
        DB::table('call_routing_number_managements')->truncate();

        // Define the sample data
        $sampleData = [
            [
                'fy_id' => 1,
                'client_id' => 20,
                'type' => 'emergency_contact',
                'number' => '01-5970425',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fy_id' => 1,
                'client_id' => 20,
                'type' => 'police_number',
                'number' => '1234564563',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fy_id' => 1,
                'client_id' => 20,
                'type' => 'ambulance_number',
                'number' => '1234564563',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fy_id' => 1,
                'client_id' => 20,
                'type' => 'firebrigade_number',
                'number' => '1234564563',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('call_routing_number_managements')->insert($sampleData);
    }
}
