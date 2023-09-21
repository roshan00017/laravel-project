<?php

namespace App\Http\Controllers\Grevience;

use App\Events\ComplaintMailEvent;
use App\Facades\NepaliDate;
use App\Helpers\DateConverter;
use App\Helpers\TokenHelper;
use App\Http\Controllers\BaseController;
use App\Models\Appointment\Appointment;
use App\Models\BasicDetails\ComplaintSource;
use App\Models\BasicDetails\FormCategory;
use App\Models\BasicDetails\MstCountry;
use App\Models\BasicDetails\MstGender;
use App\Models\BasicDetails\MstOffice;
use App\Models\BasicDetails\SeverityType;
use App\Models\ComplaintProgressInfo;
use App\Models\Grevience\Complaint;
use App\Models\Grevience\Notification;
use App\Models\Models\Grevience\ComplaintStatus;
use App\Repositories\CommonRepository;
use App\Repositories\Grievance\ComplaintRepository;
use App\Repositories\LogsRepository;
use Carbon\Carbon;
use Exception;
use Hashids\Hashids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PDF;

class ComplaintController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    protected ComplaintRepository $complaintRepository;

    private int $menuId = 43;

    public function __construct(Complaint $complaint, LogsRepository $logsRepository, ComplaintRepository $complaintRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($complaint);
        $this->logsRepository = $logsRepository;
        $this->complaintRepository = $complaintRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['countryList'] = MstCountry::all();
            $complaintSource = getLan() == 'np' ? 'name_ne' : 'name';
            $data['complaintSourceList'] = ComplaintSource::select('id', $complaintSource.' '.'as name');
            $complaintType = getLan() == 'np' ? 'name_ne' : 'name';
            $data['complaintTypeList'] = FormCategory::select('id', $complaintType.' '.'as name');

            $gender = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['gender_id'] = MstGender::select('id', $gender.' '.'as name_en');

            $severityType = getLan() == 'np' ? 'name_ne' : 'name';
            $data['complaintSeverityList'] = SeverityType::select('id', $severityType.' '.'as name');

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['office_id'] = MstOffice::select('id', $name.' '.'as name');
            $gender = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['gender_id'] = MstGender::select('id', $gender.' '.'as name_en');

            $gender = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['gender_id'] = MstGender::select('id', $gender.' '.'as name_en');

            $data['page_url'] = 'complaints';
            $data['page_route'] = 'complaints';
            $data['show_button'] = true;
            $data['results'] = $this->complaintRepository->getAllComplaints($request);
            $data['complaintRepo'] = $this->complaintRepository;

            $data['page_title'] = getLan() == 'np' ? 'गुनासो' : 'Complaints';
            $data['request'] = $request;
            $data['create_menu'] = true;

            $data['delete_button'] = true;
            $data['custom_print'] = true;

            if (@$_GET['pdf'] == 't') {
                // dd('pdf',$_GET);
                $pdf = PDF::loadView('backend.grevience.complaints.pdflist', $data);

                return $pdf->inline('list.pdf');
            }

            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

            ];
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/custom_search.min.js',
                'js/complaint/complaint.js',
            ];

            return view('backend.grevience.complaints.index', $data);
        } catch (\Exception $e) {
            //check for encryption format to decryption
            if ($e->getMessage() == 'The payload is invalid.') {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return back();
            }
            Session::flash('server_error', Lang::get('message.commons. '));

            return back();
        }
    }

    public function create()
    {

        try {

            $data['page_url'] = 'complaints';
            $data['page_route'] = 'complaints';
            $data['page_title'] = getLan() == 'np' ? 'गुनासो' : 'Complaints';

            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

            ];
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/complaint/complaint.js',
                'js/localBodyHierarchy.js',
                'js/dateConverter.js',
            ];

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['countryList'] = MstCountry::select('id', $name.' '.'as name');
            $data['genderList'] = MstGender::select('id', $name.' '.'as name');
            $complaint = getLan() == 'np' ? 'name_ne' : 'name';
            $data['complaintSourceList'] = ComplaintSource::select('id', $complaint.' '.'as name');
            $data['complaintTypeList'] = FormCategory::select('id', $complaint.' '.'as name');

            $gender = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['gender_id'] = MstGender::select('id', $gender.' '.'as name_en');

            $severityType = getLan() == 'np' ? 'name_ne' : 'name';
            $data['complaintSeverityList'] = SeverityType::select('id', $severityType.' '.'as name');

            $name = getLan() == 'np' ? 'name_ne' : 'name';
            $data['office_id'] = MstOffice::select('id', $name.' '.'as name');
            $data['save_button'] = true;
            $data['add_more_button'] = true;
            $data['cancel_button'] = true;
            $data['index_page_url'] = 'complaints';
            $data['provinces'] = DropDownController::getProvinceList();
            $data['districts'] = DropDownController::getAllDistricts();
            $data['vdcmun'] = DropDownController::getAllVdcMun();

            return view('backend.grevience.complaints.create', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request)
    {
        try {
            request()->validate([
                'form_category_id' => 'required',
                'description' => 'required',
                'complaint_source_id' => 'required',
                'severity_type_id' => 'required',
            ]);
            $data = $request->all();
            $data['email'] = Str::lower($request->email);

            $data['created_by'] = userInfo()->id;
            $data['client_id'] = setClientId($request);
            $data['complaint_date_en'] = Carbon::now()->toDateString();
            $data['complaint_date_np'] = NepaliDate::create(Carbon::now())->toBS();
            $data['complaint_no'] = $this->generateUniqueNumber();
            $data['status'] = 2;
            $mailData = [
                'name' => $data['name_ne'],
                'complaint_no' => $data['complaint_no'],
                'email' => $data['email'],
            ];

            if (! empty($data['email'])) {
                ComplaintMailEvent::dispatch($mailData);
            }
            $data['complaint_month_code'] = (int) explode('-', $data['complaint_date_np'])[1];

            DB::beginTransaction();
            $create = $this->model->create($data);
            // store master token
            TokenHelper::storeToken('GHS', getLan() == 'np' ? 'गुनासो' : 'Complaints', 'हेर्न बाँकि', 'NOT SEEN', 1, $data['complaint_no']);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));
            if ($request->addMore == true) {
                return back();
            }

            return redirect(url('complaints'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $value = $this->model->find($id);

            if ($value) {
                DB::beginTransaction();
                $data['deleted_by'] = auth()->user()->id;
                $this->model->update($data, $id);
                $this->model->delete($id);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 4);
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

    public function edit(Request $request, $id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = Complaint::query()->find($hashIdValue[0]);
                $data['page_title'] = getLan() == 'np' ? 'गुनासो' : 'Complaints';
                $data['page_url'] = 'complaints';
                $data['page_route'] = 'complaints';
                $data['request'] = $request;
                $data['load_css'] = [
                    'plugins/select2/css/select2.css',
                    'plugins/datepicker/english/english-datepicker.css',
                    'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

                ];
                $data['load_js'] = [

                    'plugins/input-mask/jquery/inputmask.min.js',
                    'plugins/input-mask/jquery/date_extension.min.js',
                    'plugins/datepicker/english/english-datepicker.min.js',
                    'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                    'plugins/select2/js/select2.full.min.js',
                    'js/custom_app.min.js',
                    'js/complaint/complaint.js',
                    'js/complaint/dropdown.js',
                    'js/localBodyHierarchy.js',
                    'js/dateConverter.js',

                ];

                $data['show_button'] = true;

                $name = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['countryList'] = MstCountry::select('id', $name.' '.'as name');
                $data['genderList'] = MstGender::select('id', $name.' '.'as name');
                $complaint = getLan() == 'np' ? 'name_ne' : 'name';
                $data['complaintSourceList'] = ComplaintSource::select('id', $complaint.' '.'as name');
                $data['complaintTypeList'] = FormCategory::select('id', $complaint.' '.'as name');

                $gender = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['gender_id'] = MstGender::select('id', $gender.' '.'as name_en');

                $severityType = getLan() == 'np' ? 'name_ne' : 'name';
                $data['complaintSeverityList'] = SeverityType::select('id', $severityType.' '.'as name');

                $name = getLan() == 'np' ? 'name_ne' : 'name';
                $data['office_id'] = MstOffice::select('id', $name.' '.'as name');
                $data['provinces'] = DropDownController::getProvinceList();
                $data['districts'] = DropDownController::getAllDistricts();
                $data['vdcmun'] = DropDownController::getAllVdcMun();

                $data['cancel_button'] = true;
                $data['index_page_url'] = 'complaints';
                $data['load_css'] = [
                    'plugins/select2/css/select2.css',
                    'plugins/datepicker/english/english-datepicker.css',
                    'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

                ];

                return view('backend.grevience.complaints.edit', $data);
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('complaints');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            request()->validate([
                'form_category_id' => 'required',
                'description' => 'required',
                'complaint_source_id' => 'required',
                'severity_type_id' => 'required',
            ]);
            DB::beginTransaction();
            $no = $this->model->find($id);
            $data = $request->all();
            $data['updated_by'] = userInfo()->id;
            $this->model->update($data, $id);
            // insert log
            $this->logsRepository
                ->insertLog($no->id, $this->menuId, 17);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return redirect(url('complaints'));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function show(Request $request, $id)
    {

        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['complaint'] = Complaint::query()->find($hashIdValue[0]);
                $name = getLan() == 'np' ? 'name_ne' : 'name';
                $data['complaintStatuses'] = ComplaintStatus::whereIn('code', ['PRO', 'CLO'])->select('id', $name.' '.'as name')->get();

                if ($data) {

                    $complaintType = getLan() == 'np' ? 'name_ne' : 'name';
                    $data['complaintTypeList'] = FormCategory::select('id', $complaintType.' '.'as name');
                    $data['progress'] = ComplaintProgressInfo::with(['userInfo'])->where('complaint_id', $hashIdValue)->orderBy('id', 'DESC')->get();
                    $data['dateHelper'] = new DateConverter();

                    $data['page_title'] = getLan() == 'np' ? 'गुनासो' : 'Complaints';
                    $data['page_url'] = 'complaints';
                    $data['page_route'] = 'complaints';
                    $data['load_css'] = [
                        'css/trackingprogress.css',
                        'plugins/select2/css/select2.css',
                    ];
                    $data['load_js'] = [
                        'plugins/select2/js/select2.full.min.js',
                        'js/complaint/complaint.js',

                    ];

                    //check read date null
                    $checkDate = Notification::query()->where(['notify_id' => $data['complaint']->id, 'notify_type' => 'complaint'])->first();
                    //update read date
                    if ($request->is_notify == true && is_null($checkDate->notification_read_date_np)) {
                        $notificationData = [
                            'notification_read_date_en' => Carbon::now(),
                            'notification_read_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                            'notify_read_by' => userInfo()->id,
                        ];

                        Notification::query()->where(['notify_id' => $checkDate->notify_id, 'notify_type' => 'complaint'])->update($notificationData);
                    }
                    $data['filePath'] = Complaint::FILE_UPLOAD_PATH;

                    return view('backend.grevience.complaints.show', $data);

                }
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('complaints');
            }
        } catch (\Exception $e) {

            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function status($id, Request $request): RedirectResponse
    {
        try {
            $id = (int) $id;
            $complaint = $this->model->find($id);
            //  dd($request->all(),$complaint);
            if ($complaint->status == 1) {
                DB::beginTransaction();
                $this->model->status($complaint->id, 2);

                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($request->status == 3) {
                DB::beginTransaction();
                $progressInfo = ComplaintProgressInfo::create([
                    'client_id' => userInfo()->client_id,
                    'user_id' => Auth::user()->id,
                    'complaint_id' => $complaint->id,
                    'description' => $request->description,
                    'responding_office' => $request->responding_office,
                    'status' => true,
                ]);
                $this->model->status($complaint->id, $request->status);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            } elseif ($request->status == 8 && ($complaint->status == 2 || $complaint->status == 3 || $complaint->status == 6)) {
                DB::beginTransaction();
                //update status for appointment
                if ($complaint->appointment_no != null) {
                    Appointment::query()->where('appointment_no', $complaint->appointment_no)->update([
                        'appointment_status' => '4',
                        'complaint_process' => '8']);
                }

                $this->model->status($complaint->id, 8);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            } elseif ($complaint->status == 8) {

                DB::beginTransaction();
                //update status for appointment
                if ($complaint->appointment_no != null) {
                    Appointment::query()->where('appointment_no', $complaint->appointment_no)->update([
                        'appointment_status' => 5,
                        'complaint_process' => 6]);
                }
                $this->model->status($complaint->id, 6);

                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return back();
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function postComplaintProgress(Request $request)
    {

        try {
            DB::beginTransaction();
            //forward process
            if ($request->complaint_status == 3) {

                $progressInfo = ComplaintProgressInfo::create([
                    'client_id' => userInfo()->client_id,
                    'user_id' => Auth::user()->id,
                    'complaint_id' => $request->complaint_id,
                    'description' => $request->description,
                    'responding_office' => $request->responding_office,
                    'status' => true,
                ]);
            }
            $complaint = Complaint::findOrFail($request->complaint_id);
            if ($complaint->appointment_no != null) {
                if ($request->complaint_status == 8) {
                    Appointment::query()->where('appointment_no', $complaint->appointment_no)->update([
                        'appointment_status' => '4',
                        'complaint_process' => '8']);
                }
            }
            Complaint::where('id', $request->complaint_id)->update(['status' => $request->complaint_status]);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.complaint_progress_info'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

        return redirect()->back();
    }

    public function generateUniqueNumber()
    {
        $randomNumber = mt_rand(1000000000, 9999999999);
        $count = Complaint::where('complaint_no', $randomNumber)->count();
        if ($count > 0) {
            return $this->generateUniqueNumber();
        } else {
            return $randomNumber;
        }
    }
}
