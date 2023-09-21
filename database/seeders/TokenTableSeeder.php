<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tokens')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'fy_id' => 1,
                'module_name' => 'cyz',
                'module_status_id' => '1',
                'module_unique_id' => '2',
                'token_no' => 001,
                'status_title_np' => 'st',
                'status_title_en' => null,
                'date_np' => '2023-2-21',
                'date_en' => '2023-2-21',
                'token_month_code' => 2,
            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'module_name' => 'xyz',
                'module_status_id' => '2',
                'module_unique_id' => '3',
                'token_no' => 002,
                'status_title_np' => 'Null',
                'status_title_en' => 'Cancelled',
                'date_np' => '2023-1-21',
                'date_en' => '2023-1-21',
                'token_month_code' => 3,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'module_name' => 'rtyz',
                'module_status_id' => '4',
                'module_unique_id' => '5',
                'token_no' => 004,
                'status_title_np' => 'complete',
                'status_title_en' => 'Completed',
                'date_np' => '2023-2-24',
                'date_en' => '2023-2-24',
                'token_month_code' => 2,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'module_name' => 'rtyz',
                'module_status_id' => '4',
                'module_unique_id' => '5',
                'token_no' => 004,
                'status_title_np' => 'complete',
                'status_title_en' => 'Completed',
                'date_np' => '2023-2-24',
                'date_en' => '2023-2-24',
                'token_month_code' => 3,

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'module_name' => 'rtyz',
                'module_status_id' => '4',
                'module_unique_id' => '5',
                'token_no' => 004,
                'status_title_np' => 'complete',
                'status_title_en' => 'Completed',
                'date_np' => '2023-2-24',
                'date_en' => '2023-2-24',
                'token_month_code' => 2,

            ],
        ];
        DB::table('tokens')->insert($rows);
    }
}
