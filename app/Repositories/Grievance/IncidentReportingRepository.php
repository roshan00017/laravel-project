<?php

namespace App\Repositories\Grievance;

use App\Helpers\DateConverter;
use App\Models\Grevience\IncidentReporting;
use App\Repositories\CommonRepository;

class IncidentReportingRepository
{
    private DateConverter $dateConverter;

    private IncidentReporting $incidentReporting;

    public function __construct(DateConverter $dateConverter, IncidentReporting $incidentReporting)
    {
        $this->dateConverter = $dateConverter;
        $this->incidentReporting = $incidentReporting;
    }

    public function getAllIncidentReportings($request)
    {
        if (getLan() == 'np') {
            $date = 'incident_submit_date_np';
        } else {
            $date = 'incident_submit_date_en';
        }
        $result = $this->incidentReporting;
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

        if ($request->name != null) {
            $result = $result->where('name', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->title != null) {
            $result = $result->where('title', 'LIKE', '%'.$request->name.'%');
        }
        if ($request->mobile != null) {
            $result = $result->where('mobile', $request->mobile);
        }
        //today data get by dashboard
        if ($request->today != null) {
            $result = $result->where('incident_submit_date_en', decrypt($request->today));
        }
        if (userInfo()->client_id != null) {
            $result = $result->where('client_id', userInfo()->client_id);
        }

        //request check fiscal year
        CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
