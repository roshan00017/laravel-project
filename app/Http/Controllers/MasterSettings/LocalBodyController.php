<?php

namespace App\Http\Controllers\MasterSettings;

use App\Http\Controllers\BaseController;
use App\Http\Requests\LocalBodyRequest;
use App\Models\MasterSettings\District;
use App\Models\MasterSettings\LocalBody;
use App\Models\MasterSettings\LocalBodyType;
use App\Models\MasterSettings\Province;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\LocalBodyRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class LocalBodyController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    protected LocalBodyRepository $localBodyRepository;

    private int $menuId = 16;

    public function __construct(LocalBody $localBody, LogsRepository $logsRepository, LocalBodyRepository $localBodyRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($localBody);
        $this->logsRepository = $logsRepository;
        $this->localBodyRepository = $localBodyRepository;
    }

public function index(Request $request)
{
    try {
        $data['provinceList'] = Province::all();
        $data['districtList'] = District::all();
        $data['localBodyList'] = LocalBody::all();
        $data['localBodyTypeList'] = LocalBodyType::all();
        $data['results'] = $this->localBodyRepository->getAllLocalBodies($request);
        $data['request'] = $request;
        $data['show_button'] = true;
        $data['page_url'] = '/localBodies';
        $data['page_route'] = ' /localBodies';
        $data['page_title'] = getLan() == 'np' ? 'स्थानीय तह' : 'Local Bodies';
        $data['load_css'] = [
            'plugins/select2/css/select2.css',
        ];
        $data['load_js'] = [
            'plugins/select2/js/select2.full.min.js',
            'js/custom_app.min.js',
            'js/selector.min.js',
            'js/localBodyHierarchy.js',
        ];

        return view('backend.masterSettings.localBodies.index', $data);
    } catch (\Exception $e) {
        Session::flash('server_error', Lang::get('message.commons.technicalError'));

        return back();
    }
}

    public function store(LocalBodyRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $create = $this->model->create($data);
            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 1);
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

    public function update(LocalBodyRequest $request, int $id): RedirectResponse
    {
        try {
            $check = LocalBody::find($id);
            DB::beginTransaction();
            $data = $request->all();
            $this->model->update($data, $id);
            // insert log
            $this->logsRepository->insertLog($check->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    //update status from user request
    public function status($id)
    {
        try {
            $id = (int) $id;
            $value = $this->model->find($id);
            if ($value->status == 0) {
                DB::beginTransaction();
                $this->model->status($value->id, 1);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 6);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($value->status == 1) {
                DB::beginTransaction();
                $this->model->status($value->id, 0);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 7);
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
