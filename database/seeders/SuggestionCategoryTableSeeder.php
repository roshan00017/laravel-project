<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuggestionCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suggestion_categories')->truncate();
        $rows = [
            [
                'code' => 'TRA',
                'name' => 'Traffic',
                'name_ne' => 'Traffic',
            ],
            [
                'code' => 'EDU',
                'name' => 'Education',
                'name_ne' => 'Education',
            ],
        ];
        DB::table('suggestion_categories')->insert($rows);
    }
}
