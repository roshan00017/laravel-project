<?php

namespace Database\Seeders\MasterSettings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('mst_meeting_statuses')->truncate();
        $rows = [
            [
                'code' => '1',
                'name_en' => 'Pending',
                'name_np' => 'सुरु  हुन बाकी',
                'status' => true,
            ],
            [
                'code' => '2',
                'name_en' => 'Canceled',
                'name_np' => 'रद्द गरिएको',
                'status' => true,
            ],
            [
                'code' => '3',
                'name_en' => 'Postponed',
                'name_np' => 'स्थगित भएको',
                'status' => false,
            ],
            [
                'code' => '4',
                'name_en' => 'Preponed',
                'name_np' => 'अघि सरेको',
                'status' => false,
            ],
            [
                'code' => '5',
                'name_en' => 'Execute',
                'name_np' => 'पूरा भएको',
                'status' => false,
            ],
        ];
        DB::table('mst_meeting_statuses')->insert($rows);
    }
}
