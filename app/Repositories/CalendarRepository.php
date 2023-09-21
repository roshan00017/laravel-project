<?php

namespace App\Repositories;

use App\Facades\NepaliDate;
use App\Models\Calendar\Calendar;
use App\Models\Calendar\CalendarHoliday;
use App\Models\Calendar\CalendarHolidayDay;
use App\Models\Calendar\CalendarMonth;
use App\Models\Calendar\CalendarWeekDay;
use App\Models\Calendar\CalendarYear;
use App\Models\Meetings\Meeting;
use Carbon\Carbon;

class CalendarRepository
{
    private Calendar $calendar;

    private HolidayRepository $holidayRepository;

    public function __construct(Calendar $calendar, HolidayRepository $holidayRepository)
    {
        $this->calendar = $calendar;
        $this->holidayRepository = $holidayRepository;
    }

    public function all($request)
    {
        $data = $this->calendar
            ->where('status', true);

        if ($request->fy_code != null) {
            $data = $data->where('fy_code', $request->fy_code);
        }

        if ($request->month_code != null) {
            $data = $data->where('month_code', $request->month_code);
        }

        if ($request->week_day_code != null) {
            $data = $data->where('week_day_code', $request->week_day_code);
        }

        if (count($request->all()) > 0) {
            $data = $data
                ->orderBy('id', 'desc')
                ->paginate(30);
        } else {
            $currentDateArr = explode('-', NepaliDate::create(Carbon::now())->toBS());
            $currentYr = count($currentDateArr) > 0 ? $currentDateArr[0] : '';
            $data = $data
                ->where('fy_code', $currentYr)
                ->orderBy('id', 'asc')
                ->paginate(30);
        }

        return $data;
    }

    public function months()
    {
        $name = getLan() == 'np' ? 'calendar_months.name_np as name' : 'calendar_months.name_en as name';

        return CalendarMonth::select('id', $name, 'code')->get();
    }

    public function weekDays()
    {
        $name = getLan() == 'np' ? 'calendar_week_days.name_np as name' : 'calendar_week_days.name_en as name';

        return CalendarWeekDay::select('id', $name, 'code')->get();
    }

    public function getDay($year, $month, $day)
    {

        return Calendar::where('fy_code', $year)->where('month_code', $month)->where('day', $day)->first();
    }

    public function getCalendarMonthDays($year, $month)
    {
        return Calendar::where('fy_code', $year)
            ->where('month_code', $month)
            ->where('status', true)
            ->orderBy('day', 'asc')
            ->get();
    }

    public function monthFirstDay($year, $month)
    {
        return Calendar::where('fy_code', $year)
            ->where('month_code', $month)
            ->where('day', 1)
            ->where('status', true)
            ->first();
    }

