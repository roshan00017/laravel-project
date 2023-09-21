<?php

namespace App\Http\Controllers\EDMIS;

use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\MstDepartment;
use App\Models\Calendar\MstFiscalYear;
use App\Models\EDMIS\DcRegisterBook;
use App\Models\User;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\DartaKitabRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class RegisterBookController extends BaseController
{
    protected DcRegisterBook $model;

    protected CommonRepository $common;

    protected DartaKitabRepository $dartaKitabRepository;

    private int $menuId = 40;

    public function __construct(DcRegisterBook $model, DartaKitabRepository $dartaKitabRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->common = new CommonRepository($model);
        $this->dartaKitabRepository = $dartaKitabRepository;
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
            $data['page_url'] = 'registerReport';
            $data['results'] = $this->dartaKitabRepository->getAllDartaKitab($request);
            $data['page_title'] = getLan() == 'np' ? 'दर्ता किताब' : 'Register Book';
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
                'js/registerbook.js',
            ];

            return view('backend.edmis.report.registerBook.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
