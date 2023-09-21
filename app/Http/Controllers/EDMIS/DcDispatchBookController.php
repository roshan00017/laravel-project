<?php

namespace App\Http\Controllers\EDMIS;

use App\Helpers\FileUploadLibraryHelper;
use App\Helpers\OfficeAutomationHelper;
use App\Helpers\TokenHelper;
use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\DcMedium;
use App\Models\BasicDetails\DcOffice;
use App\Models\BasicDetails\DcStatus;
use App\Models\BasicDetails\MstCountry;
use App\Models\BasicDetails\MstDepartment;
use App\Models\BasicDetails\MstDocumentType;
use App\Models\BasicDetails\MstSetting;
use App\Models\EDMIS\DcDispatchBook;
use App\Models\EDMIS\DcDispatchBookStatusLog;
use App\Models\User;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\DispatchRepository;
use App\Repositories\LogsRepository;
use Exception;
use Hashids\Hashids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class DcDispatchBookController extends BaseController
{
    protected CommonRepository $model;

    protected CommonRepository $childModel;

    protected LogsRepository $logsRepository;

    protected DispatchRepository $dispatchRepository;

    private int $menuId = 25;

    public function __construct(
        DcDispatchBook $DcDispatchBook,
        User $childModel,
        LogsRepository $logsRepository,
        DispatchRepository $dispatchRepository,
    ) {
        parent::__construct();
        // set the model
        $this->model = new CommonRepository($DcDispatchBook);
        $this->childModel = new CommonRepository($childModel);
        $this->logsRepository = $logsRepository;
        $this->dispatchRepository = $dispatchRepository;
    }

    public function index(Request $request)
    {

        try {
            $data['page_url'] = 'dcDispatchBook';
            $data['create_url'] = 'dcDispatchBook';
            $data['page_route'] = 'dcDispatchBook';

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
                'plugins/select2/js/select2.full.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_app.min.js',
                'js/custom_search.js',

            ];
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['results'] = $this->dispatchRepository->getAllDispatchBook($request);
            $data['show_button'] = true;
            $data['create_menu'] = true;
            $data['page_title'] = getLan() == 'np' ? 'चलानी किताब' : 'Dispatch Book';
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['statusList'] = DcStatus::select('id', $name.' '.'as name');
            $data['request'] = $request;
            // $data['field_name']= MstDepartment::where('id', $data->from_branch_id)->value($name);

            return view('backend.edmis.dcDispatchBook.index', $data);
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

    public function create()
    {
        try {
            $data['page_url'] = 'dcDispatchBook';
            $data['prev_page_url'] = 'dcDispatchBook';
            $data['page_route'] = 'dcDispatchBook';
            $data['index_page_url'] = 'dcDispatchBook';
            $data['cancel_button'] = true;
            $data['add_more_button'] = true;

            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                'plugins/datepicker/english/english-datepicker.css',

            ];

            $data['load_js'] = [
                'js/toggle.js',
                'js/form.js',
                'js/custom_app.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/dcDispatch.js',
                'js/dateConverter.js',
            ];
            $data['script_js'] = "$(function(){
                $('#contact_no').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                $('#to_office_contact').inputmask('9999999999', { placeholder: '98xxxxxxxx' });

            })";

            $data['office_crreate_page_url'] = 'basicDetails/offices';
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['statusList'] = DcStatus::select('id', $name.' '.'as name');
            $data['letterSendingMediumList'] = DcMedium::select('id', $name.' '.'as name');
            // $dcDocument = getLan() == 'np' ? 'name_ne' : 'name';
            $data['documentTypes'] = MstDocumentType::select('id', $name.' '.'as name');
            $data['department'] = MstDepartment::select('id', $name.' '.'as name');
            $data['page_title'] = getLan() == 'np' ? 'चलानी किताब ' : 'Dispatch Book';
            $data['country'] = MstCountry::select('id', $name.' '.'as name');
            $data['office'] = DcOffice::select('id', $name.' '.'as name');
            $data['autoCodeGen'] = $this->autoRegdNo();
            $mstSetting = MstSetting::query()->where(['client_id' => userInfo()->client_id, 'label_np' => 'AUTOCODE_EDIT'])->first();
            if (isset($mstSetting)) {

                $data['codGenMode'] = $mstSetting->value == 'no' ? 'readonly' : '';
            } else {
                $data['codGenMode'] = '';
            }

            return view('backend.edmis.dcDispatchBook.create', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

        $data['country'] = MstCountry::select('id', $name.' '.'as name');
        $data['office'] = DcOffice::select('id', $name.' '.'as name');
        $data['office'] = DcOffice::select('id', $name.' '.'as name');

        return view('backend.edmis.dcDispatchBook.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        try {

            //File validation

            $request->validate([
                'letter_upload' => 'nullable|mimes:jpeg,jpg,png,pdf|max:1024', // Maximum file size is 1MB (1024 KB)
            ]);
            $data = $request->all();

            if (! empty($request->file('letter_upload'))) {

                $data['letter_upload'] = FileUploadLibraryHelper::setFileUploadName($request->letter_upload, $request->letter_no);

                $imageSuccess = true;
            }
            if (userInfo()->client_id != null) {
                $data['client_id'] = $request->client_id;
                $data['regd_by_id'] = userInfo()->id;
            } else {
                $data['client_id'] = userInfo()->client_id;
                $data['regd_by_id'] = userInfo()->id;
                $data['ward_no'] = userInfo()->ward_no;
            }
            $data['fiscal_year_id'] = currentFy()->id;
            $data['created_by'] = auth()->user()->id;
            $data['dispatch_month_code'] = (int) explode('-', $request->dispatch_date_bs)[1];
            DB::beginTransaction();

            $create = $this->model->create($data);

            if ($create) {
                //set image path
                if (isset($imageSuccess)) {
                    FileUploadLibraryHelper::setFileUploadPath($request->letter_upload, $data['letter_upload'], DcDispatchBook::FILE_PATH);
                }
                session()->flash('success', Lang::get('message.flash_messages.insertMessage'));
            }
            //token log generator
            //find letter status
            $letterStatus = DcStatus::query()->where('id', $request->letter_status)->first();

            TokenHelper::storeToken('edmis', 'dispatch_book', $letterStatus->name_np, $letterStatus->name_en, $letterStatus->id, $create->regd_no);

            //add dispatch status
            OfficeAutomationHelper::storeDcDispatchBookStatusLog($create->id, $letterStatus->id);

            // Insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 25);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            if ($request->addMore == true) {
                return back();
            }

            return redirect(url('dcDispatchBook'));
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $value = $this->model->find($id);

            if ($value) {
                if ($value->image != null) {
                    FileUploadLibraryHelper::deleteExistingFile($value->file_upload, DcDispatchBook::FILE_PATH);
                }
                $data = $request->all();

                if (! empty($request->file('letter_upload'))) {
                    $data['letter_upload'] = FileUploadLibraryHelper::setFileUploadName($request->letter_upload, $request->letter_no);
                    $imageSuccess = true;
                }

                $data['updated_by'] = userInfo()->id;
                DB::beginTransaction();

                $this->model->update($data, $id);

                if (isset($imageSuccess)) {
                    FileUploadLibraryHelper::setFileUploadPath($request->letter_upload, $data['letter_upload'], DcDispatchBook::FILE_PATH);
                }
                //find by status id
                $statusInfo = DcDispatchBookStatusLog::query()->where(['dc_dispatch_book_id' => $value->id, 'status_id' => $request->letter_status])->first();
                //add dispatch status
                if (is_null($statusInfo)) {

                    OfficeAutomationHelper::storeDcDispatchBookStatusLog($value->id, $request->letter_status);
                }
                // insert log
                $this->logsRepository
                    ->insertLog($value->id, $this->menuId, 35);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return redirect(url('dcDispatchBook'));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect(url('dcDispatchBook'));
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $data['page_title'] = 'DispatchBook';
            $data['prev_page_url'] = 'dcDispatchBook';
            $data['page_route'] = 'dcDispatchBook';
            $data['letterArray'] = [
                '0-1' => 'Option 0-1',
                '0-2' => 'Option 0-2',
            ];
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = DcDispatchBook::query()->find($hashIdValue[0]);
                $data['page_title'] = getLan() == 'np' ? 'चलानी किताब' : 'Dispatch Book';
                $data['page_url'] = 'dcDispatchBook';
                $data['page_route'] = 'dcDispatchBook';
                $data['request'] = $request;
                $data['load_js'] = [
                    'js/toggle.js',
                    'js/form.js',
                    'plugins/select2/js/select2.full.min.js',
                    'plugins/select2/js/select2.full.min.js',
                    'plugins/select2/js/select2.full.min.js',
                    'plugins/input-mask/jquery/inputmask.min.js',
                    'plugins/input-mask/jquery/date_extension.min.js',
                    'plugins/datepicker/english/english-datepicker.min.js',
                    'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                    'js/custom_app.min.js',
                    'js/dcDispatch.js',
                    'js/dateConverter.js',

                ];
                $data['show_button'] = true;
                $data['cancel_button'] = true;
                $data['index_page_url'] = 'dcDispatchBook';
                $data['script_js'] = "$(function(){
                    $('#contact_no').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                     $('#to_office_contact').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                })";
                $data['load_css'] = [
                    'plugins/select2/css/select2.css',
                    'plugins/datepicker/english/english-datepicker.css',
                    'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                ];
                $name = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['statusList'] = DcStatus::select('id', $name.' '.'as name');
                // $dcDocument = getLan() == 'np' ? 'name_ne' : 'name';
                $data['letterSendingMediumList'] = DcMedium::select('id', $name.' '.'as name');
                $dcDocument = getLan() == 'np' ? 'name_ne' : 'name';
                $data['documentTypes'] = MstDocumentType::select('id', $name.' '.'as name');
                $data['department'] = MstDepartment::select('id', $name.' '.'as name');
                $data['page_title'] = getLan() == 'np' ? 'चलानी किताब' : 'Dispatch Book';
                $data['country'] = MstCountry::select('id', $name.' '.'as name');
                $data['office'] = DcOffice::select('id', $name.' '.'as name');
                $data['filePath'] = DcDispatchBook::FILE_PATH;

                return view('backend.edmis.dcDispatchBook.edit', $data);
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcDispatchBook');
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
            $data['index_page_url'] = 'dcDispatchBook';
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['statusList'] = DcStatus::select('id', $name.' '.'as name');
            $data['letterSendingMediumList'] = DcMedium::select('id', $name.' '.'as name');
            $dcDocument = getLan() == 'np' ? 'name_ne' : 'name';
            $data['documentTypes'] = MstDocumentType::select('id', $name.' '.'as name');
            $data['department'] = MstDepartment::select('id', $name.' '.'as name');
            $data['country'] = MstCountry::select('id', $name.' '.'as name');
            $data['country'] = MstCountry::select('id', $name.' '.'as name');
            $data['office'] = DcOffice::select('id', $name.' '.'as name');
            if ($hashIdValue) {
                $value = DcDispatchBook::query()->find($hashIdValue[0]);
                // Assuming you have a User model and a users table in your database
                $data['dcDispatchBook'] = DcDispatchBook::find($value->id);
                if ($data) {

                    $data['page_title'] = getLan() == 'np' ? 'चलानी किताब ' : 'Dispatch Book';
                    $data['page_url'] = 'dcDispatchBook';
                    $data['page_route'] = 'dcDispatchBook';
                    // User found, display the details
                    $data['filePath'] = DcDispatchBook::FILE_PATH;

                    return view('backend.edmis.dcDispatchBook.show', $data);
                }
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcDispatchBook');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {

            $value = $this->model->find($id);

            if ($value) {
                //delete child table data delete
                DcDispatchBookStatusLog::query()->where('dc_dispatch_book_id', $value->id)->delete();
                //delete existing image
                if ($value->image != null) {
                    FileUploadLibraryHelper::deleteExistingFile($value->file_upload, DcDispatchBook::FILE_PATH);
                }
                DB::beginTransaction();
                $data['deleted_by'] = auth()->user()->id;
                $this->model->update($data, $id);
                $this->model->delete($id);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 18);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.deleteMessage'));
            } else {
                session()->flash('warning', Lang::get('message.flash_messages.warningMessage'));
            }

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function autoRegdNo()
    {

        try {
            $auto_code = MstSetting::query()->where([['client_id', userInfo()->client_id], ['label_np', 'AUTOCODE']])->select('value')->first();
            if (isset($auto_code)) {
                if (systemAdmin() == false && $auto_code->value == 'yes') {

                    if (userInfo()->client_id != null && is_null(userInfo()->ward_no)) {

                        $query = DcDispatchBook::query()
                            ->where([
                                'fiscal_year_id' => Session::get('fiscal_year_id'), 'client_id' => userInfo()->client_id,
                            ])
                            ->select('dispatch_no')
                            ->latest()
                            ->orderBy('id', 'desc')
                            ->limit(1)
                            ->get();

                        //set code format
                        $codeFormat = '0'.'-'.userInfo()->branch_id;
                        $code = $query ? (int) isset($query[0]->dispatch_no) + 1 : 1;

                        return ['autoCode' => $code, 'codeFormat' => $codeFormat];
                    } else {

                        $query = DcDispatchBook::query()
                            ->where([
                                'fiscal_year_id' => Session::get('fiscal_year_id'), 'client_id' => userInfo()->client_id,
                                'ward_no' => userInfo()->ward_no,
                            ])
                            ->select('dispatch_no')
                            ->latest()
                            ->orderBy('id', 'desc')
                            ->limit(1)
                            ->get();

                        //set code format
                        $codeFormat = userInfo()->branch_id.'-'.userInfo()->branch_id;
                        $code = $query ? (int) $query[0]->dispatch_no + 1 : 1;

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
