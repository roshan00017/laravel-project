<?php

namespace App\Http\Controllers\BasicDetails;

use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\MstDocumentType;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DocumentTypeController extends BaseController
{
    protected CommonRepository $model;

    protected CommonRepository $childModel;

    protected LogsRepository $logsRepository;

    private int $menuId = 30;

    public function __construct(
        MstDocumentType $fileType,
        LogsRepository $logsRepository
    ) {
        parent::__construct();
        // set the model
        $this->model = new CommonRepository($fileType);
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['page_url'] = 'basicDetails/documentTypes';
            $data['page_route'] = 'documentTypes';

            $data['page_title'] = getLan() == 'np' ? '
            फाइल प्रकार' : 'File Type';
            $data['request'] = $request;
            $data['results'] = $this->model->all($request);
            $data['load_js'] = [
                'js/custom_app.min.js',
            ];

            $name = getLan() == 'np' ? 'name_np' : 'name_en';

            return view('backend.basicDetails.DocumentType.index', $data);
        } catch (\Throwable $th) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();
            $data['created_by'] = userInfo()->id;

            DB::beginTransaction();

            $create = $this->model->create($data);

            // insert log
            $this->logsRepository
                ->insertLog($create->id, $this->menuId, 1);
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
            $value = $this->model->find($id);
            if ($value->status == 0) {
                DB::beginTransaction();
                $this->model->status($value->id, 1);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 5);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($value->status == 1) {
                DB::beginTransaction();
                $this->model->status($value->id, 0);
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
                $this->logsRepository->insertLog($value->id, $this->menuId, 18);
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
