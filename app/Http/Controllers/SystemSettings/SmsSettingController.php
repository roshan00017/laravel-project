<?php

namespace App\Http\Controllers\SystemSettings;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SystemSetting\SmsSettingRequest;
use App\Models\SystemSetting\SmsSetting;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class SmsSettingController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 39;

    public function __construct(SmsSetting $setting, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($setting);
        $this->logsRepository = $logsRepository;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data['page_url'] = 'systemSetting/smsSetting';
            $data['page_route'] = 'smsSetting';
            $data['results'] = $this->model->getSmsSetting($request);
            $data['page_title'] = getLan() == 'np' ? 'SMS सेटिङ' : 'SMS Setting';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/selector.min.js',
                'js/systemSettings/smsSetting.js',
            ];
            //check add client info
            $data['clientSmsInfo'] = SmsSetting::query()->where('client_id', '=', userInfo()->client_id)->count();

            return view('backend.systemSetting.smsSetting.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SmsSettingRequest $request, int $id): RedirectResponse
    {
        try {
            $check = SmsSetting::find($id);
            DB::beginTransaction();
            $data = $request->all();
            $this->model->update($data, $check->id);
            // insert log
            $this->logsRepository->insertLog($check->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SmsSettingRequest $request): RedirectResponse
    {
        try {

            $data = $request->all();
            //set client id from client
            if (is_null($request->client_id)) {
                $data['client_id'] = userInfo()->client_id;
            }
            DB::beginTransaction();

            $create = $this->model->create($data);

            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 1);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    //update status from user request
    public function status($id): RedirectResponse
    {
        try {
            $id = (int) $id;
            $value = $this->model->find($id);
            if ($value->status == 0) {
                DB::beginTransaction();
                $this->model->status($value->id, 1);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 5);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($value->status == 1) {
                DB::beginTransaction();
                $this->model->status($value->id, 0);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 6);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusInactiveMessage'));
            }

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
