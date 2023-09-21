<?php

namespace App\Http\Controllers\Calendar;

use App\Helpers\DateConverter;
use App\Http\Controllers\BaseController;
use App\Models\Calendar\Calendar;
use App\Models\Calendar\CalendarYear;
use App\Repositories\CalendarRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CalendarController extends BaseController
{
    private CalendarRepository $calendarRepository;

    private DateConverter $dateConverter;

    private Calendar $calendar;

    public function __construct(CalendarRepository $calendarRepository, DateConverter $dateConverter,
        Calendar $calendar)
    {
        parent::__construct();
        $this->calendarRepository = $calendarRepository;
        $this->dateConverter = $dateConverter;
        $this->calendar = $calendar;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            //
            $data['page_route'] = 'calendarManagement';
            $data['page_url'] = 'calendarManagement';
            $data['load_css'] = [
                'plugins/select2/css/select2.css',
            ];
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/check_data.min.js',
                'js/image_validation.min.js',
                'js/location.min.js',
                'js/dataSubmit.min.js',
            ];
            $data['page_title'] = getLan() == 'np' ? 'पात्रो' : 'Calendar';
            $data['results'] = $this->calendarRepository->all($request);
            $data['yearList'] = CalendarYear::all();
            $data['monthList'] = $this->calendarRepository->months();
            $data['weekDayList'] = $this->calendarRepository->weekDays();
            $data['request'] = $request;

            return view('backend.calendar.index', $data);
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            DB::beginTransaction();
            $data = $request->all();
            $weekDayArr = $request->week_day_code;
            $dayArr = $request->day;

            if (count($weekDayArr) > 0 && count($dayArr) > 0) {
                foreach ($weekDayArr as $key => $weekDay) {
                    $newData['fy_code'] = $data['fy_code'];
                    $newData['month_code'] = $data['month_code'];
                    $newData['week_day_code'] = $weekDay;
                    $newData['day'] = $dayArr[$key];
                    $newData['full_date'] = $data['fy_code'].'-'.$data['month_code'].'-'.$dayArr[$key];
                    $newData['full_date_en'] = $this->dateConverter->nep_to_eng((int) $data['fy_code'], (int) $data['month_code'], (int) $dayArr[$key]);

                    $existedData = $this->calendarRepository->getDay($data['fy_code'], $data['month_code'], $dayArr[$key]);
                    if (! $existedData) {
                        $create = Calendar::create($newData);
                    }
                }
            }
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();

        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $calData = Calendar::find($id);
            $data = $request->all();
            if ($calData) {
                DB::beginTransaction();
                $calData->fy_code = $data['fy_code'];
                $calData->month_code = $data['month_code'];
                $calData->week_day_code = $data['week_day_code'];
                $calData->day = $data['day'];
                $calData->full_date = $data['fy_code'].'-'.$data['month_code'].'-'.$data['day'];
                $calData->full_date_en = $this->dateConverter->nep_to_eng((int) $data['fy_code'], (int) $data['month_code'], (int) $data['day']);
                $calData->save();
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

                return back();
            } else {
                session()->flash('warning', Lang::get('message.flash_messages.warningMessage'));

                return back();
            }

        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $value = $this->calendar->find($id);

            if ($value) {
                DB::beginTransaction();
                $value->delete();
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
}
