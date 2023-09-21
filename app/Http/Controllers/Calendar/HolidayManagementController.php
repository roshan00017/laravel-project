<?php

namespace App\Http\Controllers\Calendar;

use App\Helpers\DateConverter;
use App\Http\Controllers\BaseController;
use App\Models\Calendar\CalendarHoliday;
use App\Models\Calendar\CalendarHolidayDay;
use App\Models\MstFederalHierarchy;
use App\Repositories\CommonRepository;
use App\Repositories\HolidayRepository;
use App\Repositories\LogsRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class HolidayManagementController extends BaseController
{
    protected CommonRepository $model;

    private HolidayRepository $holidayRepository;

    private DateConverter $dateConverter;

    private CalendarHoliday $calendarHolidays;

    private LogsRepository $logsRepository;

    private int $menuId = 60;

    public function __construct(HolidayRepository $holidayRepository,
        DateConverter $dateConverter,
        CalendarHoliday $calendarHolidays, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($calendarHolidays);
        $this->holidayRepository = $holidayRepository;
        $this->dateConverter = $dateConverter;
        $this->calendarHolidays = $calendarHolidays;
        $this->logsRepository = $logsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //
        try {
            //
            $data['page_route'] = 'holidayManagement';
            $data['page_url'] = 'holidayManagement';
            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                'plugins/datepicker/english/english-datepicker.css',
            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/holiday.js',
                'js/holidayv2.js',
            ];

            if (Session::has('addMore')) {
                $data['script_js'] = "$(function(){
                     $(document).ready(function() {
                        $('#addHolidayModal').modal('show');
                    });
                })";
            }

            $data['page_title'] = getLan() == 'np' ? 'बिदा' : 'Holiday';
            $data['results'] = $this->holidayRepository->all($request);
            $data['request'] = $request;
            $data['holidayRepo'] = $this->holidayRepository;
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['add_more_button'] = true;
            $data['provinceList'] = MstFederalHierarchy::where('federal_level_type_id', 2)
                ->select('id', 'code', $name.' '.'as name')
                ->where(['status' => true, 'client_id' => 1, 'is_deleted' => false])
                ->get();

            $data['districtList'] = MstFederalHierarchy::where('federal_level_type_id', 3)
                ->select('id', 'code', $name.' '.'as name')
                ->where(['status' => true, 'client_id' => 1, 'is_deleted' => false])
                ->get();

            $data['valleyDistrictList'] = MstFederalHierarchy::whereIn('federal_level_type_id', [4, 5, 6, 7])
                ->select('id', 'code', $name.' '.'as name')
                ->where(['status' => true, 'client_id' => 1, 'is_deleted' => false])
                ->get();

            $data['localBodyList'] = MstFederalHierarchy::whereIn('federal_level_type_id', [4, 5, 6, 7])
                ->select('id', 'code', $name.' '.'as name')
                ->where(['status' => true, 'client_id' => 1, 'is_deleted' => false])
                ->get();

            $data['holidayTypes'] = [
                'all' => trans('calendar.all'),
                'province_only' => trans('calendar.province_only'),
                'valley_only' => trans('calendar.valley_only'),
                'district_only' => trans('calendar.district_only'),
                'local_body_only' => trans('calendar.local_body_only'),
                'ward_only' => trans('calendar.ward_only'),
            ];

            return view('backend.calendar.holiday.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {

            $newArr['name_np'] = $request->name_np;
            $newArr['name_en'] = $request->name_en;
            $newArr['holiday_type'] = $request->holiday_type ?? 'local_body_only';
            $newArr['date_np'] = $request->date_np;
            $newArr['description'] = $request->description;
            $dateArr = explode('-', $newArr['date_np']);
            $newArr['date_en'] = count($dateArr) > 0 ? $this->dateConverter->nep_to_eng($dateArr[0], $dateArr[1], $dateArr[2]) : '';
            $newArr['status'] = $request->status;

            DB::beginTransaction();

            $create = CalendarHoliday::create($newArr);

            if ($create && $create->holiday_type != 'all') {
                // store holiday days

                // for holiday type province only
                if ($create->holiday_type == 'province_only') {
                    $provinceArr = $request->province_code;
                    if (count($provinceArr) > 0) {
                        foreach ($provinceArr as $item) {
                            if ($item) {
                                $this->storeHolidayDays($create->id, $item);
                            }
                        }
                    }
                } elseif ($create->holiday_type == 'district_only') { // for holiday type district only
                    $districtArr = $request->district_code;
                    if (count($districtArr) > 0) {
                        foreach ($districtArr as $item) {
                            if ($item) {
                                $this->storeHolidayDays($create->id, $item);
                            }
                        }
                    }
                } elseif ($create->holiday_type == 'valley_only') { // for holiday type valley only
                    $districtArr = ['306', '307', '308'];
                    if (count($districtArr) > 0) {
                        foreach ($districtArr as $item) {
                            if ($item) {
                                $this->storeHolidayDays($create->id, $item);
                            }
                        }
                    }
                } elseif ($create->holiday_type == 'local_body_only') { // for holiday type local body only
                    $localBodyArr = $request->local_body_code;
                    if (is_null($localBodyArr)) {
                        $this->storeHolidayDays($create->id, userInfo()->client_id);
                    } else {

                        if (count($localBodyArr) > 0) {
                            foreach ($localBodyArr as $item) {
                                if ($item) {
                                    $this->storeHolidayDays($create->id, $item);
                                }
                            }
                        }
                    }
                } else { // for holiday type school only
                    if (userInfo()->is_school_user == false) {
                        $school = $request->school_code;
                    } else {
                        $schoolInfo = School::query()->find(userInfo()->school_id);
                        $school = $schoolInfo->code;
                    }
                    if ($school) {
                        $this->storeHolidayDays($create->id, $school);
                    }
                }
            }

            DB::commit();

            if ($request->addMore == 'true') {
                session()->flash('addMore', 'Add More');
            }

            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function storeHolidayDays($calHolidayId, $govBodyId)
    {
        $hDays['calendar_holiday_id'] = $calHolidayId;
        $hDays['gov_body_id'] = $govBodyId;
        $create = CalendarHolidayDay::create($hDays);
        if ($create) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $existedHoliday = CalendarHoliday::query()->find($id);
            if (! $existedHoliday) {
                return back();
            }
            DB::beginTransaction();
            $newArr['name_np'] = $request->name_np;
            $newArr['name_en'] = $request->name_en;
            $newArr['holiday_type'] = $request->holiday_type;
            $newArr['date_np'] = $request->date_np;
            $dateArr = explode('-', $newArr['date_np']);
            $newArr['date_en'] = count($dateArr) > 0 ?
                $this->dateConverter->nep_to_eng($dateArr[0], $dateArr[1], $dateArr[2]) : '';
            $newArr['status'] = $request->status;
            $update = $existedHoliday->fill($newArr)->save();
            if ($update && $existedHoliday->holiday_type != 'all') {
                // store holiday days

                // for holiday type province only
                if ($request->holiday_type == 'province_only') {
                    $provinceArr = $request->province_code;
                    if (count($provinceArr) > 0) {
                        $existedData = CalendarHolidayDay::where('calendar_holiday_id', $existedHoliday->id)->get();
                        if (count($existedData) > 0) {
                            foreach ($existedData as $data) {
                                $data->delete();
                            }
                        }
                        foreach ($provinceArr as $key => $item) {
                            if ($item != null) {
                                $res = $this->storeHolidayDays($existedHoliday->id, $item);
                            }
                        }
                    }
                } elseif ($request->holiday_type == 'district_only') { // for holiday type district only
                    $districtArr = $request->district_code;
                    if (count($districtArr) > 0) {
                        $existedData = CalendarHolidayDay::where('calendar_holiday_id', $existedHoliday->id)->get();
                        if (count($existedData) > 0) {
                            foreach ($existedData as $data) {
                                $data->delete();
                            }
                        }
                        foreach ($districtArr as $item) {
                            if ($item) {
                                $this->storeHolidayDays($existedHoliday->id, $item);
                            }
                        }
                    }
                } elseif ($request->holiday_type == 'valley_only') { // for holiday type valley only
                    $districtArr = ['306', '307', '308'];
                    if (count($districtArr) > 0) {
                        $existedData = CalendarHolidayDay::where('calendar_holiday_id', $existedHoliday->id)->get();
                        if (count($existedData) > 0) {
                            foreach ($existedData as $data) {
                                $data->delete();
                            }
                        }
                        foreach ($districtArr as $item) {
                            if ($item) {
                                $this->storeHolidayDays($existedHoliday->id, $item);
                            }
                        }
                    }

                } elseif ($request->holiday_type == 'local_body_only') { // for holiday type local body only
                    $localBodyArr = $request->local_body_code;
                    if (count($localBodyArr) > 0) {
                        $existedData = CalendarHolidayDay::where('calendar_holiday_id', $existedHoliday->id)->get();
                        if (count($existedData) > 0) {
                            foreach ($existedData as $data) {
                                $data->delete();
                            }
                        }
                        foreach ($localBodyArr as $item) {
                            if ($item) {
                                $this->storeHolidayDays($existedHoliday->id, $item);
                            }
                        }
                    }

                } else { // for holiday type school only
                    $school = $request->school_code;
                    if ($school) {
                        $existedData = CalendarHolidayDay::where('calendar_holiday_id', $existedHoliday->id)->get();
                        if (count($existedData) > 0) {
                            foreach ($existedData as $data) {
                                $data->delete();
                            }
                        }
                        $this->storeHolidayDays($existedHoliday->id, $school);
                    }
                }
            }
            DB::commit();

            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();

        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        try {
            $value = $this->model->find($id);
            if ($value) {
                $holidayDays = CalendarHolidayDay::where('calendar_holiday_id', $id)->first();
                if ($holidayDays) {
                    session()->flash('warning', Lang::get('message.flash_messages.warningMessage'));

                    return back();
                }
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
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function status($id): RedirectResponse
    {
        try {
            $id = (int) $id;
            $role = $this->model->find($id);
            if ($role->status == 0) {
                DB::beginTransaction();
                $this->model->status($role->id, 1);
                // insert log
                $this->logsRepository->insertLog($role->id, $this->menuId, 5);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($role->status == 1) {
                DB::beginTransaction();
                $this->model->status($role->id, 0);
                // insert log
                $this->logsRepository->insertLog($role->id, $this->menuId, 6);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusInactiveMessage'));
            }

            return back();

        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
