<?php

namespace App\Http\Controllers\SystemSettings;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SystemSetting\LoginSettingRequest;
use App\Models\SystemSetting\AppSetting;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class LoginSettingController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 13;

    public function __construct(AppSetting $setting, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($setting);
        $this->logsRepository = $logsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['page_url'] = 'systemSetting/loginSetting';
            $data['page_route'] = 'loginSetting';
            $data['file_upload_url'] = 'systemSetting/uploadSystemSettingFile';
            $data['status_url'] = 'systemSetting/updateStatus';
            $data['result'] = AppSetting::first();
            $data['captcha_column_name'] = 'login_captcha_required';
            $data['forgot_password_column_name'] = 'forget_password_required';
            $data['script_js'] = "$(function(){
             $(document).ready(function() {
             $('.statusModal').on('click', function(e) {
                const id = $(this).data('id');
                $('#column_name').val(id);
                });
              });
            })";

            return view('backend.systemSetting.loginSetting.index', $data);
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
    public function update(LoginSettingRequest $request, int $id): RedirectResponse
    {
        try {
            $loginSetting = $this->model->find($id);
            DB::beginTransaction();
            $this->model->update($request->all(), $id);
            // insert log
            $this->logsRepository->insertLog($loginSetting->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    //* update  status  form user request */
    public function updateStatus($id, Request $request): RedirectResponse
    {
        try {
            $id = (int) $id;
            $value = $this->model->find($id);
            if ($request->column_name1 != null) {
                AppSetting::query()
                    ->where('id', $value->id)
                    ->update([$request->column_name => $request->status, $request->column_name1 => $request->column1_value]);
            } else {
                AppSetting::query()
                    ->where('id', $value->id)
                    ->update([$request->column_name => $request->status]);
            }
            // insert log
            $this->logsRepository->insertLog($value->id, $this->menuId, 2);
            session()->flash('success', Lang::get('message.commons.statusUpdate'));

            return back();
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
