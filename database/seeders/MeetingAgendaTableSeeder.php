<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetingAgendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meeting_agenda_lists')->truncate();
        $rows = [
            [
                'client_id' => 20,
                'fy_id' => 1,
                'meeting_id' => 5,
                'title' => 'प्रस्तावित कार्यपालिकाको बैठक १५ मिनेट भित्र शुरु हुँदैछ । कृपया यहाँको अमूल्य समय निकाली उक्त बैठकमा सहभागी हुनु हुनेछ भन्ने अपेक्षा सहित नगरपालिका तर्फबाट यो रिमाइण्डर कल गरिएको छ । धन्यवाद!!!',

            ],
            [
                'client_id' => 20,
                'fy_id' => 1,
                'meeting_id' => 5,
                'title' => 'सामुदायिक संस्थालाई आर्थिक सहयोग गर्ने',

            ],
        ];
        DB::table('meeting_agenda_lists')->insert($rows);
    }
}
