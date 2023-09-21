<?php

namespace App\Helpers;

use App\Facades\NepaliDate;
use App\Models\VoiceCallManagement\AudioFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VoiceCallManagementHelper
{
    public static function storeAudioFile($module_name, $module_unique_id, $audio_file)
    {
        try {
            DB::beginTransaction();
            $data = [
                'client_id' => userInfo()->client_id,
                'module_name' => Str::lower($module_name),
                'module_unique_id' => $module_unique_id,
                'created_by' => userInfo()->id,
                'audio_file' => $audio_file,
                'generate_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'generate_date_en' => Carbon::now()->toDateString(),
            ];

            return AudioFile::create($data);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public static function generateTingTingAccessToken()
    {
        try {
            $result = ApiAuthenticationHelper::authApi('ting-ting');

            $access_token = $result['data']['token']['access'];
            session()->put('ting_ting_access_token', $access_token);

            return $access_token;
        } catch (\Exception $e) {

        }
    }

    public static function tingTingAccessToken()
    {
        try {
            if (is_null(session()->get('ting_ting_access_token'))) {
                $access_token = VoiceCallManagementHelper::generateTingTingAccessToken();
            } else {
                $access_token = session()->get('ting_ting_access_token');
            }

            return $access_token;
        } catch (\Exception $e) {

        }
    }
}
