<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule_types')->truncate();
        $rows = [
            [
                'code' => '1',
                'name_en' => 'Meeting',
                'name_np' => 'बैठक',
                'status' => true,
            ],
            [
                'code' => '1',
                'name_en' => 'Meetup',
                'name_np' => 'भेटघाट',
                'status' => true,
            ],
        ];
        DB::table('schedule_types')->insert($rows);
    }
}
