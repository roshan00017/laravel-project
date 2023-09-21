<?php

namespace App\Helpers;

use App\Facades\NepaliDate;
use App\Models\TokenManagement\Token;
use App\Models\TokenManagement\TokenLog;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TokenHelper
{
    public static function generateUniqueTokenNo($client_id = null, $module_name = null)
    {
        $randomNumber = mt_rand(1000000000, 9999999999);
        $count = Token::where(['client_id' => $client_id, 'module_name' => $module_name])->count();
        $serialNo = $count + 1;
        $prefix = mb_substr(strtoupper($module_name), 0, 3);
        $val = currentFy();
        $code = explode('/', $val->code);
        $str1 = (string) $code[0];
        $str2 = (string) $code[1];
        $yrCode1 = (int) $str1[-2].(int) $str1[-1];
        $yrCode2 = (int) $str2[-2].(int) $str2[-1];

        if ($count > 0) {
            return $prefix ? $prefix.'-'.self::generateUniqueTokenNo() : self::generateUniqueTokenNo();
        } else {
            return $prefix ? $prefix.'-'.$yrCode1.$yrCode2.$client_id.$serialNo : $yrCode1.$yrCode2.$randomNumber;
        }
    }

    public static function storeToken($module_name,
        $module_service_name = null,
        $status_np = null,
        $status_en = null,
        $module_status_id = null,
        $module_unique_id = null,
    ) {
        if (empty(@userInfo()->client_id)) {
            $clientId = env('CLIENT_ID');
        } else {
            $clientId = @userInfo()->client_id;
        }
        try {
            DB::beginTransaction();

            $data = [
                'client_id' => $clientId,
                'module_name' => Str::lower($module_name),
                'module_service_name' => Str::lower($module_service_name),
                'status_title_np' => $status_np,
                'status_title_en' => $status_en,
                'module_status_id' => $module_status_id,
                'module_unique_id' => $module_unique_id,
                'date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'date_en' => Carbon::now()->toDateString(),
                'token_month_code' => (int) explode('-', NepaliDate::create(Carbon::now())->toBS())[1],
                'token_no' => TokenHelper::generateUniqueTokenNo($clientId, $module_name),
            ];

            DB::commit();

            return Token::create($data);
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public static function storeTokenLog($tokenNo, $status_np = null, $status_en = null, $module_status_id = null, $module_unique_id = null)
    {
        if (empty(@userInfo()->client_id)) {
            $clientId = env('CLIENT_ID');
        } else {
            $clientId = @userInfo()->client_id;
        }
        try {
            DB::beginTransaction();

            $data = [
                'client_id' => $clientId,
                'status_title_np' => $status_np,
                'status_title_en' => $status_en,
                'module_status_id' => $module_status_id,
                'date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'date_en' => Carbon::now()->toDateString(),
                'token_no' => $tokenNo,
            ];

            DB::commit();

            return TokenLog::create($data);
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
