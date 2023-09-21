<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Repositories\CalendarRepository;
use App\Repositories\FrontEnd\ChartRepository;
use App\Repositories\FrontEnd\DashboardRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DCCController extends Controller
{
    private ChartRepository $chartRepository;

    private CalendarRepository $calendarRepository;

    private DashboardRepository $dashboardRepository;

    public function __construct(
        ChartRepository $chartRepository,
        CalendarRepository $calendarRepository,
        DashboardRepository $dashboardRepository
    ) {
        $this->chartRepository = $chartRepository;
        $this->calendarRepository = $calendarRepository;
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index(Request $request)
    {

        try {

            $page_title = getLan() == 'np' ? 'नागरिक बडापत्र' : 'Citizen Charter';
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
                $tokenJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$status.'",
            '.$tokenJsData.'
            },';
                $tokenJsFinalData .= $js_source_data;
            }
            $tokenJsSeriesData = 'series:[
            '.$tokenJsFinalData.'
            ]';
            $services = $this->dashboardRepository->getServices();
            $serviceDocumentRepo = $this->dashboardRepository;

            $monthNames = getLan() == 'np' ? $this->calendarRepository->nepaliMonthNames() : $this->calendarRepository->englishMonthNames();

            return view(
                'frontend.innerPage.dccInfo',
                compact(
                    'page_title',
                    'monthNames',
                    'tokenJsSeriesData',
                    'services',
                    'serviceDocumentRepo',
                )
            );
        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
