<?php

namespace App\Http\Controllers\MasterSettings;

use App\Http\Controllers\BaseController;
use App\Models\Calendar\MstFiscalYear;
use App\Models\User;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class FiscalYearController extends BaseController
{
    protected CommonRepository $model;

    protected CommonRepository $childModel;

    protected LogsRepository $logsRepository;

    private int $menuId = 44;

    public function __construct(
        MstFiscalYear $mstFiscalYear,
        User $childModel,
        LogsRepository $logsRepository
    ) {
        parent::__construct();
        // set the model
        $this->model = new CommonRepository($mstFiscalYear);
        $this->childModel = new CommonRepository($childModel);
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {
        try {

            $data['page_url'] = 'fiscalYears';
            $data['page_route'] = 'fiscalYears';
            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_app.min.js',
                'js/fiscalYear.js',
                'js/dateConverter.js',
            ];

            $data['page_title'] = getLan() == 'np' ? 'आर्थिक वर्ष' : 'Fiscal Year';

            $data['results'] = $this->model->getFyData($request);
            $data['request'] = $request;

            $data['show_button'] = true;

            return view('backend.masterSettings.fiscalYear.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {

            DB::beginTransaction();
            $data = $request->all();
            // dd($data);
            $create = $this->model->create($data);

            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 44);
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
                ->insertLog($role->id, $this->menuId, 25);
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
                $this->logsRepository->insertLog($value->id, $this->menuId, 44);
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
}
