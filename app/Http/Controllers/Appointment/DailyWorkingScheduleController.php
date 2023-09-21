<?php

namespace App\Http\Controllers\Appointment;

use App\Facades\NepaliDate;
use App\Helpers\DateConverter;
use App\Http\Controllers\BaseController;
use App\Models\Appointment\DailyWorkingSchedule;
use App\Models\Appointment\ScheduleType;
use App\Models\BasicDetails\ElectedPerson;
use App\Models\BasicDetails\HrDesignation;
use App\Models\EDMIS\Employee;
use App\Models\EDMIS\MemberType;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\DailyWorkingScheduleRepository;
use App\Repositories\LogsRepository;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DailyWorkingScheduleController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    protected DailyWorkingScheduleRepository $dailyWorkingScheduleRepository;

    protected DateConverter $dateConverter;

    private int $menuId = 25;

    public function __construct(DailyWorkingSchedule $dailyWorkingSchedule, LogsRepository $logsRepository,
        DailyWorkingScheduleRepository $dailyWorkingScheduleRepository, DateConverter $dateConverter)
    {
        parent::__construct();
        $this->model = new CommonRepository($dailyWorkingSchedule);
        $this->logsRepository = $logsRepository;
        $this->dailyWorkingScheduleRepository = $dailyWorkingScheduleRepository;
        $this->dateConverter = $dateConverter;

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
    }

    public function index(Request $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'दैनिक कार्य तालिका' : 'Daily Working Schedule';
            $data['page_url'] = 'dailyschedules';
            $data['page_route'] = 'dailyschedules';
            $data['results'] = $this->dailyWorkingScheduleRepository->getAllDailyWorkingSchedules($request);
            $data['request'] = $request;
            $data['create_menu'] = true;
            $data['delete_menu'] = true;
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

            return view('backend.appointment.dailyWorkingSchedule.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function create(Request $request)
    {
        try {
            $data['page_url'] = 'dailyschedules';
            $data['prev_page_url'] = 'dailyschedules';
            $data['page_route'] = 'dailyschedules';
            $data['index_page_url'] = 'dailyschedules';
            $data['cancel_button'] = true;
            $name = getLan() == 'np' ? 'first_name_np' : 'first_name_en';
            $data['employeeList'] = Employee::select('id', $name.' '.'as name');
            $name_pn = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['ElectedPersonList'] = ElectedPerson::select('id', $name_pn.' '.'as name');
            $data['memberTypeList'] = MemberType::select('id', $name_pn.' '.'as name');
            $data['hrDesignationList'] = HrDesignation::select('id', $name_pn.' '.'as name');
            $data['scheduleTypes'] = ScheduleType::select('id', $name_pn.' '.'as name');
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
                'js/add_schedule.js',
                'js/daily_working.js',
                'js/radio.js',
                // 'js/is_complete_daily_working.js',
                //'js/current_time.js',
            ];
            if ($request->date_np != null) {
                $year = explode('-', $request->date_np)[0];
                $month = explode('-', $request->date_np)[1];
                $day = explode('-', $request->date_np)[2];

                $data['date_en'] = $this->dateConverter->nep_to_eng($year, $month, $day);
                $data['date_np'] = $request->date_np;
            }

            $data['page_title'] = getLan() == 'np' ? 'दैनिक कार्य तालिका' : 'Daily Working Schedule';

            return view('backend.appointment.dailyWorkingSchedule.create', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

        return view('backend.appointment.dailyWorkingSchedule.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();
            $scheduleDataArray = $data['dailySchedule'];
            //add meeting agenda data
            if ($scheduleDataArray[0]['title'] != null) {
                foreach ($scheduleDataArray as $key => $schedule) {
                    $schedule_type = '';
                    if (userInfo()->user_module == 'app') {
                        $schedule_type = appointAccessInfo()->access_user_type;
                        $person_id = appointAccessInfo()->appointment_access_user_id;
                    } else {
                        if ($request->schedule_type == 'om') {
                            $person_id = $request->employee_id;
                        } elseif ($request->schedule_type == 'km') {
                            $person_id = $request->elected_person_id;
                        }
                    }

                    $startTime = Carbon::parse($request->date_en ? $request->date_en.' '.$schedule['start_time'] : Carbon::now()->toDateString().' '.$schedule['start_time']);
                    $endTime = Carbon::parse($request->date_en ? $request->date_en.' '.$schedule['end_time'] : Carbon::now()->toDateString().' '.$schedule['end_time']);

                    $totalDuration = $startTime->diff($endTime)->format('%H:%I').' Minutes';
                    $scheduleData = [
                        'title' => $schedule['title'],
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time'],
                        'location' => $schedule['location'],
                        'created_by' => userInfo()->id,
                        'fy_id' => currentFy()->id,
                        'client_id' => setClientId($request),
                        'schedule_type' => $request->schedule_type ? $request->schedule_type : $schedule_type,
                        'type_id' => $request->type_id,
                        'schedule_to_person_id' => $person_id,
                        'duration' => $totalDuration,
                        'schedule_date_en' => $request->date_en ? $request->date_en : Carbon::now()->toDateString(),
                        'schedule_date_np' => $request->date_np ? $request->date_np : NepaliDate::create(Carbon::now())->toBS(),
                        'schedule_added_date_en' => Carbon::now()->toDateString(),
                        'schedule_added_date_np' => NepaliDate::create(Carbon::now())->toBS(),

                    ];

                    DB::beginTransaction();
                    $create = $this->model->create($scheduleData);
                    // insert log
                    $this->logsRepository->insertLog($create->id, $this->menuId, 24);
                    DB::commit();
                }
            }

            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return redirect(url('dailyschedules'));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $value = $this->model->find($id);
            if ($value) {
                $data = $request->all();
                $data['updated_by'] = auth()->user()->id;
                DB::beginTransaction();
                $this->model->update($data, $id);
                $this->logsRepository->insertLog($value->id, $this->menuId, 2);
                DB::commit();

                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return redirect('dailyschedules');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function edit(Request $request, $id)
    {
        try {

            $data['page_url'] = 'dailyschedules';
            $data['prev_page_url'] = 'dailyschedules';
            $data['page_route'] = 'dailyschedules';
            $data['index_page_url'] = 'dailyschedules';
            $data['cancel_button'] = true;
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = DailyWorkingSchedule::query()->find($hashIdValue[0]);
                $name = getLan() == 'np' ? 'first_name_np' : 'first_name_en';
                $data['employeeList'] = Employee::select('id', $name.' '.'as name');
                $name_pn = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['ElectedPersonList'] = ElectedPerson::select('id', $name_pn.' '.'as name');
                $data['memberTypeList'] = MemberType::select('id', $name_pn.' '.'as name');
                $data['hrDesignationList'] = HrDesignation::select('id', $name_pn.' '.'as name');
                $data['scheduleTypes'] = ScheduleType::select('id', $name_pn.' '.'as name');
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
                    'js/add_schedule.js',
                    'js/daily_working.js',
                    'js/radio.js',
                    'js/is_complete_daily_working.js',
                    //'js/current_time.js',
                ];
                if ($request->date_np != null) {
                    $year = explode('-', $request->date_np)[0];
                    $month = explode('-', $request->date_np)[1];
                    $day = explode('-', $request->date_np)[2];

                    $data['date_en'] = $this->dateConverter->nep_to_eng($year, $month, $day);
                    $data['date_np'] = $request->date_np;
                }

                $data['page_title'] = getLan() == 'np' ? 'दैनिक कार्य तालिका' : 'Daily Working Schedule';

                return view('backend.appointment.dailyWorkingSchedule.edit', $data);

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dailyschedules');
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
}
