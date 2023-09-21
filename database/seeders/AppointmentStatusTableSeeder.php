<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointment_status')->truncate();
        $rows = [
            [
                'name_en' => 'Not Visited',
                'name_np' => 'भेटघाट हुन बाकी',
                'code' => 'NV',
                'status' => true,
            ],
            [
                'name_en' => 'Visited',
                'name_np' => 'भेटघाट भईसकेको ',
                'code' => 'V',
                'status' => true,
            ],
            [
                'name_en' => 'Handover',
                'name_np' => 'हस्तान्तरण गरिएको',
                'code' => 'H',
                'status' => true,
            ],
            [
                'name_en' => 'Closed',
                'name_np' => 'समाधान भईसकेको',
                'code' => 'C',
                'status' => true,
            ],
            [
                'name_en' => 'Complaint Processing',
                'name_np' => 'गुनासो प्रतिक्रियामा  पठाईएको',
                'code' => 'P',
                'status' => true,
            ],
        ];
        DB::table('appointment_status')->insert($rows);
    }
}
