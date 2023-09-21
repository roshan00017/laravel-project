<?php

namespace App\Repositories\EDMIS;

use App\Helpers\DateConverter;
use App\Models\EDMIS\DcDocument;
use App\Models\EDMIS\DcRegisterBook;
use App\Models\EDMIS\DcRegisterBookLog;
use App\Repositories\CommonRepository;

class DartaKitabRepository
{
    private DateConverter $dateConverter;

    private DcRegisterBook $dcRegisterBook;

    private DcRegisterBookLog $dcRegisterBookLog;

    public function __construct(DateConverter $dateConverter, DcRegisterBook $dcRegisterBook, DcRegisterBookLog $dcRegisterBookLog)
    {
        $this->dateConverter = $dateConverter;
        $this->dcRegisterBook = $dcRegisterBook;
        $this->dcRegisterBookLog = $dcRegisterBookLog;
    }

    public function getAllDartaKitab($request)
    {
        $result = $this->dcRegisterBook;
        if (getLan() == 'np') {
            $date = 'regd_date_bs';
        } else {
            $date = 'regd_date_ad';
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

        if ($request->user_id != null) {
            $result = $result->where('added_by', $request->user_id);
        }

        if ($request->dispatch_no != null) {
            $result = $result->where('dispatch_no', $request->dispatch_no);
        }

        if ($request->regd_no != null) {
            $result = $result->where('regd_no', $request->regd_no);
        }

        if ($request->letter_no != null) {
            $result = $result->where('letter_no', $request->letter_no);
        }

        if ($request->letter_sub != null) {
            $result = $result->where('letter_sub', 'LIKE', '%'.$request->letter_sub.'%');
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

        if ($request->today != null) {
            $result = $result->where('entry_date_ad', decrypt($request->today));
        }

        //check client id
        CommonRepository::checkClientId($result);

        //request check fiscal year
        // CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getAllDcRegisterBookLog($request)
    {
        $result = $this->dcRegisterBookLog;
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

    public function getAllDocumentByRegNo($request, $regdNo)
    {
        $result = DcDocument::query();
        //        if (getLan() == 'np') {
        //            $date = 'regd_date_bs';
        //        } else {
        //            $date = 'regd_date_ad';
        //        }

        if ($request->regd_no != null) {
            $result = $result->where('regd_no', $request->regd_no);
        }

        if ($request->fy_code != null) {
            $result = $result->where('fiscal_year_id', $request->fy_code);
        }

        //        if ($request->from_date != null && $request->to_date == null) {
        //            $result = $result
        //                ->where($date, '>=', $request->from_date);
        //        }
        //
        //        if ($request->to_date != null && $request->from_date == null) {
        //            $result = $result
        //                ->where($date, '<=', $request->to_date);
        //        }
        //
        //        if ($request->from_date != null && $request->to_date != null) {
        //            $result = $result
        //                ->whereBetween($date, [$request->from_date, $request->to_date]);
        //        }
        //check client id
        CommonRepository::checkClientId($result);

        return $result
            ->where('document_no', $regdNo)
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
