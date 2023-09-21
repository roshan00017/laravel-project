<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_document_type')->truncate();
        $rows = [
            [
                'code' => '01',
                'name_en' => 'Letters',
                'name_np' => 'पत्र',
                'status' => true,
            ],
            [
                'code' => '02',
                'name_en' => 'Files',
                'name_np' => 'फाइल',
                'status' => true,
            ],
            [
                'code' => '03',
                'name_en' => 'Documents',
                'name_np' => 'कागजात',
                'status' => true,
            ],
        ];
        DB::table('mst_document_type')->insert($rows);
    }
}
