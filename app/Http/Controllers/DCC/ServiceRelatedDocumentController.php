<?php

namespace App\Http\Controllers\DCC;

use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\MstDepartment;
use App\Models\Dcc\Service;
use App\Models\Dcc\ServiceBodyType;
use App\Models\Dcc\ServiceRelatedDocument;
use App\Repositories\CommonRepository;
use App\Repositories\DCC\ServiceRelatedDocumentRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ServiceRelatedDocumentController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private ServiceRelatedDocumentRepository $serviceRelated;

    private int $menuId = 15;

    public function __construct(ServiceRelatedDocument $service, LogsRepository $logsRepository, ServiceRelatedDocumentRepository $serviceRelated)
    {
        parent::__construct();
        $this->model = new CommonRepository($service);
        $this->logsRepository = $logsRepository;
        $this->serviceRelated = $serviceRelated;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        try {
            $data['load_css'] = [
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'plugins/select2/js/select2.full.min.js',

            ];

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['serviceType'] = ServiceBodyType::select('id', $name.' '.'as name');

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['services'] = Service::select('id', $name.' '.'as name');

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['department'] = MstDepartment::select('id', $name.' '.'as name');

            $data['page_url'] = 'servicesRelatedDocument';
            $data['page_route'] = 'servicesRelatedDocument';

            $data['page_title'] = getLan() == 'np' ? 'सेवा सम्बन्धित कागजात' : 'Service Related Document';

            $data['results'] = $this->serviceRelated->getAllServiceRelated($request);

            $data['request'] = $request;
            //show view button
            $data['show_button'] = true;
            $data['is_province'] = true;

            return view('backend.dcc.serviceRelatedDocument.index', $data);

        } catch (\Exception $e) {
            dd($e);
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
            dd($e);
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
}
