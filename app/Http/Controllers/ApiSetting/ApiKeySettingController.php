<?php

namespace App\Http\Controllers\ApiSetting;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ApiSettingRequest;
use App\Models\ApiSetting\ApiKey;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ApiKeySettingController extends BaseController
{
    protected CommonRepository $model;

    private int $menuId = 43;

    private LogsRepository $logsRepository;

    public function __construct(ApiKey $apiSetting, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($apiSetting);
        $this->logsRepository = $logsRepository;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): Response
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
            $data['page_url'] = 'apiKey';
            $data['page_route'] = 'apiKey';
            $data['load_js'] = [
                'js/custom_app.min.js',
                'js/check_data.js',

            ];
            $data['page_title'] = getLan() == 'np' ? 'API Key सेटिङ' : 'Api Key Setting';
            $data['results'] = $this->model->getApiKeyData($request);
            $data['request'] = $request;

            return view('backend.apiSetting.index', $data);
        } catch (\Exception $e) {
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
    public function store(ApiSettingRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data['name'] = Str::lower($request->name);
            $data['key'] = ApiKey::generate();
            $data['client_id'] = setClientId($request->client_id);
            $data['created_by'] = auth()->user()->id;
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

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        try {
            $value = ApiKey::find($id);
            DB::beginTransaction();
            $data = $request->all();
            $data['name'] = Str::lower($request->name);
            $data['updated_by'] = auth()->user()->id;
            $this->model->update($data, $id);
            // insert log
            $this->logsRepository->insertLog($value->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /* check existing api app name  */
    public function check_api_app_name()
    {
        $app_name = Str::lower($_POST['app_name']);
        $value = ApiKey::where('name', '=', $app_name)->count();
        if ($value > 0) {
            return response()->json([
                'status' => true,
                'message' => Lang::get('message.flash_messages.already_exist_ap_name'),
            ]);
        }
    }
}
