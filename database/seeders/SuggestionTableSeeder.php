<?php

namespace Database\Seeders;

use App\Facades\NepaliDate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuggestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suggestions')->truncate();
        $rows = [
            [
                'name' => 'Piper Robinson',
                'mobile' => '9843426056',
                'suggestions' => 'Fugiat perferendis',
                'email' => 'wexyjus@mailinator.com',
                'suggestion_category_id' => 1,
                'submit_date_en' => Carbon::now(),
                'submit_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'suggestion_month_code' => 2,
            ],
            [
                'name' => 'asdasf Robinson',
                'mobile' => '344',
                'suggestions' => 'ffd perferendis',
                'email' => 'asdf@mailinator.com',
                'suggestion_category_id' => 2,
                'submit_date_en' => Carbon::now(),
                'submit_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'suggestion_month_code' => 2,

            ],
        ];
        DB::table('suggestions')->insert($rows);
    }
}
