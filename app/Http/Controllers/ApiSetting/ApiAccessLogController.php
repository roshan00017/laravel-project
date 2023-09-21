<?php

namespace App\Http\Controllers\ApiSetting;

use App\Http\Controllers\BaseController;
use App\Models\ApiSetting\ApiKey;
use App\Repositories\LogsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class ApiAccessLogController extends BaseController
{
    protected $model;

    private LogsRepository $logsRepository;

    public function __construct(LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->logsRepository = $logsRepository;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        try {
            $data['page_url'] = 'apiAccessLogs';
            $data['page_route'] = 'apiAccessLogs';
            $data['load_css'] = [
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_search.min.js',
                'js/custom_app.min.js',

            ];
            $data['results'] = $this->logsRepository->getAllApiAccessLogs($request);
            $data['request'] = $request;
            $data['appName'] = ApiKey::all();
            $data['totalLogs'] = $data['results']->total();
            $data['page_title'] = getLan() == 'np' ? ' API  लग व्यवस्थापन' : 'Api Access Logs';

            return view('backend.apiSetting.apiAccessLogs', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
