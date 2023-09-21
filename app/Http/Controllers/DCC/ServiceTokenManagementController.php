<?php

namespace App\Http\Controllers\DCC;

use App\Http\Controllers\BaseController;
use App\Models\TokenManagement\Token;
use App\Repositories\DCC\TokenManagementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class ServiceTokenManagementController extends BaseController
{
    private Token $token;

    private TokenManagementRepository $tokenManagementRepository;

    public function __construct(Token $token, TokenManagementRepository $tokenManagementRepository)
    {
        parent::__construct();
        $this->token = $token;
        $this->tokenManagementRepository = $tokenManagementRepository;
    }

    public function index(Request $request)
    {

        try {
            $data['page_url'] = '/serviceTokenList';
            $data['page_route'] = 'serviceTokenList';
            $data['results'] = $this->tokenManagementRepository->getAllServiceRelatedToken($request);
            $data['page_title'] = getLan() == 'np' ? 'सेवा टोकन सूची' : 'Service Token List';
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

            return view('backend.dcc.tokenManagement.tokenList', $data);
        } catch (\Exception $e) {
            //check for encryption format to decryption
            if ($e->getMessage() == 'The payload is invalid.') {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return back();
            }
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
