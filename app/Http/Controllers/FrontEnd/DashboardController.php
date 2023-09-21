<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\TokenStatusRequest;
use App\Models\Appointment\Appointment;
use App\Models\Appointment\AppointmentStatus;
use App\Models\Grevience\Complaint;
use App\Models\Meetings\MstMeetingStatus;
use App\Models\Models\Grevience\ComplaintStatus;
use App\Repositories\CalendarRepository;
use App\Repositories\FrontEnd\ChartRepository;
use App\Repositories\FrontEnd\DashboardRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    private DashboardRepository $dashboardRepository;

    private ChartRepository $chartRepository;

    private CalendarRepository $calendarRepository;

    public function __construct(DashboardRepository $dashboardRepository, ChartRepository $chartRepository,
                                CalendarRepository  $calendarRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
        $this->chartRepository = $chartRepository;
        $this->calendarRepository = $calendarRepository;
    }

    public function index(Request $request)
    {

        try {
            Session::forget('complaint');

            //            $complaintsCount = DB::table('complaints as c')
            //                ->leftJoin('form_categories as fc', 'fc.id', 'c.form_category_id')
            //                ->groupBy('form_category_id', 'fc.name', 'fc.name_ne')
            //                ->select('form_category_id', DB::raw('count(*) as total'), 'fc.name', 'fc.name_ne')
            //                ->get();
            //            $complaintsCountArray = count($complaintsCount);
            //            $labels = collect([]);
            //            $data = collect([]);
            //
            //            for ($i = 0; $i < $complaintsCountArray; $i++) {
            //                $labels->push($complaintsCount[$i]->name);
            //                $data->push($complaintsCount[$i]->total);
            //            }
            //
            //            $chart = new ComplaintsChart();
            //            $chart->labels($labels);
            //            $dataset = $chart->dataset('My dataset', 'pie', $data);
            //            $dataset->backgroundColor(collect(['#264653', '#2a9d8f', '#e9c46a', '#f4a261', '#e76f51']));
            //            $dataset->color(collect(['#264653', '#2a9d8f', '#e9c46a', '#f4a261', '#e76f51']));
            //            $data['complaintsCount'] = $this->dashboardRepository->getComplaintCount();
            //
            //            $data['suggestions'] = $this->dashboardRepository->getSuggestion();
            //            $data['suggestionsCount'] = $this->dashboardRepository->getSuggestionCount();
            //            $data['complaint_sources'] = $this->dashboardRepository->getCountComplaintSource();
            //            $data['chart'] = $chart;

            //call api url details
            //$data['documentDetails']= AppClientApiHelper::getClientInfo('documents-api');
            //            $data['newsDetails'] = AppClientApiHelper::getClientInfo('articles-api');

            //office automation module  appointment month wise chart  data start
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $appointmentStatus = AppointmentStatus::select('id', $name . ' ' . 'as name')->whereIn('id', [1, 2])->get();

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
                $appointmentJsData = 'data : [' . $coma_data . ']';
                $js_source_data = '{
            name: "' . $status->name . '",
            ' . $appointmentJsData . '
            },';
                $appointmentJsFinalData .= $js_source_data;
            }
            $appointmentJsSeriesData = 'series:[
            ' . $appointmentJsFinalData . '
            ]';
            //office automation module  appointment month wise chart  data end

            //ghs module  appointment month wise chart  data start
            $statusName = getLan() == 'np' ? 'name_ne' : 'name';
            $complaintStatusList = ComplaintStatus::select('id', $statusName . ' ' . 'as name')->whereIn('id', [1, 2])->get();
            $complaintJsData = '';
            $complaintJsFinalData = '';
            $complaintJsSeriesData = '';

            foreach ($complaintStatusList as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->monthWiseComplaintStatusData($i, $status->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $complaintJsData = 'data : [' . $coma_data . ']';
                $js_source_data = '{
            name: "' . $status->name . '",
            ' . $complaintJsData . '
            },';
                $complaintJsFinalData .= $js_source_data;
            }
            $complaintJsSeriesData = 'series:[
            ' . $complaintJsFinalData . '
            ]';
            //ghsmodule  appointment month wise chart  data end

            //dcc module  appointment month wise chart  data start
            $tokenStatusList = serviceTokenStatus();
            $tokenJsData = '';
            $tokenJsFinalData = '';
            $tokenJsSeriesData = '';
            foreach ($tokenStatusList as $key => $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->statusWiseServiceToken($i, $key);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $tokenJsData = 'data : [' . $coma_data . ']';
                $js_source_data = '{
            name: "' . $status . '",
            ' . $tokenJsData . '
            },';
                $tokenJsFinalData .= $js_source_data;
            }
            $tokenJsSeriesData = 'series:[
            ' . $tokenJsFinalData . '
            ]';
            //dccmodule  appointment month wise chart  data end

            //mms  module  appointment month wise chart  data start
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $meetingStatusList = MstMeetingStatus::select('id', $name . ' ' . 'as name')->get();
            $meetingJsData = '';
            $meetingJsFinalData = '';
            $meetingJsSeriesData = '';

            foreach ($meetingStatusList as $meetingStatus) {
                $status = $meetingStatus->id;
                $statusName = $meetingStatus->name;
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->monthWiseMeeting($i, $status);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $meetingJsData = 'data : [' . $coma_data . ']';
                $js_source_data = '{
            name: "' . $statusName . '",
            ' . $meetingJsData . '
            },';
                $meetingJsFinalData .= $js_source_data;
            }
            $meetingJsSeriesData = 'series:[
            ' . $meetingJsFinalData . '
            ]';
            //mms module  appointment month wise chart  data end

            $monthNames = getLan() == 'np' ? $this->calendarRepository->nepaliMonthNames() : $this->calendarRepository->englishMonthNames();

            $totalComplaint = $this->dashboardRepository->getTotalComplaint();
            $totalSuggestion = $this->dashboardRepository->getTotalSuggestion();
            $totalIncident = $this->dashboardRepository->getTotalIncident();
            //jitsi live meeting details
            $jitsiLiveMeetingStream = $this->dashboardRepository->getJitsiLiveMeeting();

            //header notice details
            $notices = $this->dashboardRepository->getNoticeDetails();

            //get emergency contact details
            $emergencyContactInfo = $this->dashboardRepository->getEmergencyContact();
            $load_css = [
                'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css',
            ];

            $load_js = [
                'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.js',

            ];
            $script_js = "$(function(){
                    $(document).ready(function () {
                        $('.type-select').niceSelect();
                    });
               })";

            return view('frontend.home', compact(
                'totalComplaint',
                'totalSuggestion',
                'totalIncident',
                'appointmentJsSeriesData',
                'complaintJsSeriesData',
                'meetingJsSeriesData',
                'tokenJsSeriesData',
                'monthNames',
                'jitsiLiveMeetingStream',
                'notices',
                'emergencyContactInfo',
                'load_css',
                'load_js',
                'script_js',
            ));

        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }

    #check common token status
    public function checkTokenStatus(TokenStatusRequest $request)
    {
        try {
            $tokenInfo = '';
            if($request->type =='a')
            {
                $tokenInfo = Appointment::where('appointment_no', $request->token_no)->first();

            }elseif ($request->type =='c'){
                $tokenInfo = Complaint::where('complaint_no', $request->token_no)->first();
            }

            if ($tokenInfo) {
                if($request->type =='a')
                {
                    return AppointmentController::checkAppointmentTokenStatus($tokenInfo);
                }elseif ($request->type =='c')
                {
                    return GrievanceController::checkComplaintTokenStatus($tokenInfo);
                }
            } else {
                Session::flash('data_not_found', Lang::get('frontEndFlashMessage.ticket_not_found'));

                return redirect()->back();
            }
        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }
}
