<?php

namespace App\Http\Controllers\BasicDetails;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ComplaintSeverityRequest;
use App\Models\BasicDetails\SeverityType;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class ComplaintSeverityController extends BaseController
{
    protected SeverityType $model;

    protected CommonRepository $common;

    protected LogsRepository $logsRepository;

    private int $menuId = 9;

    public function __construct(SeverityType $model, LogsRepository $logsRepository)
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
    public function index(Request $request)
    {
        try {
            $data['page_url'] = '/basicDetails/complaintSeverity';
            $data['page_route'] = 'complaintSeverity';
            $data['results'] = $this->common->all($request);
            $data['page_title'] = getLan() == 'np' ? 'गम्भीरता प्रकार' : 'Complaint Severity';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.min.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/selector.min.js',
                'js/location.min.js',
            ];

            return view('backend.basicDetails.complaintSeverity.index', $data);
        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(ComplaintSeverityRequest $request): RedirectResponse
    {

        try {
            DB::beginTransaction();
            //check school data exist
            $data = $request->all();
            $create = $this->common->create($data);

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

            $check = SeverityType::find($id);
            DB::beginTransaction();
            $data = $request->all();
            $this->common->update($data, $id);
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
            $value = $this->common->find($id);

            if ($value) {
                DB::beginTransaction();
                $data['deleted_by'] = auth()->user()->id;
                $this->common->update($data, $id);
                $this->common->delete($id);
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
             $value = $this->model->find($id);
             if ($value->status == 0) {
                 DB::beginTransaction();
                 $this->common->status($value->id, 1);
                 // insert log
                 $this->logsRepository->insertLog($value->id, $this->menuId, 5);
                 DB::commit();
                 session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
             } elseif ($value->status == 1) {
                 DB::beginTransaction();
                 $this->common->status($value->id, 0);
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
