<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceRelatedDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_related_documents')->truncate();
        $rows = [
            [
                'service_id' => 11,
                'document_detail_en' => 'Citizenship photocopy and birth certificate',
                'document_detail_np' => 'नागरिकताको फोटोकपी र जन्म प्रमाणपत्र',
                'service_rate' => '150 ',
            ],
            [
                'service_id' => 12,
                'document_detail_en' => 'Citizenship photocopy and marriage certificate',
                'document_detail_np' => 'नागरिकता फोटोकपी र विवाह प्रमाणपत्र',
                'service_rate' => '120 ',
            ],
            [
                'service_id' => 13,
                'document_detail_en' => 'Birth certificate',
                'document_detail_np' => 'जन्मदर्ता प्रमाण पत्र',
                'service_rate' => '500 ',
            ],
            [
                'service_id' => 14,
                'document_detail_en' => 'SLC certificate',
                'document_detail_np' => 'SLC प्रमाणपत्र',
                'service_rate' => '100 ',
            ],
            [
                'service_id' => 15,
                'document_detail_en' => 'Land Papers',
                'document_detail_np' => 'जग्गाका कागजपत्रहरू',
                'service_rate' => '700 ',
            ],
        ];
        DB::table('service_related_documents')->insert($rows);
    }
}
