<?php

namespace App\Http\Controllers\BasicDetails;

use App\Http\Controllers\BaseController;
use App\Http\Requests\OfficeRequest;
use App\Models\BasicDetails\MstOffice;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class OfficeController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 9;

    public function __construct(MstOffice $model, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($model);
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['page_url'] = 'basicDetails/complaintRelatedDepartment';
            $data['page_route'] = 'complaintRelatedDepartment';
            $data['results'] = $this->model->all($request);
            $data['page_title'] = getLan() == 'np' ? 'गुनासो सम्बन्धित शाखा' : 'Complaint Related Department';
            $data['request'] = $request;
            $data['load_js'] = [
                'js/custom_app.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
            ];
            $data['script_js'] = "$(function(){
                    $('#contact_no').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                    $('#contact_no').inputmask('9999999999', { placeholder: '98xxxxxxxx' });

                })";

            return view('backend.basicDetails.mstOffice.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(OfficeRequest $request): RedirectResponse
    {

        try {

            DB::beginTransaction();
         
            $data = $request->all();
            $data['client_id'] = userInfo()->client_id;
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

    public function update(Request $request, int $id): RedirectResponse
    {
        try {

            $check = MstOffice::find($id);
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

    public function status($id): RedirectResponse
    {
        try {
            $id = (int) $id;
            $user = $this->model->find($id);
            if ($user->status == 0) {
                DB::beginTransaction();
                $this->model->status($user->id, 1);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 5);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($user->status == 1) {
                DB::beginTransaction();
                $this->model->status($user->id, 0);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 5);
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
