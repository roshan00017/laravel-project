<?php

namespace App\Repositories\EDMIS;

use App\Helpers\DateConverter;
use App\Models\EDMIS\DcDispatchBook;
use App\Models\EDMIS\DcDispatchBookStatusLog;
use App\Repositories\CommonRepository;

class DispatchRepository
{
    private DateConverter $dateConverter;

    private DcDispatchBook $dcDispatchBook;

    private DcDispatchBookStatusLog $dcDispatchBookStatusLog;

    public function __construct(DateConverter $dateConverter, DcDispatchBook $dcDispatchBook, DcDispatchBookStatusLog $dcDispatchBookStatusLog)
    {
        $this->dateConverter = $dateConverter;
        $this->dcDispatchBook = $dcDispatchBook;
        $this->dcDispatchBookStatusLog = $dcDispatchBookStatusLog;
    }

    public function gatAllDocumentStatus($request)
    {
        //set login in log date
        //        if (getLan() == 'np') {
        //            $log_date = 'date_np';
        //        } else {
        //            $log_date = 'date_en';
        //        }
        $result = $this->dcDispatchBook;

        if ($request->user_id != null) {
            $result = $result->where('added_by', $request->user_id);
        }

        if ($request->fy_code != null) {
            $result = $result->where('fiscal_year_id', $request->fy_code);
        }

        if ($request->fy_code != null) {
            $result = $result->where('fiscal_year_id', $request->fy_code);
        }

        if ($request->ward != null) {
            $result = $result->where('ward_no', $request->ward);
        }

        if ($request->employee_id != null) {
            $result = $result->where('employee_id', $request->employee_id);
        }

        if (userInfo()->client_id != null) {
            $result = $result->where('client_id', userInfo()->client_id);
        }

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getAllDispatchBook($request)
    {
        $result = $this->dcDispatchBook;
        if (getLan() == 'np') {
            $date = 'dispatch_date_bs';
        } else {
            $date = 'dispatch_date_ad';
        }

        if ($request->dispatch_no != null) {
            $result = $result->where('dispatch_no', $request->dispatch_no);
        }

        if ($request->letter_no != null) {
            $result = $result->where('letter_no', $request->letter_no);
        }

        if ($request->letter_no != null) {
            $result = $result->where('letter_no', $request->letter_no);
        }

        if ($request->letter_status != null) {
            $result = $result->where('letter_status', $request->letter_status);
        }

        if ($request->from_branch_id != null) {
            $result = $result->where('from_branch_id', $request->from_branch_id);
        }

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where($date, '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->whereBetween($date, [$request->from_date, $request->to_date]);
        }
        //check client id
        CommonRepository::checkClientId($result);
        //today data get by dashboard
        if ($request->today != null) {
            $result = $result->where('dispatch_date_ad', decrypt($request->today));
        }

        //request check fiscal year
        // CommonRepository::fiscalYearData($result,$request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getAllDispatchLog()
    {
        // $result = $this->dcDispatchBookStatusLog;
        // if (getLan() == 'np') {
        //     $date = 'dispatch_date_bs';
        // } else {
        //     $date = 'dispatch_date_ad';
        // }
        // if ($request->to_date != null && $request->from_date == null) {
        //     $result = $result
        //         ->where($date, '<=', $request->to_date);
        // }
        return $this->dcDispatchBookStatusLog->orderBy('id', 'DESC')->paginate(10);
    }

    public function getAllDcDispatchBookLog($request)
    {
        $result = $this->dcDispatchBookStatusLog;
        if (getLan() == 'np') {
            $date = 'update_date_np';
        } else {
            $date = 'update_date_en';
        }

        if ($request->updated_by != null) {
            $result = $result->where('updated_by', $request->user_id);
        }

        if ($request->regd_no != null) {
            $result = $result->where('regd_no', $request->regd_no);
        }

        if ($request->status_id != null) {
            $result = $result->where('status_id', $request->status_id);
        }

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where($date, '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->whereBetween($date, [$request->from_date, $request->to_date]);
        }
        //check client id
        CommonRepository::checkClientId($result);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
