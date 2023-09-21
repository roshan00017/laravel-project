<?php

namespace App\Http\Controllers\Appointment;

use App\Events\AppointmentConfirmEvent;
use App\Facades\NepaliDate;
use App\Helpers\DateConverter;
use App\Helpers\SmsHelper;
use App\Http\Controllers\BaseController;
use App\Models\Appointment\Appointment;
use App\Models\Appointment\AppointmentHandover;
use App\Models\Appointment\AppointmentLog;
use App\Models\BasicDetails\ElectedPerson;
use App\Models\BasicDetails\HrDesignation;
use App\Models\BasicDetails\VisitingPurpose;
use App\Models\ComplaintProgressInfo;
use App\Models\EDMIS\Employee;
use App\Models\EDMIS\MemberType;
use App\Models\Grevience\Complaint;
use App\Models\Grevience\Notification;
use App\Models\Models\Grevience\ComplaintStatus;
use App\Repositories\AppointmentRepository;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AppointmentController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    protected DateConverter $dateConverter;

    protected AppointmentRepository $appointmentRepository;

    private int $menuId = 77;

    public function __construct(
        Appointment $model,
        LogsRepository $logsRepository,
        DateConverter $dateConverter,
        AppointmentRepository $appointmentRepository,
    ) {
        parent::__construct();
        // set the model
        $this->model = new CommonRepository($model);
        $this->logsRepository = $logsRepository;
        $this->dateConverter = $dateConverter;
        $this->appointmentRepository = $appointmentRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
            $data['page_url'] = '/appointments';
            $data['page_route'] = 'appointments';
            $data['results'] = $this->appointmentRepository->getAllAppointments($request);
            $data['request'] = $request;
            $data['create_menu'] = true;
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
                'js/custom_search.js',
                'js/custom_app.min.js',

            ];
            $data['script_js'] = "$(function(){
               $('.mobileNo').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
            })";

            return view('backend.appointment.index', $data);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function appointmentInfo(Request $request)
    {
        if ($request->date_en != null) {
            $year = explode('-', $request->date_en)[0];
            $month = explode('-', $request->date_en)[1];
            $day = explode('-', $request->date_en)[2];

            $request['date_en'] = $this->dateConverter->nep_to_eng($year, $month, $day);
            $today = Carbon::now()->toDateString();
        }

        $data['visitingPurposeList'] = VisitingPurpose::orderby('id', 'desc')->get();

        $data['employeeList'] = Employee::orderBy('id', 'desc')->get();
        $data['electedPersonList'] = ElectedPerson::orderBy('id', 'desc')->get();
        $data['memberTypeList'] = MemberType::orderBy('id', 'desc')->get();
        $data['hrDesignationList'] = HrDesignation::orderBy('id', 'desc')->get();
        $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
        $data['page_url'] = '/appointments';
        $data['page_route'] = 'appointments';
        $data['request'] = $request;

        $data['load_css'] = [
            'plugins/select2/css/select2.css',
            'plugins/datepicker/english/english-datepicker.css',
            'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
            'plugins/bs-stepper/css/bs-stepper.css',
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
            'js/dateConverter.js',
            'plugins/bs-stepper/js/bs-stepper.js',
            'js/appointment.js',
        ];
        $data['script_js'] = "$(function(){
            document.addEventListener('DOMContentLoaded', function () {
              window.stepper = new Stepper(document.querySelector('.bs-stepper'));
            });
            })";
        $data['appointment'] = $request->session()->get('appointment');

        $data['current_url'] = Route::current()->getName();

        return view('backend.appointment.appointmentInfo', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = $request->all();

            if (empty($request->session()->get('appointment'))) {
                $appointment = new Appointment();
                $appointment->fill($data);
                $request->session()->put('appointment', $appointment);
            } else {
                $appointment = $request->session()->get('appointment');
                $appointment->fill($request->all());
            }

            return redirect()->route('appointment.personalInfo');
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function personalInfo(Request $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
            $data['page_url'] = '/appointments';
            $data['page_route'] = 'appointments';

            //check request data
            if ($request->mobile_no != null || $request->email != null) {
                $personalInfo = $this->appointmentRepository->getPersonalInfo($request);
                if ($personalInfo) {
                    Session::flash('success', Lang::get('appointment.personal_data_found'));
                    $data['personalData'] = $personalInfo;
                } else {
                    Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));
                }
            }

            $data['request'] = $request;

            $data['load_css'] = [
                'plugins/bs-stepper/css/bs-stepper.css',
            ];

            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'js/custom_app.min.js',
                'plugins/bs-stepper/js/bs-stepper.js',
                'js/appointment.js',
            ];
            $data['script_js'] = "$(function(){
                document.addEventListener('DOMContentLoaded', function () {
                  window.stepper = new Stepper(document.querySelector('.bs-stepper'));
                });
                 $('.mobileNo').inputmask('9999999999', { placeholder: '' });
            })";

            $data['appointment'] = $request->session()->get('appointment');
            $data['current_url'] = Route::current()->getName();

            return view('backend.appointment.personalInfo', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function postPersonalDetails(Request $request)
    {
        try {

            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
            $data['page_url'] = '/appointments';
            $data['page_route'] = 'appointments';
            $data['request'] = $request;

            if (empty($request->session()->get('appointment'))) {
                $appointment = new Appointment();
                $appointment->fill($data);
                $request->session()->put('appointment', $appointment);
            } else {
                $appointment = $request->session()->get('appointment');
                $appointment->fill($request->all());
            }
            $data['visitingPurposeList'] = VisitingPurpose::orderby('id', 'desc')->get();

            $data['employeeList'] = Employee::orderBy('id', 'desc')->get();
            $data['appointment'] = $request->session()->get('appointment');

            return redirect()->route('appointment.appointmentConfirm');

            return view('backend.appointment.appointmentConfirm', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function appointmentConfirm(Request $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
            $data['page_url'] = '/appointments';
            $data['page_route'] = 'appointments';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/bs-stepper/css/bs-stepper.css',
            ];

            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'js/custom_app.min.js',
                'plugins/bs-stepper/js/bs-stepper.js',
            ];
            $data['script_js'] = "$(function(){
                document.addEventListener('DOMContentLoaded', function () {
                  window.stepper = new Stepper(document.querySelector('.bs-stepper'));
                });
                 $('.mobileNo').inputmask('9999999999', { placeholder: '' });
            })";

            $data['appointment'] = $request->session()->get('appointment');

            $data['current_url'] = Route::current()->getName();

            return view('backend.appointment.appointmentConfirm', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function storeAppointmentConfirm(Request $request)
    {
        try {
            $data = $request->session()->get('appointment');
            $data['appointment_taken_date_ad'] = Carbon::now()->toDateString();
            $data['appointment_taken_date_bs'] = NepaliDate::create(Carbon::now())->toBS();
            $data['appointment_no'] = $this->generateUniqueTokenNumber();
            $data['fy_id'] = currentFy()->id;
            $data['client_id'] = setClientId($request);
            $data['appointment_type'] = 's';
            $data['appointment_status'] = 1;
            $data['created_by'] = userInfo()->id;
            $data['visit_count'] = 1;
            $data['appointment_month_code'] = (int) explode('-', $data['appointment_date_bs'])[1];
            //check for designation id
            if ($data['visiting_section'] == 'km') {
                $data['visiting_to_designation_id'] = $data['visiting_to_elected_designation'];
                $data['visiting_to_person_id'] = $data['elected_person_id'];
            } elseif ($data['visiting_section'] == 'om') {
                $data['visiting_to_designation_id'] = $data['visiting_to_emp_designation'];
                $data['visiting_to_person_id'] = $data['employee_id'];

            }
            unset($data['visiting_to_emp_designation']);
            unset($data['visiting_to_elected_designation']);
            unset($data['employee_id']);
            unset($data['elected_person_id']);

            //check appointment check for appointment user module
            if (userInfo()->user_module == 'app') {
                $data['visiting_section'] = appointAccessInfo()->access_user_type;
                $data['visiting_to_person_id'] = appointAccessInfo()->appointment_access_user_id;
            }

            DB::beginTransaction();

            $data->save();

            // SMS AND EMAIL
            $contact = $data->mobile_no;
            $message = 'Appointment no :'.$data['appointment_no'].' Appointment created';
            if ($request->send_sms == 1) {
                if (smsSetting(userInfo()->client_id)) {
                    SmsHelper::sendSms($contact, $message);
                }
            }

            if ($request->send_email == 1) {
                $mailData = [
                    'name' => $data['full_name'],
                    'appointment_no' => $data['appointment_no'],
                    'email' => $data['email'],
                ];
                if (mailSetting(userInfo()->client_id)) {
                    AppointmentConfirmEvent::dispatch($mailData);
                }
            }
            //insert appointment log
            $this->storeAppointmentLog($data);
            //insert log
            $this->logsRepository->insertLog($data->id, $this->menuId, 2);

            DB::commit();
            $request->session()->forget('appointment');
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return redirect(url('appointments'));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function generateUniqueTokenNumber()
    {
        $randomNumber = mt_rand(1000000000, 9999999999);
        $count = Appointment::where('appointment_no', $randomNumber)->count();
        if ($count > 0) {
            return $this->generateUniqueTokenNumber();
        } else {
            return $randomNumber;
        }
    }

    public function show($id, Request $request)
    {

        try {

            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['appointment'] = Appointment::query()->find($hashIdValue[0]);
                $data['visitingPurposeList'] = VisitingPurpose::orderby('id', 'desc')->get();

                //get visit log details
                $data['visitLogDetails'] = $this->appointmentRepository->getPersonalVisitLog($data['appointment']->mobile_no, $data['appointment']->email, $data['appointment']->id, $request);

                //get visit log details
                $data['handoverDetails'] = $this->appointmentRepository->getHandoverDetails($data['appointment']->id, $request);

                $data['employeeList'] = Employee::orderBy('id', 'desc')->get();

                $name = getLan() == 'np' ? 'name_ne' : 'name';
                $data['complaintStatuses'] = ComplaintStatus::whereIn('code', ['PRO', 'CLO'])->select('id', $name.' '.'as name')->get();

                //check read date null
                $checkDate = Notification::query()->where(['notify_id' => $data['appointment']->id, 'notify_type' => 'appointment'])->first();
                //update read date
                if ($request->is_notify == true && is_null($checkDate->notification_read_date_np)) {
                    $notificationData = [
                        'notification_read_date_en' => Carbon::now(),
                        'notification_read_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                        'notify_read_by' => userInfo()->id,
                    ];

                    Notification::query()->where(['notify_id' => $data['appointment']->id, 'notify_type' => 'appointment'])->update($notificationData);

                }
                if ($data['appointment']) {
                    $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
                    $data['page_url'] = 'appointments';
                    $data['page_route'] = 'appointments';
                    $data['cancel_button'] = true;
                    $data['index_page_url'] = 'appointments';

                    $data['load_css'] = [
                        'plugins/select2/css/select2.css',
                        'plugins/datepicker/english/english-datepicker.css',
                        'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                        'css/trackingprogress.css',
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
                        'js/dateConverter.js',
                        'js/appointment.js',
                    ];
                    $data['script_js'] = "$(function(){

                            $('.mobileNo').inputmask('9999999999', { placeholder: '' });
                    })";
                    $data['employeeList'] = Employee::orderBy('id', 'desc')->get();
                    $data['electedPersonList'] = ElectedPerson::orderBy('id', 'desc')->get();
                    $data['memberTypeList'] = MemberType::orderBy('id', 'desc')->get();
                    $data['hrDesignationList'] = HrDesignation::orderBy('id', 'desc')->get();
                    $data['dateHelper'] = new DateConverter();

                    #check for appointment complaint status
                    $data['appComplaintInfo'] = Complaint::query()->where('appointment_no', $data['appointment']->appointment_no)->first();

                    if($data['appComplaintInfo'] != null){
                        $data['appComplaintProgress'] = ComplaintProgressInfo::with(['userInfo'])->where('complaint_id',  $data['appComplaintInfo']->id)->orderBy('id', 'DESC')->get();
                    }

                    

                    return view('backend.appointment.show', $data);
                }

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcRegisterBook');
            }

        } catch (\Exception $e) {
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
                $appointment = Appointment::find($request->appointment_id);
                $complaint_date_en = Carbon::now()->toDateString();
                $complaint_date_np = NepaliDate::create(Carbon::now())->toBS();
                $complaint_month_code = (int) explode('-', $complaint_date_np)[1];
                $progressInfo = Complaint::create([
                    'client_id' => userInfo()->client_id,
                    'user_id' => Auth::user()->id,
                    'complaint_id' => $request->complaint_id,
                    'description' => $request->description,
                    'responding_office' => $request->responding_office,
                    'status' => 3,
                    'form_category_id' => '3',
                    'complaint_source_id' => '8',
                    'complaint_no' => $this->generateUniqueNumber(),
                    'complaint_date_en' => $complaint_date_en,
                    'complaint_date_np' => $complaint_date_np,
                    'name_ne' => $appointment->full_name,
                    'name_en' => $appointment->full_name,
                    'severity_type_id' => '3',
                    'appointment_no' => $appointment->appointment_no,
                    'complaint_month_code' => $complaint_month_code,
                ]);
            }
            if ($request->complaint_status == 8) {
                $appointment_status = 4;
            } elseif ($request->complaint_status == 3) {
                $appointment_status = 5;
            }
            Appointment::where('id', $request->appointment_id)->update(['appointment_status' => $appointment_status, 'complaint_process' => $request->complaint_status]);

            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.complaint_progress_info'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
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

    public function edit($id)
    {

        try {

            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = Appointment::query()->find($hashIdValue[0]);
                $data['visitingPurposeList'] = VisitingPurpose::orderby('id', 'desc')->get();
                $data['electedPersonList'] = ElectedPerson::orderBy('id', 'desc')->get();
                $data['memberTypeList'] = MemberType::orderBy('id', 'desc')->get();
                $data['hrDesignationList'] = HrDesignation::orderBy('id', 'desc')->get();
                $data['employeeList'] = Employee::orderBy('id', 'desc')->select('id', DB::raw("CONCAT(first_name_np,' ',middle_name_np,' ',last_name_np) AS full_name_np
                "), DB::raw("CONCAT(first_name_en,' ',middle_name_en,' ',last_name_en) AS full_name_en
                "))->get();
                if ($data['value']) {
                    $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
                    $data['page_url'] = 'appointments';
                    $data['page_route'] = 'appointments';
                    $data['cancel_button'] = true;
                    $data['index_page_url'] = 'appointments';
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
                        'js/dateConverter.js',
                        'js/appointment.js',
                    ];
                    $data['script_js'] = "$(function(){

                            $('.mobileNo').inputmask('9999999999', { placeholder: '' });
                    })";
                    // dd($data);

                    return view('backend.appointment.edit', $data);
                }

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcRegisterBook');
            }

        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $value = $this->model->find($id);
            if ($value) {
                $data = $request->all();
                $data['updated_by'] = auth()->user()->id;

                if (userInfo()->user_module != 'app') {

                    if ($data['visiting_section'] == 'km') {
                        $data['visiting_to_designation_id'] = $data['visiting_to_elected_designation'];
                        $data['visiting_to_person_id'] = $data['elected_person_id'];
                    } elseif ($data['visiting_section'] == 'om') {
                        $data['visiting_to_designation_id'] = $data['visiting_to_emp_designation'];
                        $data['visiting_to_person_id'] = $data['employee_id'];
                    }

                }
                unset($data['visiting_to_emp_designation']);
                unset($data['visiting_to_elected_designation']);
                unset($data['employee_id']);
                unset($data['elected_person_id']);

                $this->model->update($data, $id);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 2);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return redirect(url('appointments'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function destroy(int $id)
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

    public function appointmentHandover(Request $request)
    {
        try {

            $data = $request->all();
            $data['handover_taken_date_ad'] = Carbon::now()->toDateString();
            $data['handover_taken_date_bs'] = NepaliDate::create(Carbon::now())->toBS();
            $data['handover_taken_by'] = userInfo()->id;
            //check for designation id
            if ($data['visiting_section'] = 'km') {
                $data['visiting_to_designation_id'] = $data['visiting_to_elected_designation'];
                $data['visiting_to_person_id'] = $data['elected_person_id'];
            } elseif ($data['visiting_section'] = 'om') {
                $data['visiting_to_designation_id'] = $data['visiting_to_emp_designation'];
                $data['visiting_to_person_id'] = $data['employee_id'];

            }

            //update visiting status
            Appointment::query()->where('id', $request->appointment_id)->update(['appointment_status' => 3]);
            DB::beginTransaction();
            $create = AppointmentHandover::create($data);
            DB::commit();
            //insert appointment log
            $this->storeAppointmentLog($create);
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function storeAppointmentLog($data)
    {
        $appointmentLog = [
            'appointment_id' => $data->id,
            'appointment_date_ad' => $data->appointment_date_ad,
            'appointment_date_bs' => $data->appointment_date_bs,
            'appointment_time' => $data->time,
            'appointment_section' => $data->visiting_section,
            'appointment_reason' => $data->visiting_purpose_reason,
            'appointment_type' => $data->appointment_type,
            'status' => $data->appointment_status,
            'action_by' => userInfo()->id,
        ];
        $appointmentLog['action_date_ad'] = Carbon::now()->toDateString();
        $appointmentLog['action_date_bs'] = NepaliDate::create(Carbon::now())->toBS();

        return AppointmentLog::create($appointmentLog);
    }

    public function updateAppointmentStatus($id, Request $request)
    {
        try {

            $value = $this->model->find($id);
            if ($value) {
                $data = $value;
                $data['visited_date_en'] = Carbon::now()->toDateString();
                $data['visited_date_np'] = NepaliDate::create(Carbon::now())->toBS();
                $data['appointment_status'] = 2;
                Appointment::query()->where('id', $value->id)->update([
                    'appointment_status' => $data['appointment_status'],
                    'visited_date_en' => $data['visited_date_en'],
                    'visited_date_np' => $data['visited_date_np'],
                ]);
                DB::beginTransaction();
                //insert appointment log
                $this->storeAppointmentLog($data);

                DB::commit();

            }
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function getEmployee(Request $request): string
    {
        try {
            $emp_designation_id = $request->emp_designation;
            $empList = Employee::query()
                ->select('id', 'first_name_np', 'middle_name_np', 'last_name_np', 'first_name_en', 'middle_name_en', 'last_name_en')
                ->where('hr_designation_id', $emp_designation_id)
                ->orderBy('id', 'desc')
                ->get();
            $result = "<option class='f-kalimati' value=''>".trans('appointment.select_employee').'</option>';
            foreach ($empList as $value) {
                $fullName = getLan() == 'np' ? $value->first_name_np.' '.$value->middle_name_np.' '.$value->last_name_np : $value->first_name_en.' '.$value->middle_name_en.' '.$value->last_name_en;
                $result .= "<option class='f-kalimati' value='".$value->id."'>".$fullName.'</option>';
            }

            return $result;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }

    }

    public function getElectedPerson(Request $request): string
    {
        try {
            $name = setName();
            $elected_designation = $request->elected_designation;
            $empList = ElectedPerson::query()
                ->select('id', $name)
                ->where('hr_designation_id', $elected_designation)
                ->orderBy('id', 'desc')
                ->get();
            $result = "<option class='f-kalimati' value=''>".trans('appointment.select_elected_person').'</option>';
            foreach ($empList as $value) {
                $result .= "<option class='f-kalimati' value='".$value->id."'>".$value->$name.'</option>';
            }

            return $result;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }

    }
}
