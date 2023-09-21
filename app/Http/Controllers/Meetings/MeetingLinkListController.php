<?php

namespace App\Http\Controllers\Meetings;

use App\Http\Controllers\BaseController;
use App\Models\Meetings\Meeting;
use App\Repositories\CommonRepository;
use App\Repositories\MMS\MeetingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class MeetingLinkListController extends BaseController
{
    protected CommonRepository $model;

    protected MeetingRepository $meetingRepository;

    public function __construct(Meeting $model, MeetingRepository $meetingRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($model);
        $this->meetingRepository = $meetingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data['page_url'] = '/meetingLinkList';
            $data['page_route'] = 'meetingLinkList';
            $data['page_title'] = getLan() == 'np' ? 'बैठक लिङ्क सूची' : 'Meeting Link List';
            $data['request'] = $request;
            $data['meetingCodeList'] = Meeting::where('meeting_mode', 'online')
                ->orderBy('id', 'DESC')->get();
            $data['show_button'] = true;
            $data['results'] = $this->meetingRepository->getAllMeetingLinkList($request);
            $data['meetingRepo'] = $this->meetingRepository;
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
                'js/custom_search.js',
                'js/custom_app.min.js',

            ];

            return view('backend.meetingManagement.meetingLinkList.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
