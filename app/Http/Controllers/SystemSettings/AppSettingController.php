<?php

namespace App\Http\Controllers\SystemSettings;

use App\Helpers\FileUploadLibraryHelper;
use App\Http\Controllers\BaseController;
use App\Http\Requests\SystemSetting\AppSettingRequest;
use App\Http\Requests\UploadFileRequest;
use App\Models\SystemSetting\AppSetting;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class AppSettingController extends BaseController
{
    private int $fileHeight = 128;

    private string $filePath = 'uploads/files';

    private int $fileWidth = 128;

    private int $logMenu = 12;

    private AppSetting $model;

    private CommonRepository $common;

    private int $menuId = 11;

    private LogsRepository $logsRepository;

    public function __construct(AppSetting $model, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = $model;
        $this->common = new CommonRepository($model);
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
            $data['load_js'] = [
                'js/image_validation.js',
            ];
            $data['page_url'] = 'systemSetting/appSetting';
            $data['page_route'] = 'appSetting';
            $data['file_upload_url'] = 'systemSetting/uploadSystemSettingFile';
            $data['result'] = AppSetting::first();

            return view('backend.systemSetting.appSetting.index', $data);
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
    public function update(AppSettingRequest $request, int $id): RedirectResponse
    {
        try {
            //check all data from request form
            $data = $request->all();
            //check existing value
            $appSetting = $this->model->find($id);
            //check image form request
            if (! empty($request->file('app_logo'))) {
                $data['app_logo'] = FileUploadLibraryHelper::setFileUploadName($request->app_logo, $request->app_name);
                $imageSuccess = true;
            }
            DB::beginTransaction();
            $update = $this->common->update($data, $id);
            // insert log
            $this->logsRepository->insertLog($appSetting->id, $this->menuId, 2);
            DB::commit();
            if ($update) {
                if ($appSetting->image != null) {
                    FileUploadLibraryHelper::deleteExistingFile($appSetting->app_logo, $this->filePath);
                }
                if (isset($imageSuccess)) {
                    FileUploadLibraryHelper::setFileUploadPath($request->app_logo, $data['app_logo'], $this->filePath, $this->fileWidth, $this->fileHeight);
                }
            }
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /* upload  file only */
    public function uploadFile($id, UploadFileRequest $request)
    {
        try {
            /* check log menu */
            if ($request->logMenu != null) {
                $logMenu = $request->logMenu;
            } else {
                $logMenu = $this->logMenu;
            }

            return FileUploadLibraryHelper::updateUploadedFile($this->model, $id, $request->column_name, $request->update_file, $request->file_title, $this->filePath, $logMenu);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /* delete existing file */
    public function destroy($id, Request $request): RedirectResponse
    {
        try {
            return FileUploadLibraryHelper::deleteUploadedFile($this->model, $id, $request->column_name, $this->filePath);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
