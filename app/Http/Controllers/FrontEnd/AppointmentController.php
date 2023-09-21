<?php

namespace App\Http\Controllers\FrontEnd;

use App\Events\AppointmentConfirmEvent;
use App\Facades\NepaliDate;
use App\Helpers\DateConverter;
use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\AppointmentInfoRequest;
use App\Http\Requests\FrontEnd\AppointmentInfoRequest1;
use App\Models\Appointment\Appointment;
use App\Models\Appointment\AppointmentLog;
use App\Models\Appointment\FrontEndAppointment;
use App\Models\BasicDetails\ElectedPerson;
use App\Models\BasicDetails\HrDesignation;
use App\Models\BasicDetails\VisitingPurpose;
use App\Models\EDMIS\Employee;
use App\Models\EDMIS\MemberType;
use App\Models\Grevience\Notification;
use App\Repositories\CalendarRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Models\Grevience\Complaint;
use App\Models\ComplaintProgressInfo;


class AppointmentController extends Controller
{
    private CalendarRepository $calendarRepository;

    private DateConverter $dateConverter;

    private Appointment $model;

    public function __construct(CalendarRepository $calendarRepository,
        Appointment $model,
        DateConverter $dateConverter)
    {
        $this->calendarRepository = $calendarRepository;
        $this->dateConverter = $dateConverter;
        $this->model = $model;

    }

