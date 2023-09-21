<?php

namespace App\Http\Controllers\EDMIS;

use App\Helpers\FileUploadLibraryHelper;
use App\Helpers\OfficeAutomationHelper;
use App\Helpers\TokenHelper;
use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\DcOffice;
use App\Models\BasicDetails\DcStatus;
use App\Models\BasicDetails\HrDesignation;
use App\Models\BasicDetails\MstCountry;
use App\Models\BasicDetails\MstDepartment;
use App\Models\BasicDetails\MstSetting;
use App\Models\Calendar\MstFiscalYear;
use App\Models\EDMIS\DcRegisterBook;
use App\Models\EDMIS\DcRegisterBookLog;
use App\Models\EDMIS\Employee;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\DartaKitabRepository;
use App\Repositories\LogsRepository;
use Exception;
use Hashids\Hashids;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DcRegisterBookController extends BaseController
{
    private CommonRepository $model;

    private LogsRepository $logsRepository;

    private DartaKitabRepository $dartaKitabRepository;

    private int $menuId = 35;

    public function __construct(
        DcRegisterBook $dcRegisterBook,
        \App\Models\User $childModel,
        LogsRepository $logsRepository,
        DartaKitabRepository $dartaKitabRepository,
    ) {
        parent::__construct();
        // set the model
        $this->model = new CommonRepository($dcRegisterBook);
        $this->childModel = new CommonRepository($childModel);
        $this->logsRepository = $logsRepository;
        $this->dartaKitabRepository = $dartaKitabRepository;
    }

    public function index(Request $request)
    {

        try {
            $data['fyList'] = MstFiscalYear::all();
            $data['page_url'] = 'dcRegisterBook';
            $data['page_route'] = 'dcRegisterBook';
            $data['page_title'] = getLan() == 'np' ? 'दर्ता किताब' : 'Register Book';
            $data['request'] = $request;
            $data['show_button'] = true;
            $data['create_menu'] = true;

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
            ];

            $data['results'] = $this->dartaKitabRepository->getAllDartaKitab($request);

            return view('backend.edmis.dcRegisterBook.index', $data);
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

    public function create(Request $request)
    {

        try {
            $data['page_title'] = getLan() == 'np' ? 'दर्ता किताब' : 'Register Book';
            $data['page_url'] = 'dcRegisterBook';
            $data['page_route'] = 'dcRegisterBook';
            $data['request'] = $request;

            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_app.min.js',
                'js/dartaKitabYear.js',
                'js/dateConverter.js',

            ];
            $data['script_js'] = "$(function(){
               $('#contact_number').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
               $('#office_contact_number').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
            })";
            $data['add_more_button'] = true;
            $data['index_page_url'] = 'dcRegisterBook';
            $data['office_crreate_page_url'] = 'basicDetails/offices';

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

            $data['autoCodeGen'] = $this->autoRegdNo();
            $mstSetting = MstSetting::query()->where(['client_id' => userInfo()->client_id, 'label_np' => 'AUTOCODE_EDIT'])->first();
            if (isset($mstSetting)) {

                $data['codGenMode'] = $mstSetting->value == 'no' ? 'readonly' : '';
            }

            return view('backend.edmis.dcRegisterBook.create', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {

            $data = $request->all();

            if (userInfo()->client_id != null) {
                $data['client_id'] = $request->client_id;
                $data['regd_by_id'] = userInfo()->id;
            } else {
                $data['client_id'] = userInfo()->client_id;
                $data['regd_by_id'] = userInfo()->id;
                $data['ward_no'] = userInfo()->ward_no;
            }
            $data['fiscal_year_id'] = currentFy()->id;
            if (! empty($request->file('letter_upload'))) {
                $data['letter_upload'] = FileUploadLibraryHelper::setFileUploadName($request->letter_upload, $request->letter_no);
                $imageSuccess = true;
            }

            DB::beginTransaction();
            $data['register_month_code'] = (int) explode('-', $request->regd_date_bs)[1];

            $create = $this->model->create($data);

            if ($create) {
                //set image path
                if (isset($imageSuccess)) {
                    FileUploadLibraryHelper::setFileUploadPath($request->letter_upload, $data['letter_upload'], DcRegisterBook::FILE_PATH);
                }
                session()->flash('success', Lang::get('message.flash_messages.insertMessage'));
            }

            //token log generator
            //find letter status
            $letterStatus = DcStatus::query()->where('id', $request->letter_status)->first();

            TokenHelper::storeToken('edmis', 'register_book', $letterStatus->name_np, $letterStatus->name_en, $letterStatus->id, $create->regd_no);

            //add dispatch status
            OfficeAutomationHelper::storeDcRegisterBookStatusLog($create->id, $letterStatus->id);
            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 35);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));
            if ($request->addMore == true) {
                return back();
            }

            return redirect(url('dcRegisterBook'));
        } catch (\Exception $e) {

            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $value = $this->model->find($id);

            if ($value) {
                if ($value->image != null) {
                    FileUploadLibraryHelper::deleteExistingFile($value->file_upload, DcRegisterBook::FILE_PATH);
                }
                if (! empty($request->file('letter_upload'))) {
                    $data['letter_upload'] = FileUploadLibraryHelper::setFileUploadName($request->letter_upload, $request->letter_no);
                    $imageSuccess = true;
                }

                $data = $request->all();
                $data['updated_by'] = userInfo()->id;
                $this->model->update($data, $id);

                if (isset($imageSuccess)) {
                    FileUploadLibraryHelper::setFileUploadPath($request->letter_upload, $data['letter_upload'], DcRegisterBook::FILE_PATH);
                }
                //find by status id
                $statusInfo = DcRegisterBookLog::query()->where(['dc_regd_book_id' => $value->id, 'status_id' => $request->letter_status])->first();
                //add dispatch status
                if (is_null($statusInfo)) {

                    OfficeAutomationHelper::storeDcRegisterBookStatusLog($value->id, $request->letter_status);
                }
                // insert log
                $this->logsRepository
                    ->insertLog($value->id, $this->menuId, 35);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return redirect(url('dcRegisterBook'));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect(url('dcRegisterBook'));
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = DcRegisterBook::query()->find($hashIdValue[0]);
                $data['index_page_url'] = 'dcRegisterBook';

                $data['page_title'] = getLan() == 'np' ? 'दर्ता किताब' : 'Register Book';
                $data['page_url'] = 'dcRegisterBook';
                $data['page_route'] = 'dcRegisterBook';
                $data['office_crreate_page_url'] = 'basicDetails/offices';
                $data['request'] = $request;

                $data['load_css'] = [
                    'plugins/select2/css/select2.css',
                    'plugins/datepicker/english/english-datepicker.css',
                    'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

                ];

                $data['load_js'] = [
                    'plugins/select2/js/select2.full.min.js',
                    'plugins/select2/js/select2.full.min.js',
                    'plugins/input-mask/jquery/inputmask.min.js',
                    'plugins/input-mask/jquery/date_extension.min.js',
                    'plugins/datepicker/english/english-datepicker.min.js',
                    'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                    'js/custom_app.min.js',
                    'js/dartaKitabEdit.js',
                    

                ];
                $data['script_js'] = "$(function(){
                   $('#contact_number').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                   $('#office_contact_number').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                })";
                $data['cancel_button'] = true;

                $name = getLan() == 'np' ? 'first_name_np' : 'first_name_en';
                $data['employee_list'] = Employee::select('id', $name.' '.'as name');

                $name = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['branch_list'] = MstDepartment::select('id', $name.' '.'as name');

                $name = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['country_list'] = MstCountry::select('id', $name.' '.'as name');

                $name = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['office_list'] = DcOffice::select('id', $name.' '.'as name');

                $name = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['letter_status_list'] = DcStatus::select('id', $name.' '.'as name');
                $data['autoCodeGen'] = $this->autoRegdNo();
                $mstSetting = MstSetting::query()->where(['client_id' => userInfo()->client_id, 'label_np' => 'AUTOCODE_EDIT'])->first();
                if (isset($mstSetting)) {

                    $data['codGenMode'] = $mstSetting->value == 'no' ? 'readonly' : '';
                } else {
                    $data['codGenMode'] = '';
                }
                $data['filePath'] = DcRegisterBook::FILE_PATH;

                return view('backend.edmis.dcRegisterBook.edit', $data);
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcRegisterBook');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function show($id)
    {
        try {

            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $value = DcRegisterBook::query()->find($hashIdValue[0]);
                // Assuming you have a User model and a users table in your database
                $data['dcRegisterBook'] = DcRegisterBook::find($value->id);
                $data['filePath'] = DcRegisterBook::FILE_PATH;

                if ($data) {

                    $data['page_title'] = getLan() == 'np' ? 'दर्ता किताब' : 'Register Book';
                    $data['page_url'] = 'dcRegisterBook';
                    $data['page_route'] = 'dcRegisterBook';
                    $data['cancel_button'] = true;
                    $data['index_page_url'] = 'dcRegisterBook';
                    // User found, display the details

                    return view('backend.edmis.dcRegisterBook.show', $data);
                }
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcRegisterBook');
            }
        } catch (\Exception $e) {
            // dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function destroy(int $id)
    {
        try {

            $value = $this->model->find($id);
            if ($value) {
                //child table data delete
                DcRegisterBookLog::query()->where('dc_regd_book_id', $value->id)->delete();
                //delete existing image
                if ($value->letter_upload != null) {
                    FileUploadLibraryHelper::deleteExistingFile($value->letter_upload, DcRegisterBook::FILE_PATH);
                }
                DB::beginTransaction();
                $this->model->delete($id);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 35);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.deleteMessage'));

                return back();
            } else {
                session()->flash('warning', Lang::get('message.flash_messages.warningMessage'));
            }
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function autoRegdNo()
    {
        try {
            $auto_code = MstSetting::query()->where([['client_id', userInfo()->client_id], ['label_np', 'AUTOCODE']])->select('value')->first();
            if ($auto_code != null) {
                if (systemAdmin() == false && $auto_code->value == 'yes') {
                    if (userInfo()->client_id != null && is_null(userInfo()->ward_no)) {
                        $query = DcRegisterBook::query()
                            ->where([
                                'fiscal_year_id' => Session::get('fiscal_year_id'), 'client_id' => userInfo()->client_id,
                            ])
                            ->select('regd_no')
                            ->latest()
                            ->orderBy('id', 'desc')
                            ->limit(1)
                            ->get();

                        //set code format
                        $codeFormat = '0'.'-'.userInfo()->branch_id;
                        $code = $query ? (int) isset($query[0]->regd_no) + 1 : 1;

                        return ['autoCode' => $code, 'codeFormat' => $codeFormat];
                    } else {

                        $query = DcRegisterBook::query()
                            ->where([
                                'fiscal_year_id' => Session::get('fiscal_year_id'), 'client_id' => userInfo()->client_id,
                                'ward_no' => userInfo()->ward_no,
                            ])
                            ->select('regd_no')
                            ->latest()
                            ->orderBy('id', 'desc')
                            ->limit(1)
                            ->get();

                        //set code format
                        $codeFormat = userInfo()->branch_id.'-'.userInfo()->branch_id;
                        $code = $query ? (int) $query[0]->regd_no + 1 : 1;

                        return ['autoCode' => $code, 'codeFormat' => $codeFormat];
                    }
                }
            }
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
