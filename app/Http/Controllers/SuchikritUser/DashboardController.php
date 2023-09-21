<?php

namespace App\Http\Controllers\SuchikritUser;

use App\Http\Controllers\BaseController;
use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DashboardController extends BaseController
{
    private DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        // $this->middleware('auth');
        parent::__construct();
        $this->dashboardRepository = $dashboardRepository;
    }

    //
    public function index(Request $request)
    {
        try {
            $total_dispatch = $this->dashboardRepository->getTotalDispatch();
            $total_register = $this->dashboardRepository->getTotalRegisterBook();
            $total_document = $this->dashboardRepository->getTotalDcDocument();
            $total_appointment = $this->dashboardRepository->getTotalAppointment();
            $today_dispatch = $this->dashboardRepository->getTodayDispatch();
            $today_register = $this->dashboardRepository->getTodayRegister();
            $today_document = $this->dashboardRepository->getTodayDocument();
            $today_appointment = $this->dashboardRepository->getTodayAppointment();

            return view('suchikritUser.dashboard.dashboard', compact('total_dispatch',
                'total_register',
                'total_document',
                'total_appointment',
                'today_dispatch',
                'today_register',
                'today_document',
                'today_appointment'
            ));
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function profile(Request $request)
    {
        return view('suchikritUser.userProfile');
    }
}
