<?php

namespace App\Http\Controllers\FrontEnd;

use App\Facades\NepaliDate;
use App\Http\Controllers\Controller;
use App\Models\Appointment\AppointmentStatus;
use App\Models\BasicDetails\DcStatus;
use App\Repositories\CalendarRepository;
use App\Repositories\FrontEnd\ChartRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class OfficeAutomationController extends Controller
{
    private ChartRepository $chartRepository;

    private CalendarRepository $calendarRepository;

    public function __construct(ChartRepository $chartRepository,
        CalendarRepository $calendarRepository)
    {
        $this->chartRepository = $chartRepository;
        $this->calendarRepository = $calendarRepository;
    }

    public function index(Request $request)
    {

        try {

            $page_title = getLan() == 'np' ? ' कार्यालय स्वचालन' : 'Office Automation';

            //status wise register book   chart data start
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $dcDispatchStatusList = DcStatus::select('id', $name.' '.'as name')->get();
            $dispatchBookJsData = '';
            $dispatchBookJsFinalData = '';
            $dispatchBookJsSeriesData = '';

            foreach ($dcDispatchStatusList as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->monthWiseDcDispatchBook($i, $status->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $dispatchBookJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$status->name.'",
            '.$dispatchBookJsData.'
            },';
                $dispatchBookJsFinalData .= $js_source_data;
            }
            $dispatchBookJsSeriesData = 'series:[
            '.$dispatchBookJsFinalData.'
            ]';
            //status wise register book   chart data end

            //status wise register book   chart data start
            $serviceModuleListList = DcStatus::select('id', $name.' '.'as name')->get();
            // $serviceModuleListList = ServiceModule::select('id', $name.' '.'as name', 'code')->get();

            //for status wise chart data
            $registerBookJsData = '';
            $registerBookJsFinalData = '';
            $registerBookJsSeriesData = '';

            foreach ($serviceModuleListList as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->monthWiseDcRegisterBook($i, $status->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $registerBookJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$status->name.'",
            '.$registerBookJsData.'
            },';
                $registerBookJsFinalData .= $js_source_data;
            }
            $registerBookJsSeriesData = 'series:[
            '.$registerBookJsFinalData.'
            ]';
            //status wise register book   chart data end

            //office automation module  appointment month wise chart  data start
            $appointmentStatus = AppointmentStatus::select('id', $name.' '.'as name')->whereIn('id', [1, 2])->get();

            $appointmentJsData = '';
            $appointmentJsFinalData = '';
            $appointmentJsSeriesData = '';

            foreach ($appointmentStatus as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->monthWiseAppointment($i, $status->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $appointmentJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$status->name.'",
            '.$appointmentJsData.'
            },';
                $appointmentJsFinalData .= $js_source_data;
            }
            $appointmentJsSeriesData = 'series:[
            '.$appointmentJsFinalData.'
            ]';
            //office automation module  appointment month wise chart  data end
            $monthNames = getLan() == 'np' ? $this->calendarRepository->nepaliMonthNames() : $this->calendarRepository->englishMonthNames();
            //calendar menu start
            $weekDays = $this->calendarRepository->weekDays();
            $todayDateNp = NepaliDate::create(Carbon::now())->toBS();
            $todayDateArr = explode('-', $todayDateNp);

            if ($request->year_code != null) {
                $year = $request->year_code;
            } else {
                $year = count($todayDateArr) > 0 ? $todayDateArr[0] : '';
            }
            if ($request->month_code != null) {
                $month = $request->month_code;
            } else {
                $month = count($todayDateArr) > 0 ? $todayDateArr[1] : '';
            }

            $year_code = $year;
            $month_code = $month;
            $month_name = $this->calendarRepository->getMonth($month);
            $year_month_en = $this->calendarRepository->getYearMonthEn($year, $month);
            $click_btn = $request->click_btn;

            $monthDays = $this->calendarRepository->getCalendarMonthDays($year, $month);
            $monthFirstDay = $this->calendarRepository->monthFirstDay($year, $month);

            $yearList = $this->calendarRepository->getYearList();
            $monthList = $this->calendarRepository->getMonthList();

            $monthDays = $this->calendarRepository->formatMonthDays($monthFirstDay, $monthDays);
            $monthFirstDay = $monthFirstDay;
            $calRepo = $this->calendarRepository;
            $monthNames = getLan() == 'np' ? $this->calendarRepository->nepaliMonthNames() : $this->calendarRepository->englishMonthNames();
            $monthFirstDay = $this->calendarRepository->monthFirstDay($year, $month);
            $page_url = 'office-automation-info';
            //calendar menu end

            return view('frontend.innerPage.officeAutomationInfo', compact(
                'page_title', 'dispatchBookJsSeriesData', 'registerBookJsSeriesData',
                'appointmentJsSeriesData', 'monthNames', 'weekDays',
                'year_code',
                'month_code',
                'month_name',
                'year_month_en',
                'click_btn',
                'yearList',
                'monthList',
                'monthDays',
                'monthFirstDay',
                'calRepo',
                'page_url',
            ));
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
