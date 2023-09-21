<?php

namespace App\Http\Controllers\MasterSearch;

use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\DcMedium;
use App\Models\BasicDetails\DcOffice;
use App\Models\BasicDetails\DcStatus;
use App\Models\BasicDetails\MstCountry;
use App\Models\BasicDetails\MstDepartment;
use App\Models\BasicDetails\MstDocumentType;
use App\Models\EDMIS\Employee;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\MasterSearchRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class MasterSearchController extends BaseController
{
    private int $fileHeight = 128;

    private int $fileWidth = 128;

    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    protected MasterSearchRepository $masterSearchRepository;

    private int $menuId = 46;

    public function __construct(

        LogsRepository $logsRepository,
        MasterSearchRepository $masterSearchRepository
    ) {
        parent::__construct();
        // set the model

        $this->logsRepository = $logsRepository;
        $this->masterSearchRepository = $masterSearchRepository;
    }

    public function index(Request $request)
    {
        try {

            $data['request'] = $request;
            $data['page_url'] = 'masterSearch';
            $data['advancesearch'] = getLan() == 'np' ? 'मास्टर खोज फिल्टर' : 'Master Search Filter';
            //chalani Kitab
            $data['darta_kitab'] = getLan() == 'np' ? 'दर्ता किताब' : 'Register Book';
            $data['dispatch_book'] = getLan() == 'np' ? 'चलानी किताब' : 'Dispatch Book';
            $data['document'] = getLan() == 'np' ? 'टिप्पणी ' : 'Document';

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['statusList'] = DcStatus::select('id', $name.' '.'as name');
            $data['letterSendingMediumList'] = DcMedium::select('id', $name.' '.'as name');
            // $dcDocument = getLan() == 'np' ? 'name_ne' : 'name';
            $data['documentTypes'] = MstDocumentType::select('id', $name.' '.'as name');
            $data['department'] = MstDepartment::pluck($name.' '.'as name', 'id');
            $data['country'] = MstCountry::select('id', $name.' '.'as name');
            $data['office'] = DcOffice::select('id', $name.' '.'as name');

            //dartaKitab
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['branch_list'] = MstDepartment::select('id', $name.' '.'as name');

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['country_list'] = MstCountry::select('id', $name.' '.'as name');

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['office_list'] = DcOffice::select('id', $name.' '.'as name');

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['letter_status_list'] = DcStatus::select('id', $name.' '.'as name');

            $name = getLan() == 'np' ? 'first_name_np' : 'first_name_en';
            $data['employee_list'] = Employee::select('id', $name.' '.'as name');

            $data['load_js'] = [

                'plugins/select2/js/select2.full.min.js',
                'js/toggle.js',
                'js/form.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/master_search.js',
                'js/custom_app.min.js',
                'js/dateConverter.js',

            ];
            $data['script_js'] = "$(function(){
                $('#contact_no').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                $('#contact_number').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
             })";
            $data['page_title'] = getLan() == 'np' ? 'मास्टर खोज' : 'Master Search';

            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
            ];

            if ($request->filter_module == 'chalaniKitab') {

                $data['results'] = $this->masterSearchRepository->getAllDispatchBookFilterData($request);
            }
            if ($request->filter_module == 'dartaKitab') {

                $data['results'] = $this->masterSearchRepository->getAllDartaKitabFilterData($request);
            }
            if ($request->filter_module == 'document') {

                $data['results'] = $this->masterSearchRepository->getAllDartaKitabFilterData($request);
            }

            return view('backend.edmis.masterSearch.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
