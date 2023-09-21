<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Meetings\MstMeetingStatus;
use App\Repositories\CalendarRepository;
use App\Repositories\FrontEnd\ChartRepository;
use App\Repositories\FrontEnd\DashboardRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class MMSController extends Controller
{
    private ChartRepository $chartRepository;

    private CalendarRepository $calendarRepository;

    private DashboardRepository $dashboardRepository;

    public function __construct(ChartRepository $chartRepository,
        CalendarRepository $calendarRepository,
        DashboardRepository $dashboardRepository)
    {
        $this->chartRepository = $chartRepository;
        $this->calendarRepository = $calendarRepository;
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index(Request $request)
    {

        try {

            $page_title = getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting Management';

            //mms  module  appointment month wise chart  data start
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
                    $res_total = $this->chartRepository->monthWiseMeeting($i, $status);
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

            //mms module  appointment month wise chart  data end

            $monthNames = getLan() == 'np' ? $this->calendarRepository->nepaliMonthNames() : $this->calendarRepository->englishMonthNames();
            // dd($monthNames);

            $latest_meetings = $this->dashboardRepository->getLatestMeetings();

            return view('frontend.innerPage.mmsInfo', compact(
                'page_title', 'monthNames', 'meetingJsSeriesData', 'latest_meetings'
            ));
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
