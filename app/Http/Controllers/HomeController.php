<?php

namespace App\Http\Controllers;

use App\Facades\NepaliDate;
use App\Models\Appointment\AppointmentStatus;
use App\Models\BasicDetails\ComplaintSource;
use App\Models\BasicDetails\DcStatus;
use App\Models\Grevience\SuggestionCategory;
use App\Models\MasterSettings\ServiceModule;
use App\Models\Meetings\MstMeetingStatus;
use App\Models\Models\Grevience\ComplaintStatus;
use App\Repositories\CalendarRepository;
use App\Repositories\ChartRepository;
use App\Repositories\DashboardRepository;
use App\Repositories\MMS\MeetingRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private DashboardRepository $dashboardRepository;

    private MeetingRepository $meetingRepository;

    private CalendarRepository $calendarRepository;

    private ChartRepository $chartRepository;

    public function __construct(DashboardRepository $dashboardRepository, MeetingRepository $meetingRepository,
        CalendarRepository $calendarRepository, ChartRepository $chartRepository)
    {
        $this->middleware('auth');
        parent::__construct();
        $this->dashboardRepository = $dashboardRepository;
        $this->meetingRepository = $meetingRepository;
        $this->calendarRepository = $calendarRepository;
        $this->chartRepository = $chartRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        try {

            $load_css = [
                // 'plugins/fullcalendar/design.css',
                'plugins/fullcalendar/main.css',

            ];

            $load_js = [
                'plugins/moment/main.js',
                'plugins/fullcalendar/main.js',
                'js/dashboard.js',
                'plugins/highcharts/js/highcharts.js',
                'plugins/highcharts/js/exporting.js',
                'plugins/highcharts/js/export-data.js',
                'plugins/highcharts/js/accessibility.js',
                'js/custom_app.min.js',

            ];

            $page_title = getLan() == 'np' ? 'ड्यासबोर्ड' : 'Dashboard';
            $page_url = 'dashboard';

            //edmis module start
            $total_dispatch = $this->dashboardRepository->getTotalDispatch();
            $total_register = $this->dashboardRepository->getTotalRegisterBook();
            $total_document = $this->dashboardRepository->getTotalDcDocument();
            $total_appointment = $this->dashboardRepository->getTotalAppointment();
            $total_schedule = $this->dashboardRepository->getTotalSchedule();
            $today_dispatch = $this->dashboardRepository->getTodayDispatch();
            $today_register = $this->dashboardRepository->getTodayRegister();
            $today_document = $this->dashboardRepository->getTodayDocument();
            $today_appointment = $this->dashboardRepository->getTodayAppointment();
            $today_schedule = $this->dashboardRepository->getTodaySchedule();

            $latestDcDocuments = $this->dashboardRepository->getLatestDcDocument();
            $latestDispatch = $this->dashboardRepository->getLatestDispatchBook();
            $latestRegister = $this->dashboardRepository->getLatestRegisterBook();
            //status wise register book   chart data start
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $dcDispatchStatusList = DcStatus::select('id', $name.' '.'as name')->get();
            $dispatchBookJsData = '';
            $dispatchBookJsFinalData = '';
            $dispatchBookJsSeriesData = '';

            foreach ($dcDispatchStatusList as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->getMonthWiseDcDispatchBook($i, $status->id);
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
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $serviceModuleListList = DcStatus::select('id', $name.' '.'as name')->get();
            // $serviceModuleListList = ServiceModule::select('id', $name.' '.'as name', 'code')->get();

            //for status wise chart data
            $registerBookJsData = '';
            $registerBookJsFinalData = '';
            $registerBookJsSeriesData = '';

            foreach ($serviceModuleListList as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->getMonthWiseDcRegisterBook($i, $status->id);
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

            //appointment  chart data start
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $appointmentStatus = AppointmentStatus::select('id', $name.' '.'as name')->whereIn('id', [1, 2])->get();

            //for status wise chart data
            $appointmentJsData = '';
            $appointmentJsFinalData = '';
            $appointmentJsSeriesData = '';

            foreach ($appointmentStatus as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->getMonthWiseAppointment($i, $status->id);
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
            //appointment chart end

            //edmis module end

            //meeting module start
            $total_meeting = $this->dashboardRepository->getTotalMeetingByStstusId();
            $total_pending_meeting = $this->dashboardRepository->getTotalMeetingByStstusId(1);
            $total_preponed_meeting = $this->dashboardRepository->getTotalMeetingByStstusId(4);
            $total_postponed_meeting = $this->dashboardRepository->getTotalMeetingByStstusId(3);
            $total_canceled_meeting = $this->dashboardRepository->getTotalMeetingByStstusId(2);
            $total_execute_meeting = $this->dashboardRepository->getTotalMeetingByStstusId(5);
            $latestMeeting = $this->dashboardRepository->getLatestMeeting();
            $today_meetings = $this->dashboardRepository->getTodayMeeting();

            $meetingRepo = $this->meetingRepository;

            //meeting status  chart
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $meetingStatusList = MstMeetingStatus::select('id', $name.' '.'as name')->get();
            $meetingJsData = '';
            $meetingJsFinalData = '';
            $meetingJsSeriesData = '';

            foreach ($meetingStatusList as $meetingStatus) {
                $status = $meetingStatus->id;
                $statusName = $meetingStatus->name;
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->getMonthWiseMeeting($i, $status);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $meetingJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$statusName.'",
            '.$meetingJsData.'
            },';
                $meetingJsFinalData .= $js_source_data;
            }
            $meetingJsSeriesData = 'series:[
            '.$meetingJsFinalData.'
            ]';
            //meeting module end

            //complaint module start
            $total_complaints = $this->dashboardRepository->getTotalComplaints();
            $total_skype = $this->dashboardRepository->getTotalBySourceId(1);
            $total_sms = $this->dashboardRepository->getTotalBySourceId(2);
            $total_twitter = $this->dashboardRepository->getTotalBySourceId(3);
            $total_facebook = $this->dashboardRepository->getTotalBySourceId(4);
            $total_national = $this->dashboardRepository->getTotalBySourceId(5);
            $total_international = $this->dashboardRepository->getTotalBySourceId(6);
            $total_website = $this->dashboardRepository->getTotalBySourceId(7);

            $total_suggestion = $this->dashboardRepository->getTotalsuggestion();
            $total_incident = $this->dashboardRepository->getTotalincident();

            $total_today_complaint = $this->dashboardRepository->getTodayComplaint();
            $total_today_suggestion = $this->dashboardRepository->getTodaySuggestion();
            $total_today_incident = $this->dashboardRepository->getTodayIncident();
            //status wise complaint chart data start
            $name = getLan() == 'np' ? 'name_ne' : 'name';
            $complaintStatusList = ComplaintStatus::select('id', $name.' '.'as name')->whereIn('id', [1, 2])->get();
            //for status wise chart data
            $complaintJsData = '';
            $complaintJsFinalData = '';
            $complaintJsSeriesData = '';

            foreach ($complaintStatusList as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->getMonthWiseComplaintStatusData($i, $status->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $complaintJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$status->name.'",
            '.$complaintJsData.'
            },';
                $complaintJsFinalData .= $js_source_data;
            }
            $complaintJsSeriesData = 'series:[
            '.$complaintJsFinalData.'
            ]';
            //status wise complaint chart data end

            //complaint source wise chart data start

            $name = getLan() == 'np' ? 'name_ne' : 'name';
            $complaintSourceList = ComplaintSource::select('id', $name.' '.'as name')->get();
            $complaintSourceJsData = '';
            $complaintSourceJsFinalData = '';
            $complaintSourceJsSeriesData = '';

            foreach ($complaintSourceList as $source) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->getMonthWiseComplaintSourceData($i, $source->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $complaintSourceJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$source->name.'",
            '.$complaintSourceJsData.'
            },';
                $complaintSourceJsFinalData .= $js_source_data;
            }
            $complaintSourceJsSeriesData = 'series:[
            '.$complaintSourceJsFinalData.'
            ]';
            //complaint source wise chart data end

            //categories wise suggestion chart data start
            $name = getLan() == 'np' ? 'name_ne' : 'name';
            $suggestionTypeList = SuggestionCategory::select('id', $name.' '.'as name')->get();
            $suggestionTypeJsData = '';
            $suggestionTypeFinalJsFinalData = '';
            $suggestionTypeJsSeriesData = '';

            foreach ($suggestionTypeList as $type) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->getMonthWiseSuggestionTypeData($i, $type->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $suggestionTypeJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$type->name.'",
            '.$suggestionTypeJsData.'
            },';
                $suggestionTypeFinalJsFinalData .= $js_source_data;
            }
            $suggestionTypeJsSeriesData = 'series:[
            '.$suggestionTypeFinalJsFinalData.'
            ]';

            //categories wise suggestion chart data end

            //incident  month wise  chart data start
            $incidentJsData = '';
            $incidentFinalJsFinalData = '';
            $incidentJsSeriesData = '';

            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $res_total = $this->chartRepository->getMonthWiseIncidentData($i);
                $data[] = $res_total[0]->totals ?? 0;

            }
            $coma_data = implode(', ', $data);
            $incidentJsData = 'data : ['.$coma_data.']';
            $js_source_data = '{
            name: "'.'Incident'.'",
            '.$incidentJsData.'
            },';
            $incidentFinalJsFinalData .= $js_source_data;
            $incidentJsSeriesData = 'series:[
            '.$incidentFinalJsFinalData.'
            ]';

            //incident  month wise  chart data end

            //complaint module end

            //dcc module module start
            $latestToken = $this->dashboardRepository->getLatestToken();
            $totalToken = $this->dashboardRepository->getTotalToken();
            $startToken = $this->dashboardRepository->getStartingToken();
            $completeToken = $this->dashboardRepository->getCompleteToken();
            $cancelToken = $this->dashboardRepository->getCanceledToken();

            if ($totalToken > 0) {
                $percentage = ($startToken / $totalToken) * 100;
                $percentage1 = ($cancelToken / $totalToken) * 100;
                $percentage2 = ($completeToken / $totalToken) * 100;

            } else {
                $percentage = 0;
                $percentage1 = 0;
                $percentage2 = 0;
            }
            $spercent = $percentage;
            $cancelpercent = $percentage1;
            $completepercent = $percentage2;

            $totalService = $this->dashboardRepository->getTotalService();

            //service token list chart data start
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $serviceModuleListList = ServiceModule::select('id', $name.' '.'as name', 'code')->get();
            $tokeServiceJsData = '';
            $tokenServiceJsFinalData = '';
            $tokenServiceJsSeriesData = '';

            foreach ($serviceModuleListList as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->getMonthWiseTokenServiceData($i, $status->code);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $tokeServiceJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$status->name.'",
            '.$tokeServiceJsData.'
            },';
                $tokenServiceJsFinalData .= $js_source_data;
            }
            $tokenServiceJsSeriesData = 'series:[
            '.$tokenServiceJsFinalData.'
            ]';
            //service token list chart data end

            //dcc module end

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
            $holidayTypes = [
                'all' => trans('calendar.all'),
                'province_only' => trans('calendar.province_only'),
                'valley_only' => trans('calendar.valley_only'),
                'district_only' => trans('calendar.district_only'),
                'local_body_only' => trans('calendar.local_body_only'),
            ];
            //calendar menu end

            //dailyworkingschedule
            $dailyWorkingSchedule = $this->dashboardRepository->getDailyWorkingSchedule();
            $working_page_title = getLan() == 'np' ? 'दैनिक कार्य तालिका' : 'Daily Working Schedule';

            return view('backend.dashboard.mainDashboard',
                compact(
                    'load_css',
                    'load_js',
                    'meetingJsSeriesData',
                    'meetingJsSeriesData',
                    'total_meeting',
                    'total_pending_meeting',
                    'total_preponed_meeting',
                    'total_postponed_meeting',
                    'total_canceled_meeting',
                    'total_execute_meeting',
                    'total_complaints',
                    'total_skype',
                    'total_sms',
                    'total_twitter',
                    'total_facebook',
                    'total_national',
                    'total_international',
                    'total_website',
                    'total_suggestion',
                    'total_incident',
                    'total_today_complaint',
                    'total_today_suggestion',
                    'total_today_incident',
                    'today_meetings',
                    'latestToken',
                    'totalToken',
                    'startToken',
                    'completeToken',
                    'cancelToken',
                    'cancelToken',
                    'spercent',
                    'cancelpercent',
                    'completepercent',
                    'page_title',
                    'meetingRepo',
                    'weekDays',
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
                    'calRepo',
                    'page_url',
                    'total_dispatch',
                    'total_register',
                    'total_document',
                    'registerBookJsSeriesData',
                    'dispatchBookJsSeriesData',
                    'meetingJsSeriesData',
                    'monthNames',
                    'complaintJsSeriesData',
                    'complaintSourceJsSeriesData',
                    'suggestionTypeJsSeriesData',
                    'incidentJsSeriesData',
                    'tokenServiceJsSeriesData',
                    'totalService',
                    'holidayTypes',
                    'todayDateNp',
                    'today_dispatch',
                    'today_register',
                    'today_document',
                    'total_appointment',
                    'today_appointment',
                    'appointmentJsSeriesData',
                    'total_schedule',
                    'today_schedule',
                    'dailyWorkingSchedule',
                    'working_page_title',

                ));
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
