<?php

namespace App\Http\Controllers\EDMIS;

use App\Http\Controllers\Controller;
use App\Models\BasicDetails\Bank;
use App\Models\EDMIS\ConsumerCommittee;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\ConsumerCommitteeRepository;
use App\Repositories\LogsRepository;
use Hashids\Hashids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class ConsumerCommitteeController extends Controller
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private ConsumerCommitteeRepository $ConsumerCommitteeRepository;

    private int $menuId = 9;

    public function __construct(ConsumerCommittee $consumerCommittee, LogsRepository $logsRepository, ConsumerCommitteeRepository $ConsumerCommitteeRepository)
    {
        $this->model = new CommonRepository($consumerCommittee);
        $this->logsRepository = $logsRepository;
        $this->ConsumerCommitteeRepository = $ConsumerCommitteeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data['page_url'] = '/consumerCommittee';
            $data['consumerCommitteeList'] = ConsumerCommittee::all();
            $data['page_route'] = 'consumerCommittee';
            $data['results'] = $this->model->all();
            $data['show_button'] = true;
            $data['page_title'] = getLan() == 'np' ? 'उपभोक्ता समिति' : 'Consumer Committee';
            $data['request'] = $request;
            $data['custom_print'] = true;

            $data['load_css'] = [
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'js/form.js',
                'js/custom_app.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_search.js',
                'js/dateConverter.js',
                'js/address.js',
            ];
            $data['results'] = $this->ConsumerCommitteeRepository->getAllConsumer($request);

            return view('backend.edmis.consumerCommittee.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function create()
    {
        $data['bankList'] = Bank::all();
        $data['page_url'] = '/consumerCommittee';
        $data['page_route'] = 'consumerCommittee';
        $data['cancel_button'] = true;
        $data['page_title'] = getLan() == 'np' ? 'उपभोक्ता समिति' : 'Consumer Committee';
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
            'plugins/datepicker/english/english-datepicker.min.js',
            'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
            'js/custom_app.min.js',
            'js/custom_search.js',
            'js/consumerCommittee.js',
            'js/dateConverter.js',
            'js/address.js',
        ];
        $data['index_page_url'] = '/consumerCommittee';

        return view('backend.edmis.consumerCommittee.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();
            DB::beginTransaction();
            $create = $this->model->create($data);

            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 1);

            DB::commit();

            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return redirect(url('/consumerCommittee'));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['bankList'] = Bank::all();
                $data['value'] = ConsumerCommittee::query()->find($hashIdValue[0]);
                $data['page_url'] = '/consumerCommittee';
                $data['page_route'] = 'consumerCommittee';
                $data['show_button'] = true;
                $data['page_title'] = getLan() == 'np' ? 'उपभोक्ता समिति' : 'Consumer Committee';
                $data['request'] = $request;
                $data['custom_print'] = true;
                $data['cancel_button'] = true;
                $data['load_css'] = [
                    'plugins/select2/css/select2.css',
                    'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                    'plugins/datepicker/english/english-datepicker.css',
                ];
                $data['load_js'] = [
                    'js/form.js',
                    'js/custom_app.min.js',
                    'plugins/select2/js/select2.full.min.js',
                    'plugins/select2/js/select2.full.min.js',
                    'plugins/input-mask/jquery/inputmask.min.js',
                    'plugins/input-mask/jquery/date_extension.min.js',
                    'plugins/datepicker/english/english-datepicker.min.js',
                    'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                    'js/consumerCommittee.js',
                    'js/custom_search.js',
                    'js/dateConverter.js',
                    'js/address.js',
                ];
                $data['index_page_url'] = '/consumerCommittee';

                return view('backend.edmis.consumerCommittee.edit', $data);
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('consumerCommittee');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function show(Request $request, $id)
    {

        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = ConsumerCommittee::query()->find($hashIdValue[0]);

                if ($hashIdValue) {
                    $data['value'] = ConsumerCommittee::query()->find($hashIdValue[0]);
                    $data['page_url'] = '/consumerCommittee';
                    $data['page_route'] = 'consumerCommittee';
                    $data['show_button'] = true;
                    $data['page_title'] = getLan() == 'np' ? 'उपभोक्ता समिति' : 'Consumer Committee';
                    $data['request'] = $request;
                    $data['custom_print'] = true;

                    $data['load_js'] = [
                        'js/form.js',
                        'js/custom_app.min.js',
                        'plugins/select2/js/select2.full.min.js',
                        'plugins/select2/js/select2.full.min.js',
                        'plugins/input-mask/jquery/inputmask.min.js',
                        'plugins/input-mask/jquery/date_extension.min.js',
                        'plugins/datepicker/english/english-datepicker.min.js',
                        'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                        'js/consumerCommittee.js',
                        'js/dateConverter.js',
                        'js/address.js',
                    ];
                    $data['index_page_url'] = '/consumerCommittee';
                }

                return view('backend.edmis.consumerCommittee.show', $data);
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('consumerCommittee');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $value = $this->model->find($id);

            if ($value) {
                $data = $request->all();
                $data['updated_by'] = userInfo()->id;
                DB::beginTransaction();

                $value->update($data);

                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return redirect(url('consumerCommittee'));
        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect(url('consumerCommittee'));
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
