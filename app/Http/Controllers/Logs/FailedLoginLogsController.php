<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\BaseController;
use App\Repositories\LogsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class FailedLoginLogsController extends BaseController
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
            $data['results'] = $this->logsRepository->getAllLoginFails($request);
            $data['totalLogs'] = $data['results']->total();
            $data['request'] = $request;
            $data['page_url'] = 'logs/failLoginLogs';
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
            $data['page_title'] = getLan() == 'np' ? 'लगइन Failed व्यवस्थापन' : 'Login Failed Logs Management';

            return view('backend.logs.failLogin', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('app.technicalError'));

            return back();
        }
    }

    public function ipUnblock($id)
    {
        try {
            $id = (int) $id;

            return $this->logsRepository->ipUnblock($id);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('app.technicalError'));

            return back();
        }
    }
}
