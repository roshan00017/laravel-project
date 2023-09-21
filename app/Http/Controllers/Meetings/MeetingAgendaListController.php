<?php

namespace App\Http\Controllers\Meetings;

use App\Http\Controllers\BaseController;
use App\Models\Meetings\Meeting;
use App\Models\Meetings\MeetingAgendaList;
use App\Models\Meetings\MstMeetingStatus;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class MeetingAgendaListController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 9;

    public function __construct(MeetingAgendaList $meetingAgenda, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($meetingAgenda);
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['page_url'] = '/meetingAgendaList';
            $data['page_route'] = 'meetingAgendaList';
            $data['create_menu'] = true;
            $data['add_more_button'] = true;
            $data['meetingList'] = Meeting::query()->where('meeting_status_id', 1)->orderBy('id', 'desc')->get();
            $data['meetingCodeList'] = Meeting::query()->orderBy('id', 'desc')->get();
            $data['meetingStatusList'] = MstMeetingStatus::all();
            $data['page_title'] = getLan() == 'np' ? 'बैठक  एजेन्डा सूची' : 'Meeting Agenda List';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/selector.min.js',

            ];

            if (Session::has('addMore')) {
                $data['script_js'] = "$(function(){
                     $(document).ready(function() {
                        $('#addModal').modal('show');
                    });
                })";
            }

            $data['results'] = $this->model->getAgenda($request);

            return view('backend.meetingManagement.meetingAgendaList.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function create()
    {
        // dd('dd');
        $data['page_url'] = '/meetingAgendaList';
        $data['page_route'] = 'meetingAgendaList';
        $data['meetingList'] = Meeting::query()->where('meeting_status_id', 1)->orderBy('id', 'desc')->get();
        $data['cancel_button'] = true;
        $data['page_title'] = getLan() == 'np' ? 'बैठक  एजेन्डा सूची' : 'Meeting Agenda List';
        $data['load_css'] = [
            'plugins/select2/css/select2.css',

        ];
        $data['load_js'] = [
            'plugins/select2/js/select2.full.min.js',
            'js/selector.min.js',
            // 'js/add_meeting_more.js',
            'js/meeting.js',

        ];
        $data['index_page_url'] = '/meetingAgendaList';

        return view('backend.meetingManagement.meetingAgendaList.create', $data);

    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();
            if (isset($data['addMeetingAgendas'])) {
                $agendaDataArray = $data['addMeetingAgendas'];
                DB::beginTransaction();
                if ($agendaDataArray[0]['agenda_title'] != null) {
                    foreach ($agendaDataArray as $key => $agenda) {
                        $agendaDetails = [
                            'meeting_id' => $request->meeting_id,
                            'title' => $agenda['agenda_title'],
                            'description' => $agenda['description'],
                            'created_by' => userInfo()->id,

                        ];
                        $create = $this->model->create($agendaDetails);
                    }
                }
            } else {
                $create = $this->model->create($data);
            }

            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 1);

            DB::commit();

            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));
            if ($request->fromMeeting == 'true') {
                return back();
            } else {
                return redirect(url('meetingAgendaList'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {

            $check = MeetingAgendaList::find($id);
            DB::beginTransaction();
            $data = $request->all();
            $this->model->update($data, $id);
            // insert log
            $this->logsRepository->insertLog($check->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

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
}
