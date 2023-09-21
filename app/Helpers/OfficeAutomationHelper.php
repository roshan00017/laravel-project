<?php

namespace App\Helpers;

use App\Facades\NepaliDate;
use App\Models\EDMIS\DcDispatchBookStatusLog;
use App\Models\EDMIS\DcRegisterBookLog;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class OfficeAutomationHelper
{
    public static function storeDcDispatchBookStatusLog($dispacth_id, $status_id = null)
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
                'dc_dispatch_book_id' => $dispacth_id,
                'status_id' => $status_id,
                'update_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'update_date_en' => Carbon::now()->toDateString(),
                'updated_by' => userInfo()->id,
            ];

            DB::commit();

            return DcDispatchBookStatusLog::create($data);
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public static function storeDcRegisterBookStatusLog($dc_regd_book_id, $status_id = null)
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
                'dc_regd_book_id' => $dc_regd_book_id,
                'status_id' => $status_id,
                'update_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'update_date_en' => Carbon::now()->toDateString(),
                'updated_by' => userInfo()->id,
            ];

            DB::commit();

            return DcRegisterBookLog::create($data);
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
