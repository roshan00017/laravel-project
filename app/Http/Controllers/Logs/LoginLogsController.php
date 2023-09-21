<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\BaseController;
use App\Models\Logs\LoginLogs;
use App\Repositories\LogsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class LoginLogsController extends BaseController
{
    private LogsRepository $logsRepository;

    public function __construct(LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->logsRepository = $logsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data['clientLoginlogsInfo'] = LoginLogs::query()->where('client_id', '=', userInfo()->client_id)->count();
            $data['users'] = $this->logsRepository->userList();
            $data['results'] = $this->logsRepository->getAllLoginLog($request);
            $data['totalLogs'] = $data['results']->total();
            $data['request'] = $request;
            $data['page_url'] = 'logs/loginLogs';
            $data['load_css'] = [
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                'plugins/select2/css/select2.min.css',

            ];
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_search.js',
                'js/custom_app.min.js',
                'js/location.min.js',

            ];
            $data['is_province_search'] = true;
            $data['is_district_search'] = true;
            $data['is_local_body_search'] = true;
            $data['is_ward_search'] = true;
            $data['is_school_search'] = true;
            $data['page_title'] = getLan() == 'np' ? 'लगइन लग व्यवस्थापन' : 'Login Logs Management';

            return view('backend.logs.login', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('app.technicalError'));

            return back();
        }
    }
}
