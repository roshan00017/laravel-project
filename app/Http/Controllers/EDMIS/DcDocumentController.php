<?php

namespace App\Http\Controllers\EDMIS;

use App\Helpers\FileUploadLibraryHelper;
use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\DcOffice;
use App\Models\BasicDetails\DcStatus;
use App\Models\BasicDetails\HrDesignation;
use App\Models\BasicDetails\MstCountry;
use App\Models\BasicDetails\MstDepartment;
use App\Models\Calendar\MstFiscalYear;
use App\Models\EDMIS\DcDocument;
use App\Models\EDMIS\DcRegisterBook;
use App\Models\EDMIS\Employee;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\DartaKitabRepository;
use App\Repositories\EDMIS\DcDocumentRepository;
use App\Repositories\LogsRepository;
use Hashids\Hashids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DcDocumentController extends BaseController
{
    protected CommonRepository $model;

    protected CommonRepository $childModel;

    protected LogsRepository $logsRepository;

    private DcDocumentRepository $dcDocumentRepo;

    private DartaKitabRepository $dartaKitabRepository;

    private int $menuId = 30;

    public function __construct(
        DcDocument $dcDocument,
        \App\Models\User $childModel,
        LogsRepository $logsRepository,
        DcDocumentRepository $dcDocumentRepo,
        DartaKitabRepository $dartaKitabRepository,
    ) {
        parent::__construct();
        // set the model
        $this->model = new CommonRepository($dcDocument);
        $this->childModel = new CommonRepository($childModel);
        $this->logsRepository = $logsRepository;
        $this->dcDocumentRepo = $dcDocumentRepo;
        $this->dartaKitabRepository = $dartaKitabRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['fyList'] = MstFiscalYear::all();
            $data['page_url'] = 'dcDocument';
            $data['page_route'] = 'dcDocument';
            $data['page_title'] = getLan() == 'np' ? 'टिप्पणी ' : 'Document';
            $data['request'] = $request;
            $data['show_button'] = true;
            $data['results'] = $this->dartaKitabRepository->getAllDartaKitab($request);
            $data['regd'] = DcRegisterBook::all();
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
                'js/custom_app.min.js',
                'js/custom_search.js',
                'js/dcDocumet.js',
                'js/dateConverter.js',
            ];

            return view('backend.edmis.dcDocument.index', $data);
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

    public function show($id, Request $request)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);

            if ($hashIdValue) {
                $value = DcRegisterBook::query()->find($hashIdValue[0]);
                // Assuming you have a User model and a users table in your database
                $data['dcRegisterBook'] = DcRegisterBook::find($value->id);
                $data['results'] = $this->dartaKitabRepository->getAllDocumentByRegNo($request, $value->regd_no);
                $data['filePath'] = DcRegisterBook::FILE_PATH;

                // dd($data['filePath']);
                if ($data) {
                    $data['page_title'] = getLan() == 'np' ? 'टिप्पणी' : 'Document';
                    $data['page_url'] = 'dcDocument';
                    $data['page_route'] = 'dcDocument';
                    $data['index_page_url'] = 'dcDocument';

                    $name = getLan() == 'np' ? 'name_np' : 'name_en';
                    $data['branch_list'] = MstDepartment::select('id', $name.' '.'as name');

                    $name = getLan() == 'np' ? 'name_np' : 'name_en';
                    $data['employee_list'] = HrDesignation::select('id', $name.' '.'as name');

                    $name = getLan() == 'np' ? 'name_np' : 'name_en';
                    $data['country_list'] = MstCountry::select('id', $name.' '.'as name');

                    $name = getLan() == 'np' ? 'name_np' : 'name_en';
                    $data['office_list'] = DcOffice::select('id', $name.' '.'as name');

                    $name = getLan() == 'np' ? 'name_np' : 'name_en';
                    $data['letter_status_list'] = DcStatus::select('id', $name.' '.'as name');

                    $name = getLan() == 'np' ? 'first_name_np' : 'first_name_en';
                    $data['employee_list'] = Employee::select('id', $name.' '.'as name');
                    // $data['close'] = 'dcDocument/{$hashIdValue}';

                    $data['load_css'] = [
                        'plugins/select2/css/select2.css',
                    ];
                    $data['load_js'] = [
                        'plugins/select2/js/select2.full.min.js',
                        'js/tipaniFile.js',
                    ];
                    // User found, display the details
                    return view('backend.edmis.dcDocument.show', $data);
                }
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcDocument');
            }
        } catch (\Exception $e) {
            // dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();
            // dd($data);
            $data['fiscal_year_id'] = currentFy()->id;
            $data['client_id'] = setClientId($request);
            $data['added_by'] = userInfo()->id;

            if (! empty($request->file('soms_doc'))) {
                $filePaths = [];
                foreach ($request->file('soms_doc') as $file) {
                    $filePath = FileUploadLibraryHelper::setFileUploadName($file, userInfo()->id);
                    $filePaths[] = $filePath;
                    FileUploadLibraryHelper::setFileUploadPath($file, $filePath, DcDocument::FILE_PATH);
                }
                $data['filepath'] = json_encode($filePaths); // Store file paths as JSON string
            }

            DB::beginTransaction();
            $create = $this->model->create($data);
            if ($create) {
                //set image path
                if (isset($imageSuccess)) {
                    FileUploadLibraryHelper::setFileUploadPath($request->filepath, $data['filepath'], DcDocument::FILE_PATH);
                }
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.insertMessage'));
            } else {
                DB::rollBack();
                session()->flash('error', Lang::get('message.flash_messages.errorMessage'));
            }
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function showDetial($id, Request $request)
    {
        try {

            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);

            if ($hashIdValue) {
                // dd($hashIdValue[0]);
                $value = DcDocument::query()->find($hashIdValue[0]);
                // dd($value->document_no);
                // Assuming you have a User model and a users table in your database
                $data['result'] = DcDocument::find($value->id);
                $data['dcRegisterBook'] = DcRegisterBook::where('regd_no', $value->document_no)->first();

                // dd($data['filePath']);
                if ($data) {
                    $data['page_title'] = getLan() == 'np' ? 'टिप्पणी' : 'Document';
                    $data['page_url'] = 'dcDocument';
                    $data['page_route'] = 'dcDocument';
                    $data['index_page_url'] = 'dcDocument';
                    $data['filePath'] = DcDocument::FILE_PATH;

                    $data['load_css'] = [
                        'plugins/select2/css/select2.css',
                    ];
                    $data['load_js'] = [
                        'plugins/select2/js/select2.full.min.js',
                        'js/tipaniFile.js',
                    ];
                    // dd($data);
                    // User found, display the details
                    return view('backend.edmis.dcDocument.showDetail', $data);
                }
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return back();
            }
            // return view('backend.edmis.dcDocument.showDetail');
        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
