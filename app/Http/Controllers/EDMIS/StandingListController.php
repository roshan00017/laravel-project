<?php

namespace App\Http\Controllers\EDMIS;

use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\OrganizationTypes;
use App\Models\EDMIS\StandingList;
use App\Models\EDMIS\StandingListType;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\StandingListRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class StandingListController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    protected StandingListRepository $standingListRepository;

    private int $menuId = 24;

    public function __construct(
        StandingListRepository $standingListRepository,
        LogsRepository $logsRepository
    ) {
        parent::__construct();
        $this->model = new CommonRepository(new StandingList());
        $this->logsRepository = $logsRepository;
        $this->standingListRepository = $standingListRepository;
    }

    public function index(Request $request)
    {
        try {
            $currentFyId = currentFy()->id;
            $data['currentFyId'] = $currentFyId;
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['organizations'] = OrganizationTypes::pluck($name, 'id');
            $data['standingtypelists'] = StandingListType::pluck($name, 'id');
            $data['standingLists'] = StandingList::all();
            $data['page_url'] = 'standinglist';
            $data['page_route'] = 'standinglist';
            $data['load_js'] = [
                'js/custom_app.min.js',
            ];
            $data['page_title'] = getLan() == 'np' ? 'सुचिकृत बिवरण' : 'Standing Lists';
            $data['results'] = $this->standingListRepository->getAllStandingList($request);
            $data['request'] = $request;
            $data['show_button'] = true;

            // $name = getLan() == 'np' ? 'name_np' : 'name_en';
            // $data['serviceType'] = ServiceBodyType::select('id', $name.' '.'as name');

            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/holiday.js',
                'js/holidayv2.js',

            ];

            return view('backend.edmis.standingList.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();
            // $checkData = StandingList::query()->orderBy('id', 'desc')->select('code')->first();
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
