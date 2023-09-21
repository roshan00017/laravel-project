<?php

namespace App\Http\Controllers\BasicDetails;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Models\BasicDetails\DcStatus;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class StatusController extends Controller
{
    protected CommonRepository $model;

    protected CommonRepository $childModel;

    protected LogsRepository $logsRepository;

    private int $menuId = 27;

    public function __construct(DcStatus $status,
        User $childModel,
        LogsRepository $logsRepository
    ) {
        // parent::__construct();
        // set the model
        $this->model = new CommonRepository($status);
        $this->childModel = new CommonRepository($childModel);
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {
        try {

            $data['page_url'] = 'basicDetails/status';
            $data['page_route'] = 'status';

            $data['page_title'] = getLan() == 'np' ? 'स्थिति' : 'Status';
            $data['results'] = $this->model->all();
            $data['load_js'] = [
                'js/custom_app.min.js',

            ];

            return view('backend.basicDetails.dcStatus.index', $data);
        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(StatusRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();
            $data = $request->all();

            $create = $this->model->create($data);

            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 17);
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
            $data['updated_by'] = userInfo()->id;
            $this->model->update($data, $id);
            // insert log
            $this->logsRepository
                ->insertLog($role->id, $this->menuId, 17);
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
                $this->logsRepository->insertLog($value->id, $this->menuId, 17);
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
