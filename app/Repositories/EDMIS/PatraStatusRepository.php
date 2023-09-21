<?php

namespace App\Repositories\EDMIS;

use App\Helpers\DateConverter;
use App\Models\EDMIS\DcDocument;

class PatraStatusRepository
{
    private DateConverter $dateConverter;

    private DcDocument $dcDocument;

    public function __construct(DateConverter $dateConverter, DcDocument $dcDocument)
    {
        $this->dateConverter = $dateConverter;
        $this->dcDocument = $dcDocument;
    }

    public function gatAllDocumentStatus($request)
    {
        //set login in log date
        //        if (getLan() == 'np') {
        //            $log_date = 'date_np';
        //        } else {
        //            $log_date = 'date_en';
        //        }
        $result = $this->dcDocument;

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
}