    public function index(Request $request)
    {

        try {
            //calendar menu start
            $data['weekDays'] = $this->calendarRepository->weekDays();
            $todayDateNp = NepaliDate::create(Carbon::now())->toBS();
            $todayDateArr = explode('-', $todayDateNp);

            if ($request->year_code != null) {
                $year = $request->year_code;
            } else {
                $year = count($todayDateArr) > 0 ? $todayDateArr[0] : '';
            }
            if ($request->month_code != null) {
                $month = $request->month_code;
            } else {
                $month = count($todayDateArr) > 0 ? $todayDateArr[1] : '';
            }

            $data['year_code'] = $year;
            $data['month_code'] = $month;
            $data['month_name'] = $this->calendarRepository->getMonth($month);
            $data['year_month_en'] = $this->calendarRepository->getYearMonthEn($year, $month);
            $data['click_btn'] = $request->click_btn;

            $monthDays = $this->calendarRepository->getCalendarMonthDays($year, $month);
            $monthFirstDay = $this->calendarRepository->monthFirstDay($year, $month);

            $data['yearList'] = $this->calendarRepository->getYearList();
            $data['monthList'] = $this->calendarRepository->getMonthList();

            $data['monthDays'] = $this->calendarRepository->formatMonthDays($monthFirstDay, $monthDays);
            $data['monthFirstDay'] = $monthFirstDay;
            $data['calRepo'] = $this->calendarRepository;
            $data['monthNames'] = getLan() == 'np' ? $this->calendarRepository->nepaliMonthNames() : $this->calendarRepository->englishMonthNames();
            $data['monthFirstDay'] = $this->calendarRepository->monthFirstDay($year, $month);
            //calendar menu end
            $data['page_url'] = 'appointment-schedule';
            $data['request'] = $request;
            $data['page_title'] = getLan() == 'np' ? 'भेटघाट' : 'Meetup';
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
            ];
            $data['script_js'] = "$(function(){
                $('.mobileNo').inputmask('9999999999', { placeholder: '' });
             })";

            return view('frontend.appointment.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function appointmentInfo(Request $request)
    {
        try {
            if ($request->date != null) {
                $request['date_np'] = decrypt($request->date);
                $year = explode('-', $request['date_np'])[0];
                $month = explode('-', $request['date_np'])[1];
                $day = explode('-', $request['date_np'])[2];

                $request['date_en'] = $this->dateConverter->nep_to_eng($year, $month, $day);
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
                // 'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css',
                'plugins/select2/css/select2.css',
            ];

            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'assets/js/multistep-form.js',
                //'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.js',
                'plugins/select2/js/select2.full.min.js',
                'js/appointmentInfo.js',

            ];
            //        $data['script_js'] = "$(function(){
            //             $(document).ready(function () {
            //                 $('.type-select').niceSelect();
            //             });
            //        })";
            $data['aptInfo'] = $request->session()->get('aptInfo');

            $data['current_url'] = Route::current()->getName();

            return view('frontend.appointment.appointment-info', $data);
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

    public function postAppointmentInfo(AppointmentInfoRequest $request)
    {
        try {
            $data = $request->all();
            if (empty($request->session()->get('aptInfo'))) {
                $aptInfo = new FrontEndAppointment();
                $aptInfo->fill($data);
                $request->session()->put('aptInfo', $aptInfo);
            } else {
                $aptInfo = $request->session()->get('aptInfo');
                $aptInfo->fill($request->all());
            }

            return redirect()->route('personalInfo');

        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }

    public function getPersonalInfo(Request $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
            $data['page_url'] = '/appointment-info';
            $data['page_route'] = 'appointment-info';

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

            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'js/appointmentInfo.js',

            ];
            $data['script_js'] = "$(function(){
                 $('.mobileNo').inputmask('9999999999', { placeholder: '' });
              })";

            $data['aptInfo'] = $request->session()->get('aptInfo');
            $data['current_url'] = Route::current()->getName();

            return view('frontend.appointment.personal-info', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }

    public function postPersonalDetails(AppointmentInfoRequest1 $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
            $data['request'] = $request;

            if (empty($request->session()->get('aptInfo'))) {
                $aptInfo = new Appointment();
                $aptInfo->fill($data);
                $request->session()->put('aptInfo', $aptInfo);
            } else {
                $aptInfo = $request->session()->get('aptInfo');
                $aptInfo->fill($request->all());
            }
            $data['visitingPurposeList'] = VisitingPurpose::orderby('id', 'desc')->get();

            $data['employeeList'] = Employee::orderBy('id', 'desc')->get();
            $data['aptInfo'] = $request->session()->get('aptInfo');

            return redirect()->route('appointmentConfirm');
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function appointmentConfirm(Request $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
            $data['request'] = $request;

            $data['aptInfo'] = $request->session()->get('aptInfo');
            $data['current_url'] = Route::current()->getName();
            $data['load_js'] = [
                'js/main.js',
            ];

            return view('frontend.appointment.appointment-confirm', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function storeAppointmentConfirm(Request $request)
    {
        try {
            $data = $request->session()->get('aptInfo');
            $data['appointment_taken_date_ad'] = Carbon::now()->toDateString();
            $data['appointment_taken_date_bs'] = NepaliDate::create(Carbon::now())->toBS();
            $data['appointment_no'] = $this->generateUniqueTokenNumber();
            $data['fy_id'] = currentFy()->id;
            $data['client_id'] = clientInfo()->id;
            $data['appointment_type'] = 'p';
            $data['appointment_status'] = 1;
            $data['visit_count'] = 1;
            $data['appointment_month_code'] = (int) explode('-', $data['date_bs'])[1];
            //check for designation id
            if ($data['appointment_section'] = 'km') {
                $data['visiting_to_designation_id'] = $data['appointment_to_elected_designation'];
                $data['visiting_to_person_id'] = $data['ep_id'];
            } elseif ($data['appointment_section'] = 'om') {
                $data['visiting_to_designation_id'] = $data['appointment_to_emp_designation'];
                $data['visiting_to_person_id'] = $data['emp_id'];

            }

            $data['appointment_date_bs'] = $data['date_bs'];
            $data['appointment_date_ad'] = $data['date_bs'];
            $data['time'] = $data['appointment_time'];
            $data['visiting_section'] = $data['appointment_section'];
            $data['visiting_purpose_id'] = $data['appointment_purpose_id'];
            $data['visiting_purpose_reason'] = $data['appointment_purpose_reason'];
            $data['full_name'] = $data['name'];
            $data['address'] = $data['address_info'];
            $data['email'] = $data['email_address'];
            $data['mobile_no'] = $data['mobile'];

            //unset from data ( which are not present in table )
            unset($data['appointment_to_emp_designation']);
            unset($data['appointment_to_elected_designation']);
            unset($data['emp_id']);
            unset($data['ep_id']);
            unset($data['appointment_time']);
            unset($data['date_bs']);
            unset($data['date_ad']);
            unset($data['appointment_section']);
            unset($data['appointment_purpose_id']);
            unset($data['appointment_purpose_reason']);
            unset($data['name']);
            unset($data['address_info']);
            unset($data['email_address']);
            unset($data['mobile']);

            DB::beginTransaction();

            $data->save();
            //insert appointment log
            $this->storeAppointmentLog($data);

            // add notification logs
            $notificationData = [
                'fy_id' => $data->fy_id,
                'client_id' => $data->client_id,
                'notify_date_np' => $data->appointment_taken_date_bs,
                'notify_date_en' => $data->appointment_taken_date_ad,
                'title_en' => 'New appointment request',
                'title_np' => 'नयाँ भेटघाट अनुरोध',
                'notify_url' => 'appointments'.'/'.hashIdGenerate($data->id),
                'notify_type' => 'appointment',
                'notify_to_user_id' => $data['visiting_to_person_id'],
                'notify_id' => $data->id,
            ];

            Notification::create($notificationData);

            // SMS AND EMAIL
            $contact = $data->mobile_no;
            $message = 'Appointment no :'.$data['appointment_no'].' Appointment created';
            if (smsSetting(clientInfo()->id)) {
                SmsHelper::sendSms($contact, $message);
            }

            $mailData = [
                'name' => $data['full_name'],
                'appointment_no' => $data['appointment_no'],
                'email' => $data['email'],
            ];
            if (mailSetting(clientInfo()->id)) {
                AppointmentConfirmEvent::dispatch($mailData);
            }

            DB::commit();
            $request->session()->forget('aptInfo');
            Session::flash('success', Lang::get('frontEndFlashMessage.appointment_book_message').' '
                .$data->appointment_no.' '.Lang::get('frontEndFlashMessage.complaint_ticket_no'));

            return response()->json([
                'status' => true,
                'appointment_message' => Lang::get('frontEndFlashMessage.suggestion_register_message'),
            ]);
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

    public function getAppointmentStatus(Request $request)
    {
        try {
            $chk_ticket_presence = Appointment::where('appointment_no', $request->appointment_no)->first();
            if ($chk_ticket_presence) {
                $data['appointment'] = Appointment::where('appointment_no', $request->appointment_no)->first();
            } else {
                Session::flash('data_not_found', Lang::get('frontEndFlashMessage.ticket_not_found'));

                return redirect()->back();
            }
            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
            $data['request'] = $request;
            $data['dateHelper'] = new DateConverter();
            $data['load_css'] = [
                'css/trackingprogress.css',
            ];


             #check for appointment complaint status
             $data['appComplaintInfo'] = Complaint::query()->where('appointment_no', $data['appointment']->appointment_no)->first();

             if($data['appComplaintInfo'] != null){
                 $data['appComplaintProgress'] = ComplaintProgressInfo::with(['userInfo'])->where('complaint_id',  $data['appComplaintInfo']->id)->orderBy('id', 'DESC')->get();
             }

            return view('frontend.appointment.appointment-status', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }

    public static function checkAppointmentTokenStatus($tokenInfo)
    {
        try {
            $data['appointment'] = $tokenInfo;
            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';

            return view('frontend.appointment.appointment-status', $data);
        } catch (\Exception $e) {
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
        ];
        $appointmentLog['action_date_ad'] = Carbon::now()->toDateString();
        $appointmentLog['action_date_bs'] = NepaliDate::create(Carbon::now())->toBS();

        return AppointmentLog::create($appointmentLog);
    }

    public function getAppointmentHistory(Request $request)
    {
        try {
            if($request->email != null){
                $appointments = Appointment::where('email', $request->email)->get();
            }
            else if($request->mobile_no != null)
                $appointments = Appointment::where('mobile_no', $request->mobile_no)->get();

            if ($request->email != null && is_null($request->mobile_no)) {
                $appointments = Appointment::query()
                    ->where('email', $request->email)
                    ->orderBy('appointment_date_ad', 'desc')
                    ->get();
                if (count($appointments) > 0) {
                    $data['appointments'] = $appointments;
                } else {
                    Session::flash('data_not_found', Lang::get('frontEndFlashMessage.appointment_history_not_found'));

                    return redirect()->back();
                }
            } elseif ($request->mobile_no != null && is_null($request->email)) {
                $appointments = Appointment::query()
                    ->where('mobile_no', $request->mobile_no)
                    ->orderBy('appointment_date_ad', 'desc')
                    ->get();
                if (count($appointments) > 0) {
                    $data['appointments'] = $appointments;

                } else {
                    Session::flash('data_not_found', Lang::get('frontEndFlashMessage.appointment_history_not_found'));

                    return redirect()->back();
                }

            } elseif ($request->mobile_no != null && $request->email != null) {
                $appointments = Appointment::query()
                    ->where(['mobile_no' => $request->mobile_no, 'email' => $request->email])
                    ->orderBy('appointment_date_ad', 'desc')
                    ->get();
                if (count($appointments) > 0) {
                    $data['appointments'] = $appointments;

                } else {
                    Session::flash('data_not_found', Lang::get('frontEndFlashMessage.appointment_history_not_found'));

                    return redirect()->back();
                }

            } else {
                Session::flash('data_not_found', Lang::get('frontEndFlashMessage.appointment_history_not_found'));

                return redirect()->back();
            }
            $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
            $data['request'] = $request;
            $data['dateHelper'] = new DateConverter();
            $data['load_css'] = [
                'css/trackingprogress.css',
            ];
            


             #check for appointment complaint status
//            foreach($appointments as $appointment){
//                $data['appComplaintInfo'] = Complaint::query()->where('appointment_no', $appointment->appointment_no)->first();
//
//
//            if($data['appComplaintInfo'] != null){
//            }
//            }
            $data['appComplaintProgress'] = ComplaintProgressInfo::with(['userInfo'])->where('complaint_id',  $data['appComplaintInfo']->id)->orderBy('id', 'DESC')->get();

            dd($data['appComplaintProgress']);
            return view('frontend.appointment.appointment-history', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }
}
