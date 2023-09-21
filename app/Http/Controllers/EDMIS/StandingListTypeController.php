<?php

namespace App\Http\Controllers\EDMIS;

use App\Http\Controllers\BaseController;
use App\Models\EDMIS\StandingListType;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class StandingListTypeController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 24;

    public function __construct(StandingListType $standingListType, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($standingListType);
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['standingListTypes'] = StandingListType::all();
            $data['page_url'] = 'standinglisttypes';
            $data['page_route'] = 'standinglisttypes';
            $data['load_js'] = [
                'js/custom_app.min.js',
            ];
            $data['page_title'] = getLan() == 'np' ? 'सुचिकृतकोप्रकार' : 'Standing List Type';
            $data['results'] = $this->model->getData($request);
            $data['request'] = $request;
            $data['show_button'] = true;

            // $name = getLan() == 'np' ? 'name_np' : 'name_en';
            // $data['serviceType'] = ServiceBodyType::select('id', $name.' '.'as name');

            $data['load_css'] = [
                'plugins/select2/css/select2.css',
            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
            ];

            return view('backend.edmis.standingListType.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();
            // $checkData = StandingListType::query()->orderBy('id', 'desc')->select('code')->first();
            // $data['code'] = $checkData->code + 1;
            $data['created_by'] = auth()->user()->id;

            DB::beginTransaction();
            $create = $this->model->create($data);
            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 24);
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

    public function status($id): RedirectResponse
    {
        try {
            $id = (int) $id;
            $user = $this->model->find($id);
            if ($user->status == 0) {
                DB::beginTransaction();
                $this->model->status($user->id, 1);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 44);
                DB::commit();

                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($user->status == 1) {
                DB::beginTransaction();
                $this->model->status($user->id, 0);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 44);
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
