<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complaint_statuses')->truncate();
        $rows = [
            [
                'code' => 'NOT',
                'name' => 'Not Seen',
                'name_ne' => 'हेर्न बाकी',
                'status' => true,
            ],
            [
                'code' => 'SEE',
                'name' => 'Seen/Pending',
                'name_ne' => 'हेरिसकेको',
                'status' => true,
            ],
            [
                'code' => 'PRO',
                'name' => 'Processing',
                'name_ne' => 'अगाडि बढाउने',
                'status' => true,
            ],

            [
                'code' => 'SOL',
                'name' => 'Solved',
                'name_ne' => 'समाधान भईसकेको',
                'status' => true,
            ],
            [
                'code' => 'UN',
                'name' => 'Un-Assigned',
                'name_ne' => 'तोक्न बाकी',
                'status' => true,
            ],
            [
                'code' => 'RO',
                'name' => 'Re-Opened',
                'name_ne' => 'पुन: खोलियो',
                'status' => true,
            ],
            [
                'code' => 'RA',
                'name' => 'Re-Assigned/Unseen',
                'name_ne' => 'पुन: तोकेको ',
                'status' => true,
            ],
            [
                'code' => 'CLO',
                'name' => 'Closed',
                'name_ne' => 'बन्द गर्ने',
                'status' => true,
            ],
            [
                'code' => 'FA',
                'name' => 'Incomplete/Fake/Unrelated',
                'name_ne' => 'अपूर्ण/नक्कली',
                'status' => true,
            ],
        ];
        DB::table('complaint_statuses')->insert($rows);
    }
}
