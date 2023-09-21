<?php

namespace App\Repositories\Grievance;

use App\Helpers\DateConverter;
use App\Models\Grevience\Complaint;
use App\Models\Models\Grevience\ComplaintStatus;
use App\Repositories\CommonRepository;

class ComplaintRepository
{
    private DateConverter $dateConverter;

    private Complaint $complaint;

    public function __construct(DateConverter $dateConverter, Complaint $complaint)
    {
        $this->dateConverter = $dateConverter;
        $this->complaint = $complaint;
    }

    public function getAllComplaints($request)
    {
        if (getLan() == 'np') {
            $date = 'complaint_date_np';
        } else {
            $date = 'complaint_date_en';
        }
        $result = $this->complaint;
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

        if ($request->mobile_no != null) {
            $result = $result->where('mobile_no', $request->mobile_no);
        }

        if ($request->email != null) {
            $result = $result->where('email', $request->mobile_no);
        }
        if (userInfo()->client_id != null) {
            $result = $result->where('client_id', userInfo()->client_id);
        }

        //today data get by dashboard
        if ($request->today != null) {
            $result = $result->where('complaint_date_en', decrypt($request->today));
        }

        //complaint source data get by dashboard
        if ($request->source != null) {
            $result = $result->where('complaint_source_id', decrypt($request->source));
        }
        //request check fiscal year
        CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function statusListByComplaint()
    {
        $name = getLan() == 'np' ? 'name_ne' : 'name';

        return ComplaintStatus::query()->whereIn('id', [3, 8])->get()->pluck($name, 'id');
    }
}
