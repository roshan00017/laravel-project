<?php

namespace App\Http\Controllers\EDMIS;

use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\MstDepartment;
use App\Models\Calendar\MstFiscalYear;
use App\Models\EDMIS\DcDocument;
use App\Models\User;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\PatraStatusRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class PatraConditionController extends BaseController
{
    protected DcDocument $model;

    protected CommonRepository $common;

    protected PatraStatusRepository $patraStatusRepository;

    private int $menuId = 41;

    public function __construct(DcDocument $model, PatraStatusRepository $patraStatusRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->common = new CommonRepository($model);
        $this->patraStatusRepository = $patraStatusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $data['fyList'] = MstFiscalYear::all();
            $user_name = getLan() == 'np' ? 'full_name_np' : 'full_name';
            $data['userList'] = User::select('id', $user_name.' '.'as name');
            $department_name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['departmentList'] = MstDepartment::select('id', $department_name.' '.'as name');
            $data['page_url'] = 'patraReport';
            $data['results'] = $this->patraStatusRepository->gatAllDocumentStatus($request);
            $data['page_title'] = getLan() == 'np' ? 'पत्रको स्थिति' : 'Letter Status';
            $data['request'] = $request;

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
                'js/custom_app.min.js',
                'js/custom_search.js',
                'js/patratblData.js',
            ];

            return view('backend.edmis.report.patra.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
