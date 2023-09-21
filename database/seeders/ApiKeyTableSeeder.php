<?php

namespace Database\Seeders;

use App\Facades\NepaliDate;
use App\Models\ApiSetting\ApiKey;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApiKeyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('api_keys')->truncate();
        $rows = [
            [
                'name' => 'common',
                'key' => ApiKey::generate(),
                'created_at' => Carbon::now(),
                'updated_at' => NepaliDate::create(Carbon::now())->toBS(),
            ],
            [
                'name' => 'sifaris',
                'key' => ApiKey::generate(),
                'created_at' => Carbon::now(),
                'updated_at' => NepaliDate::create(Carbon::now())->toBS(),
            ],
        ];
        DB::table('api_keys')->insert($rows);
    }
}
