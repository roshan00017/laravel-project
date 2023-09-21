<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DcDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dc_document')->truncate();
        $rows = [
            [
                'code' => '001',
                'document_no' => '12012',
                'added_on' => '',
                'status' => true,
            ],

        ];
        DB::table('dc_office')->insert($rows);
    }
}
