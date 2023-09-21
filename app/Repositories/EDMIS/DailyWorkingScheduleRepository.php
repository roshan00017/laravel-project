<?php

namespace App\Repositories\EDMIS;

use App\Models\Appointment\DailyWorkingSchedule;
use App\Repositories\CommonRepository;
use Carbon\Carbon;

class DailyWorkingScheduleRepository
{
    private DailyWorkingSchedule $dailyWorkingSchedule;

    public function __construct(DailyWorkingSchedule $dailyWorkingSchedule)
    {
        $this->dailyWorkingSchedule = $dailyWorkingSchedule;
    }

    public function getAllDailyWorkingSchedules($request)
    {
        $result = $this->dailyWorkingSchedule;

        if ($request->title != null) {
            $result = $result->where('title', 'like', '%'.$request->title.'%');
        }

        if ($request->schedule_type != null) {
            $result = $result->where('schedule_type', $request->schedule_type);
        }

        if ($request->start_time != null) {
            $result = $result->where('start_time', $request->start_time);
        }

        if ($request->end_time != null) {
            $result = $result->where('end_time', $request->end_time);
        }

        if ($request->location != null) {
            $result = $result->where('location', 'like', '%'.$request->location.'%');
        }

        //today data get by dashboard
        if ($request->today != null) {
            $result = $result->where('schedule_date_en', Carbon::now()->toDateString());
        }

        // Check client id
        CommonRepository::checkClientId($result);
        //check appointment user module
        CommonRepository::appointUserModule($result, 'schedule_type', 'schedule_to_person_id');
        //request check fiscal year
        CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
