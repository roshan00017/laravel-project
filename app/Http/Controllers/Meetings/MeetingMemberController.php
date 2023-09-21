<?php

namespace App\Http\Controllers\Meetings;

use App\Http\Controllers\BaseController;
use App\Models\Meetings\KaryapalikaMember;
use App\Models\Meetings\Meeting;
use App\Models\Meetings\MeetingMember;
use App\Models\User;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MeetingMemberController extends BaseController
{
    protected CommonRepository $model;

    protected CommonRepository $childModel;

    protected LogsRepository $logsRepository;

    private int $menuId = 20;

    public function __construct(
        MeetingMember $MeetingMember,
        User $childModel,
        LogsRepository $logsRepository
    ) {
        parent::__construct();
        // set the model
        $this->model = new CommonRepository($MeetingMember);
        $this->childModel = new CommonRepository($childModel);
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['meetingMemberList'] = MeetingMember::all();
            // $data['karyapalikamember'] = KaryapalikaMember::all();
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['karyapalikamember'] = KaryapalikaMember::select('id', $name.' '.'as name')->get();

            $data['meetingList'] = Meeting::query()->where('meeting_status_id', 1)->orderBy('id', 'desc')->get();
            // $data['clientList'] = LocalBody::all();

            $data['page_url'] = '/meetingMembers';
            $data['page_route'] = 'meetingMembers';
            $data['show_button'] = true;
            $data['add_more_button'] = true;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/selector.min.js',
                'js/meeting_member.js',
            ];
            $data['script_js'] = "$(function(){
                $('.mobileNo').inputmask('9999999999', { 'placeholder': '98xxxxxxxx' })
            })";
            if (Session::has('addMore')) {
                $data['script_js'] = "$(function(){
                     $(document).ready(function() {
                        $('#addModal').modal('show');
                    });
                })";
            }

            $name = getLan() == 'np' ? 'name_np' : 'name_en';

            $data['results'] = $this->model->getMeetingMemberList($request);
            $data['page_title'] = getLan() == 'np' ? 'बैठक सदस्य' : 'Meeting Member';
            $data['meetingCodeList'] = Meeting::query()->orderBy('id', 'desc')->get();
            $data['meetingListCode'] = Meeting::query()->where('meeting_category_id', 2)->get();
            $data['request'] = $request;

            return view('backend.meetingManagement.meetingMember.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function create(Request $request)
    {
        try {
            $data['page_url'] = '/meetingMembers';
            $data['page_route'] = 'meetingMembers';
            $data['meetingList'] = Meeting::query()->where('meeting_status_id', 1)->orderBy('id', 'desc')->get();
            $data['cancel_button'] = true;
            $data['page_title'] = getLan() == 'np' ? 'बैठक सदस्य' : 'Meeting Members';
            $data['load_css'] = [
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'js/selector.min.js',
                'js/members.js',
            ];
            $data['index_page_url'] = '/meetingMembers';

            return view('backend.meetingManagement.meetingMember.create', $data);
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }

    public function store(Request $request)
    {
        try {

            $data = $request->all();
            $create = '';

            $data['email'] = Str::lower($request->email);

            $data['created_by'] = userInfo()->id;

            //check meeting category
            $meetingInfo = Meeting::query()->where('id', $request->meeting_id)->first();
            //check karya palika member
            if ($meetingInfo->meeting_category_id == 2) {
                $karyapalikaMembers = KaryapalikaMember::query()->where('client_id', clientInfo()->id)->get();

                foreach ($karyapalikaMembers as $karyapalikaMember) {
                    $karyapalikamembers = [
                        'client_id' => $karyapalikaMember->client_id,
                        'name_np' => $karyapalikaMember->name_np,
                        'name_en' => $karyapalikaMember->name_en,
                        'email' => $karyapalikaMember->email,
                        'office' => '',
                        'post' => $karyapalikaMember->designation,
                        'created_by' => userInfo()->id,
                        'meeting_id' => $request->meeting_id,
                        'contact_no' => $karyapalikaMember->mobile,
                        'karyapalika_member_id' => $karyapalikaMember->id,

                    ];
                    DB::beginTransaction();
                    $create = MeetingMember::query()->create($karyapalikamembers);
                    DB::commit();

                }
            } else {
                //add multiple agenda from meeting
                $meetingDataArray = $data['addMeetingMembers'];
                foreach ($meetingDataArray as $key => $member) {
                    $memberDetails = [
                        'meeting_id' => $request->meeting_id,
                        'name_en' => $member['name_en'],
                        'name_np' => $member['name_np'],
                        'office' => $member['office'],
                        'post' => $member['post'],
                        'contact_no' => $member['contact_no'],
                        'email' => $member['email'],
                        'is_invite' => $member['is_invite'] ?? false,
                        'created_by' => userInfo()->id,

                    ];
                    DB::beginTransaction();
                    $create = $this->model->create($memberDetails);

                    $this->logsRepository->insertLog($create->id, $this->menuId, 1);
                    DB::commit();

                }
            }
            if ($request->addMore == 'true') {
                session()->flash('addMore', 'Add More');
            }
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return redirect('/meetingMembers');
        } catch (\Exception $e) {
            dd($e);
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
            if ($value->is_invite == 0) {
                DB::beginTransaction();
                $this->model->isInvite($value->id, 1);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 5);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($value->is_invite == 1) {
                DB::beginTransaction();
                $this->model->isInvite($value->id, 0);
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

    public function update(Request $request, $id)
    {
        try {
            $meetingMember = $this->model->find($id);
            $data = $request->all();

            if ($meetingMember) {
                DB::beginTransaction();
                $data['updated_by'] = userInfo()->id;
                $update = $this->model->update($data, $id);
            }
            // insert log
            $this->logsRepository->insertLog($meetingMember->id, $this->menuId, 2);
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

    public function updatePresentStatus(Request $request)
    {
        try {
            $id = (int)$request->id;
            $value = MeetingMember::where('id', $id)->first();
            if ($value) {

                if($value->is_present == true)
                {
                    MeetingMember::query()->where('id', $value->id)->update(['is_present'=>false]);
                }else{
                    MeetingMember::query()->where('id', $value->id)->update(['is_present'=>true]);
                }
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
                return response()->json([
                    'success' => true,
                    'message' =>  Lang::get('message.flash_messages.updateMessage')
                ]);
            }
        } catch (\Exception $e) {
            dd('dd');
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
