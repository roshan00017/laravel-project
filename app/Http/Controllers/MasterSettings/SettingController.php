<?php

namespace App\Http\Controllers\MasterSettings;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SettingRequest;
use App\Models\MasterSettings\MasterSetting;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class SettingController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 46;

    public function __construct(MasterSetting $model, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($model);
        $this->logsRepository = $logsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if (userInfo()->client_id != null) {
                $data['client_id'] = userInfo()->client_id;
            }
            $data['page_url'] = '/masterSettings/settings';
            $data['page_route'] = 'settings';
            $data['page_title'] = getLan() == 'np' ? 'सेटिङ' : 'Setting';
            $data['request'] = $request;
            $data['results'] = $this->model->all($request);

            return view('backend.masterSettings.setting.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(SettingRequest $request): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['created_by'] = userInfo()->id;

            DB::beginTransaction();

            $create = $this->model->create($data);

            // insert log
            $this->logsRepository
                ->insertLog($create->id, $this->menuId, 1);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $value = $this->model->find($id);
            if ($value) {
                $data = $request->all();
                $data['updated_by'] = auth()->user()->id;
                $this->model->update($data, $id);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 2);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return back();
        } catch (\Exception $e) {
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
                $this->model->delete($id);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 18);
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
