<?php

namespace App\Repositories;

use App\Models\Calendar\CalendarHoliday;
use App\Models\Calendar\CalendarHolidayDay;
use App\Models\Calendar\CalendarMonth;

class HolidayRepository
{
    private CalendarHoliday $calendarHoliday;

    private CalendarHolidayDay $calendarHolidayDays;

    public function __construct(CalendarHoliday $calendarHoliday, CalendarHolidayDay $calendarHolidayDays)
    {
        $this->calendarHoliday = $calendarHoliday;
        $this->calendarHolidayDays = $calendarHolidayDays;
    }

    public function all($request)
    {
        if (systemAdmin() == false) {
            $userLocationId = userInfo()->client_id;
        } else {
            $userLocationId = 0;
        }

        $data = $this->calendarHoliday;
        if ($userLocationId > 0) {
            $data = $data
                ->whereIn('id', function ($query) use ($userLocationId) {
                    $query->select('calendar_holiday_id')
                        ->where('gov_body_id', $userLocationId)
                        ->from('calendar_holiday_days')
                        ->get();
                });
        }

        if ($request->from_date != null) {
            if ($request->to_date != null) {
                $data = $data->whereBetween('date_np', [$request->from_date, $request->to_date]);
            } else {
                $data = $data->whereBetween('date_np', [$request->from_date, $request->from_date]);
            }
        }

        return $data->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getMonth($code)
    {
        $name = getLan() == 'np' ? 'calendar_months.name_np as name' : 'calendar_months.name_en as name';

        return CalendarMonth::select('id', $name)->where('code', $code)->first();
    }

    public function govBodies($type, $holidayId)
    {
        if ($type == 'province_only') {
            $provinceName = getLan() == 'np' ? 'mst_federal_hierarchy.name_np as name' : 'mst_federal_hierarchy.name_en as name';

            return CalendarHolidayDay::join('mst_federal_hierarchy', 'mst_federal_hierarchy.id', '=', 'calendar_holiday_days.gov_body_id')
                ->where('calendar_holiday_id', $holidayId)
                ->select('calendar_holiday_days.*', $provinceName)
                ->get();

        } elseif ($type == 'district_only') {
            $districtName = getLan() == 'np' ? 'mst_federal_hierarchy.name_np as name' : 'mst_federal_hierarchy.name_en as name';

            return CalendarHolidayDay::join('mst_federal_hierarchy', 'mst_federal_hierarchy.id', '=', 'calendar_holiday_days.gov_body_id')
                ->where('calendar_holiday_id', $holidayId)
                ->select('calendar_holiday_days.*', $districtName)
                ->get();

        } elseif ($type == 'valley_only') {
            $districtName = getLan() == 'np' ? 'districts.name_np as name' : 'districts.name_en as name';

            return CalendarHolidayDay::join('mst_federal_hierarchy', 'mst_federal_hierarchy.id', '=', 'calendar_holiday_days.gov_body_id')
                ->where('calendar_holiday_id', $holidayId)
                ->select('calendar_holiday_days.*', $districtName)
                ->get();
        } elseif ($type == 'local_body_only') {
            $muniName = getLan() == 'np' ? 'mst_federal_hierarchy.name_np as name' : 'mst_federal_hierarchy.name_en as name';

            return CalendarHolidayDay::join('mst_federal_hierarchy', 'mst_federal_hierarchy.id', '=', 'calendar_holiday_days.gov_body_id')
                ->where('calendar_holiday_id', $holidayId)
                ->select('calendar_holiday_days.*', $muniName)
                ->get();
        }
    }

    public function getCalendarHolidayDays($id)
    {
        $daysData = CalendarHolidayDay::select('gov_body_id')->where('calendar_holiday_id', $id)->get();
        $newArr = [];
        if (count($daysData) > 0) {
            foreach ($daysData as $item) {
                $newArr[] = $item->gov_body_id;
            }
        }

        return $newArr;
    }
}
