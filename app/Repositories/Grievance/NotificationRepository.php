<?php

namespace App\Repositories\Grievance;

use App\Helpers\DateConverter;
use App\Models\Grevience\Notification;
use App\Repositories\CommonRepository;

class NotificationRepository
{
    private DateConverter $dateConverter;

    private Notification $suggestion;

    public function __construct(DateConverter $dateConverter, Notification $suggestion)
    {
        $this->dateConverter = $dateConverter;
        $this->suggestion = $suggestion;
    }

    public function getAllNotifications($request)
    {
        if (getLan() == 'np') {
            $date = 'notify_date_np';
        } else {
            $date = 'notify_date_en';
        }
        $result = $this->suggestion;
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

        if ($request->notify_type != null) {
            $result = $result->where('notify_type', $request->notify_type);
        }
        //request form notification header
        if ($request->type != null) {
            $result = $result->where('notify_type', decrypt($request->type));
        }
        // Check client id
        CommonRepository::checkClientId($result);
        //request check fiscal year
        CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
