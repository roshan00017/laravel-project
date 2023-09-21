<?php

namespace App\Http\Controllers\DCC;

use App\Http\Controllers\BaseController;
use App\Models\Dcc\ServiceBodyType;
use App\Models\Dcc\ServiceDepartment;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Hashids\Hashids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class ServiceDepartmentController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 15;

    public function __construct(ServiceDepartment $ServiceDepartment, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($ServiceDepartment);
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
            $data['page_url'] = 'serviceDepartment';
            $data['page_route'] = 'serviceDepartment';
            $data['load_js'] = [
                'js/custom_app.min.js',

            ];
            $data['page_title'] = getLan() == 'np' ? 'सेवा विभाग' : 'Service Department';
            $data['results'] = $this->model->getData($request);
            $data['request'] = $request;
            //show view button
            $data['show_button'] = true;

            // $name = getLan() == 'np' ? 'name_np' : 'name_en';
            // $data['serviceType'] = ServiceBodyType::select('id', $name.' '.'as name');
            $data['load_css'] = [
                'plugins/select2/css/select2.css',
            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
            ];

            return view('backend.dcc.serviceDepartment.index', $data);

            // $data['is_province'] = true;

            return view('backend.masterSetting.service.index', $data);
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
            // $checkData = $this->model->findLastRecord('code');
            // $data['code'] = $checkData[0]->code + 1;
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

    //update status from user request
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

    public function show($id)
    {

        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            // $data['index_page_url'] = 'dcDispatchBook';
            // $name = getLan() == 'np' ? 'name_np' : 'name_en';
            // $data['statusList'] = DcStatus::select('id', $name . ' ' . 'as name');
            if ($hashIdValue) {
                $value = ServiceDepartment::query()->find($hashIdValue[0]);
                // Assuming you have a User model and a users table in your database
                $data['serviceDepartment'] = ServiceDepartment::find($value->id);
                if ($data) {

                    $data['page_title'] = getLan() == 'np' ? 'सेवा विभाग' : 'Service Department';
                    $data['page_url'] = 'serviceDepartment';
                    $data['page_route'] = 'serviceDepartment';
                    // User found, display the details

                    return view('backend.dcc.serviceDepartment.show', $data);
                }

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcDispatchBook');
            }

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