    public function getHoliday($year, $month, $day)
    {
        $user = userInfo();
        $formattedDay = $day < 10 ? '0'.$day : $day;
        $date = $year.'-'.$month.'-'.$formattedDay;
        $holidayName = getLan() == 'np' ? 'calendar_holidays.name_np as name' : 'calendar_holidays.name_en as name';
        $applyToAllHolidays = CalendarHoliday::where('date_np', $date)
            ->where('holiday_type', 'all')
            ->where('status', true)
            ->select('calendar_holidays.*', $holidayName)
            ->get();

        $provinceName = getLan() == 'np' ? 'mst_federal_hierarchy.name_np as province_name' : 'mst_federal_hierarchy.name_en as province_name';
        $applyToProvinceHolidays = CalendarHolidayDay::query()
            ->join('calendar_holidays', 'calendar_holidays.id', 'calendar_holiday_days.calendar_holiday_id')
            ->join('mst_federal_hierarchy', 'mst_federal_hierarchy.id', 'calendar_holiday_days.gov_body_id')
            ->where('calendar_holidays.date_np', $date)
            ->where('calendar_holiday_days.gov_body_id', $user->province_code)
            ->where('calendar_holidays.holiday_type', 'province_only')
            ->where('calendar_holidays.status', true)
            ->select('calendar_holidays.*', $holidayName, $provinceName)
            ->get();

        $districtName = getLan() == 'np' ? 'mst_federal_hierarchy.name_np as valley_name' : 'mst_federal_hierarchy.name_en as valley_name';
        $applyToValleyHolidays = CalendarHolidayDay::query()
            ->join('calendar_holidays', 'calendar_holidays.id', 'calendar_holiday_days.calendar_holiday_id')
            ->join('mst_federal_hierarchy', 'mst_federal_hierarchy.id', 'calendar_holiday_days.gov_body_id')
            ->where('calendar_holidays.date_np', $date)
            ->where('calendar_holiday_days.gov_body_id', $user->district_code)
            ->where('calendar_holidays.holiday_type', 'valley_only')
            ->where('calendar_holidays.status', true)
            ->select('calendar_holidays.*', $holidayName, $districtName)
            ->get();

        $districtName = getLan() == 'np' ? 'mst_federal_hierarchy.name_np as district_name' : 'mst_federal_hierarchy.name_en as district_name';
        $applyToDistrictHolidays = CalendarHolidayDay::query()
            ->join('calendar_holidays', 'calendar_holidays.id', 'calendar_holiday_days.calendar_holiday_id')
            ->join('mst_federal_hierarchy', 'mst_federal_hierarchy.code', 'calendar_holiday_days.gov_body_id')
            ->where('calendar_holidays.date_np', $date)
            ->where('calendar_holiday_days.gov_body_id', $user->district_code)
            ->where('calendar_holidays.holiday_type', 'district_only')
            ->where('calendar_holidays.status', true)
            ->select('calendar_holidays.*', $holidayName, $districtName)
            ->get();

        $muniName = getLan() == 'np' ? 'mst_federal_hierarchy.name_np as local_body_name' : 'mst_federal_hierarchy.name_en as local_body_name';
        $applyToLocalBodyHolidays = CalendarHolidayDay::query()
            ->join('calendar_holidays', 'calendar_holidays.id', 'calendar_holiday_days.calendar_holiday_id')
            ->join('mst_federal_hierarchy', 'mst_federal_hierarchy.id', 'calendar_holiday_days.gov_body_id')
            ->where('calendar_holidays.date_np', $date)
            ->where('calendar_holiday_days.gov_body_id', $user->client_id)
            ->where('calendar_holidays.holiday_type', 'local_body_only')
            ->where('calendar_holidays.status', true)
            ->select('calendar_holidays.*', $holidayName, $muniName)
            ->get();

        $data['apply_to_all'] = $applyToAllHolidays;
        $data['apply_to_province'] = $applyToProvinceHolidays;
        $data['apply_to_district'] = $applyToDistrictHolidays;
        $data['apply_to_valley'] = $applyToValleyHolidays;
        $data['apply_to_localBody'] = $applyToLocalBodyHolidays;

        return $data;
    }

    public function getMeetingDay($year, $month, $day)
    {
        $formattedDay = $day < 10 ? '0'.$day : $day;
        $date = $year.'-'.$month.'-'.$formattedDay;

        return Meeting::where('meeting_date_bs', $date)
            ->select('title')
            ->get();
    }

    public function govBodies($type, $id)
    {
        return $this->holidayRepository->govBodies($type, $id);
    }

    public function nepaliDateFormatter($year, $month, $day)
    {

        $monthName = getLan() == 'np' ? 'calendar_months.name_np as month_name' : 'calendar_months.name_en as month_name';
        $weekDayName = getLan() == 'np' ? 'calendar_week_days.name_np as day_name' : 'calendar_week_days.name_en as day_name';
        $data = Calendar::query()
            ->join('calendar_months', 'calendar_months.code', 'calendars.month_code')
            ->join('calendar_week_days', 'calendar_week_days.code', 'calendars.week_day_code')
            ->where('fy_code', $year)
            ->where('month_code', $month)
            ->where('day', $day)
            ->select('calendars.fy_code', $monthName, $weekDayName, 'calendars.day', 'calendars.full_date_en', 'calendars.full_date')
            ->first();
        $newArr['date_en'] = Carbon::parse($data->full_date_en)->format('d F Y');
        $newArr['date_np'] = $data ? $data->day.' '.$data->month_name.' '.$data->fy_code.' '.$data->day_name : '';

        return $newArr;
    }

