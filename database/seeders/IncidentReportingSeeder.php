<?php

namespace Database\Seeders;

use App\Facades\NepaliDate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidentReportingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('incident_reportings')->truncate();
        $rows = [
            [
                'name' => 'John Doe',
                'mobile' => '9845247816',
                'title' => 'Transformer Blast',
                'description' => 'Local area transformer blasted',
                'email' => 'jdoe@mailinator.com',
                'address' => 'Maitidevi',
                'latitude' => '35.929673',
                'longitude' => '-78.948237',
                'incident_submit_date_en' => Carbon::now(),
                'incident_submit_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'incident_month_code' => 2,
            ],
            [
                'name' => 'Sarah Williams',
                'mobile' => '9854232374',
                'title' => 'Manhole damaged',
                'description' => 'Local area manhole damaged',
                'email' => 'sarah@mailinator.com',
                'address' => 'Ghattekulo',
                'latitude' => '38.889510	',
                'longitude' => '-77.032000	',
                'incident_submit_date_en' => Carbon::now(),
                'incident_submit_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'incident_month_code' => 2,

            ],
        ];
        DB::table('incident_reportings')->insert($rows);
    }
}
