<?php

namespace App\Http\Controllers\Meetings;

use App\Http\Controllers\BaseController;
use App\Models\Meetings\FinalVerdict;
use App\Models\Meetings\Meeting;
use App\Models\Meetings\MeetingMember;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class FinalVerdictController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 9;

    public function __construct(FinalVerdict $finalVerdict, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($finalVerdict);
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
            $data['page_url'] = '/finalVerdicts';
            $data['page_route'] = 'finalVerdicts';
            $data['results'] = $this->model->getFinalVerdict($request);

            $data['add_more_button'] = true;
            $data['meetingList'] = Meeting::query()->where('meeting_status_id', 1)->orderBy('id', 'desc')->get();
            $data['meetingCodeList'] = Meeting::query()->orderBy('id', 'desc')->get();
            $data['meetingMemberList'] = MeetingMember::all();
            $data['page_title'] = getLan() == 'np' ? 'बैठक निर्णय' : 'Final Verdict';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/selector.min.js',
                'js/finalVerdict.js',
            ];
            if (Session::has('addMore')) {
                $data['script_js'] = "$(function(){
                     $(document).ready(function() {
                        $('#addModal').modal('show');
                    });
                })";
            }

            return view('backend.meetingManagement.finalVerdict.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function create()
    {
        $data['page_title'] = getLan() == 'np' ? 'बैठक निर्णय' : 'Final Verdict';
        $data['page_url'] = '/finalVerdicts';
        $data['page_route'] = 'finalVerdicts';
        $data['meetingList'] = Meeting::query()->where('meeting_status_id', 1)->orderBy('id', 'desc')->get();
        $data['load_css'] = [
            'plugins/select2/css/select2.css',

        ];
        $data['load_js'] = [
            'plugins/select2/js/select2.full.min.js',
            'js/custom_app.min.js',
            'js/selector.min.js',
            'js/finalVerdict.js',
        ];

        return view('backend.meetingManagement.finalVerdict.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {

        try {
            DB::beginTransaction();
            //check school data exist
            $data = $request->all();
            $meetingId = $data['meeting_id'];
            $members = $data['member_id'];
            $feedbacks = $data['feedback'];
            foreach ($members as $key => $mm) {
                $ajendaId = $key;
                $feedback = $feedbacks[$ajendaId];
                $i = 0;
                for ($i; $i < count($mm); $i++) {
                    if ($mm[$i]) {
                        $memberId = $mm[$i];
                        $feedvack = $feedback[$i];
                        $create = $this->model->create(['member_id' => $memberId, 'meeting_id' => $meetingId, 'feedback' => $feedvack, 'agenda_id' => $ajendaId, 'client_id' => Auth::user()->client_id]);
                        // insert log
                        $this->logsRepository->insertLog($create->id, $this->menuId, 1);
                    }
                }

            }

            DB::commit();
            if ($request->addMore == 'true') {
                session()->flash('addMore', 'Add More');
            }
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {

            $check = FinalVerdict::find($id);
            DB::beginTransaction();
            $data = $request->all();
            $this->model->update($data, $id);
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
