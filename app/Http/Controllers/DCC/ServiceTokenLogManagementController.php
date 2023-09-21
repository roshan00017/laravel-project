<?php

namespace App\Http\Controllers\DCC;

use App\Http\Controllers\BaseController;
use App\Models\TokenManagement\TokenLog;
use App\Repositories\DCC\TokenManagementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class ServiceTokenLogManagementController extends BaseController
{
    private TokenLog $serviceTokenLog;

    private TokenManagementRepository $tokenManagementRepository;

    public function __construct(TokenLog $serviceTokenLog, TokenManagementRepository $tokenManagementRepository)
    {
        parent::__construct();
        $this->serviceTokenLog = $serviceTokenLog;
        $this->tokenManagementRepository = $tokenManagementRepository;
    }

    public function index(Request $request)
    {

        try {
            $data['page_url'] = '/serviceTokeLogDetails';
            $data['page_route'] = 'serviceTokeLogDetails';
            $data['results'] = $this->tokenManagementRepository->getAllServiceRelatedTokenLog($request);
            $data['page_title'] = getLan() == 'np' ? 'सेवा टोकन लग विवरण' : 'Service Token Log History';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_search.js',
                'js/custom_app.min.js',

            ];

            $data['tokenManagementRepo'] = $this->tokenManagementRepository;

            return view('backend.dcc.tokenManagement.tokenLogList', $data);
        } catch (\Exception $e) {
            dd($e);

            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function show(Request $request, $token)
    {

        try {

            $data['page_url'] = '/serviceTokeLogDetails';
            $data['page_route'] = 'serviceTokeLogDetails';
            $data['results'] = $this->tokenManagementRepository->serviceTokenLogDetailsByToken($request, $token);
            $data['page_title'] = getLan() == 'np' ? 'सेवा टोकन लग विवरण' : 'Service Token Log History';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_search.js',
                'js/custom_app.min.js',

            ];

            return view('backend.dcc.tokenManagement.tokenDetails', $data);
        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
