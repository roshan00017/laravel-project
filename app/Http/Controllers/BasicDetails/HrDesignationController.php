<?php

namespace App\Http\Controllers\BasicDetails;

use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\HrDesignation;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class HrDesignationController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 17;

    public function __construct(
        HrDesignation $hrDesignation,
        LogsRepository $logsRepository
    ) {
        parent::__construct();
        // set the model
        $this->model = new CommonRepository($hrDesignation);
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['page_url'] = 'basicDetails/hr_designation';
            $data['page_route'] = 'hr_designation';
            $data['results'] = $this->model->all();
            $data['page_title'] = getLan() == 'np' ? 'कर्मचारी पद' : 'Employee Designation';
            $data['show_button'] = true;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',
            ];
            $data['load_js'] = [
                'js/custom_app.min.js',
            ];
            $data['results'] = $this->model->getHrDesignation($request);
            $data['request'] = $request;

            return view('backend.basicDetails.hrDesignation.index', $data);
        } catch (\Exception $e) {

            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

            $create = $this->model->create($data);

            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 25);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $role = $this->model->find($id);
            $data = $request->all();
            // dd($data);
            $data['updated_by'] = userInfo()->id;
            $this->model->update($data, $id);
            // insert log
            $this->logsRepository
                ->insertLog($role->id, $this->menuId, 35);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

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
                $this->logsRepository->insertLog($value->id, $this->menuId, 35);
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
            $user = $this->model->find($id);
            if ($user->status == 0) {
                DB::beginTransaction();
                $this->model->status($user->id, 1);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 35);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($user->status == 1) {
                DB::beginTransaction();
                $this->model->status($user->id, 0);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 35);
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