    public function getYearList()
    {
        return CalendarYear::query()->get();
    }

    public function getMonthList()
    {
        $monthName = getLan() == 'np' ? 'name_np as name' : 'name_en as name';

        return CalendarMonth::query()->select('id', 'code', $monthName)->where('status', true)->get();
    }

    public function formatMonthDays($monthFirstDay, $monthDays)
    {
        if ($monthFirstDay->week_day_code == '01') {
            unset($monthDays[0]);
            unset($monthDays[1]);
            unset($monthDays[2]);
            unset($monthDays[3]);
            unset($monthDays[4]);
            unset($monthDays[5]);
            unset($monthDays[6]);
        } elseif ($monthFirstDay->week_day_code == '02') {
            unset($monthDays[0]);
            unset($monthDays[1]);
            unset($monthDays[2]);
            unset($monthDays[3]);
            unset($monthDays[4]);
            unset($monthDays[5]);
        } elseif ($monthFirstDay->week_day_code == '03') {
            unset($monthDays[0]);
            unset($monthDays[1]);
            unset($monthDays[2]);
            unset($monthDays[3]);
            unset($monthDays[4]);
        } elseif ($monthFirstDay->week_day_code == '04') {
            unset($monthDays[0]);
            unset($monthDays[1]);
            unset($monthDays[2]);
            unset($monthDays[3]);
        } elseif ($monthFirstDay->week_day_code == '05') {
            unset($monthDays[0]);
            unset($monthDays[1]);
            unset($monthDays[2]);
        } elseif ($monthFirstDay->week_day_code == '06') {
            unset($monthDays[0]);
            unset($monthDays[1]);
        } elseif ($monthFirstDay->week_day_code == '07') {
            unset($monthDays[0]);
        }

        return $monthDays->chunk(7);
    }

    public function getMonth($code)
    {
        $monthName = getLan() == 'np' ? 'calendar_months.name_np as name' : 'calendar_months.name_en as name';
        $data = CalendarMonth::query()
            ->select('code', $monthName)
            ->where('code', $code)
            ->first();

        return $data->name;
    }

    public function getYearMonthEn($year, $month)
    {
        $dataFirst = Calendar::query()
            ->select('full_date_en')
            ->where('fy_code', $year)
            ->where('month_code', $month)
            ->first();
        $dataLast = Calendar::query()
            ->select('full_date_en')
            ->where('fy_code', $year)
            ->where('month_code', $month)
            ->orderBy('id', 'DESC')
            ->first();
        $yr = Carbon::parse($dataFirst->full_date_en)->format('Y');
        $firstMonthName = Carbon::parse($dataFirst->full_date_en)->format('F');
        $lastMonthName = Carbon::parse($dataLast->full_date_en)->format('F');
        $data['year_en'] = $yr;
        $data['first_month_en'] = $firstMonthName;
        $data['last_month_en'] = $lastMonthName;

        return $data;
    }

    public function nepaliMonthNames()
    {
        return [
            4 => 'श्रावण',
            5 => 'भाद्र',
            6 => 'आश्विन',
            7 => 'कार्तिक',
            8 => 'मंसिर',
            9 => 'पौष',
            10 => 'माघ',
            11 => 'फागुन',
            12 => 'चैत्र',
            1 => 'बैशाख',
            2 => 'जेष्ठ',
            3 => 'आषाढ',
        ];
    }

    public function englishMonthNames()
    {
        return [
            4 => 'July',
            5 => 'Aug',
            6 => 'Sep',
            7 => 'Oct',
            8 => 'Nov',
            9 => 'Dec',
            10 => 'Jan',
            11 => 'Feb',
            12 => 'Mar',
            1 => 'Apr',
            2 => 'May',
            3 => 'June',
        ];
    }
}
