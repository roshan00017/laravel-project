<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\BaseController;
use App\Models\Chat\Group;
use App\Models\Chat\GroupMembers;
use App\Models\User;
use App\Repositories\ChatRepository;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Hashids\Hashids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class GroupController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    protected ChatRepository $chatRepository;

    private int $menuId = 91;

    public function __construct(Group $group, LogsRepository $logsRepository, ChatRepository $chatRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($group);
        $this->logsRepository = $logsRepository;
        $this->chatRepository = $chatRepository;

    }

    public function index(Request $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'समूह च्याट' : 'Group Chat';
            $data['page_url'] = 'group';
            $data['page_route'] = 'group';
            $data['request'] = $request;
            $data['create_menu'] = true;

            $userId = auth()->id();

            // Retrieve the groups created by the logged-in user
            $data['results'] = $this->chatRepository->getAllGroup($request);
            $data['userinfo'] = userInfo()->id;
            $data['show_button'] = true;

            $data['load_js'] = [
                'js/custom_app.min.js',
            ];

            //filter
            // $data['filter'] = $this->chatRepository->filter($request);

            return view('backend.chatModule.group.index', $data);

        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }

    public function show($id)
    {

        try {
            $data['user_info'] = userInfo()->id;

            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $groupId = $hashIdValue[0];
                $value = Group::query()->find($hashIdValue[0]);
                $data['value'] = $value;

                $data['created_by'] = $value->created_by;

                // Group Members
                $data['results'] = GroupMembers::query()
                    ->join('users', 'group_members.member_id', '=', 'users.id')
                    ->where('group_members.group_id', $value->id)
                    ->select('users.full_name_np', 'users.full_name', 'group_members.member_id', 'group_members.group_id')
                    ->paginate(10);

                // Not Group Members
                $data['otherMembers'] = User::query()
                    ->where('client_id', clientInfo()->id)
                    ->whereNotIn('id', function ($query) use ($groupId) {
                        $query->select('member_id')
                            ->from('group_members')
                            ->where('group_id', $groupId);
                    })
                    ->select('id', 'full_name_np', 'full_name')
                    ->paginate(10);

                $data['load_js'] = [
                    'js/chat.js',
                ];

                $data['page_title'] = getLan() == 'np' ? 'समूह च्याट' : 'Group Chat';
                $data['page_url'] = 'group';
                $data['page_route'] = 'group';
                $data['create_menu'] = true;
                $data['data'] = $value->id;

                return view('backend.chatModule.group.showGroup', $data);
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcRegisterBook');
            }

        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $value = $this->model->find($id);

            $data = $request->all();
            $data['updated_by'] = userInfo()->id;
            $this->model->update($data, $id);

            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return redirect(url('group'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect(url('group'));
        }
    }

    public function memberUpdate(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $selectedUserIds = $request->input('user_id');
            foreach ($selectedUserIds as $key => $userId) {
                $userMember = new GroupMembers();
                $userMember->member_id = $userId;
                $userMember->group_id = $request->group_id;
                $userMember->fy_id = currentFy()->id;
                $userMember->client_id = $request->client_id;
                $userMember->save();
            }
            $countMember = GroupMembers::query()->where('group_id', $request->group_id)->count();
            Group::query()->where('id', $request->group_id)->update(['total_members' => $countMember]);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect(url('group'));
        }
    }

    public function groupInfo(Request $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'समूह च्याट' : 'Group Chat';
            $data['page_url'] = '/group';
            $data['page_route'] = 'group';
            $data['request'] = $request;

            $data['load_css'] = [
                'plugins/bs-stepper/css/bs-stepper.css',
            ];

            $data['load_js'] = [
                'plugins/bs-stepper/js/bs-stepper.js',
            ];
            $data['script_js'] = "$(function(){
            document.addEventListener('DOMContentLoaded', function () {
              window.stepper = new Stepper(document.querySelector('.bs-stepper'));
            });
            })";
            $data['group'] = $request->session()->get('group');

            $data['current_url'] = Route::current()->getName();

            return view('backend.chatModule.group.groupInfo', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if (empty($request->session()->get('group'))) {
                $group = new Group();
                $group->fill($data);
                $request->session()->put('group', $group);
            } else {
                $group = $request->session()->get('group');
                $group->fill($request->all());
            }
            // Store the updated session variable
            $request->session()->put('group', $group);

            return redirect()->route('chat.memberInfo');
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function memberInfo(Request $request)
    {
        try {
            $data['page_title'] = getLan() == 'np' ? 'समूह च्याट' : 'Group Chat';
            $data['page_url'] = '/group';
            $data['page_route'] = 'group';
            $data['request'] = $request;
            $data['groupMember'] = User::query()->where('client_id', clientInfo()->id)
                ->whereNot('id', userInfo()->id)->get();
            $data['toal_members'] = User::query()->whereNot('id', userInfo()->id)
                ->where('client_id', clientInfo()->id)->count();
            $data['load_css'] = [
                'plugins/bs-stepper/css/bs-stepper.css',
            ];

            $data['load_js'] = [
                'plugins/bs-stepper/js/bs-stepper.js',
                'js/chat.js',
                'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            ];
            $data['script_js'] = '$(document).ready(function () {'.
                "$('#selectall').click(function () {".
                "$('.selectedId').prop('checked', this.checked);".
                '});'.
                "$('.selectedId').change(function () {".
                "var check = ($('.selectedId').filter(':checked').length == $('.selectedId').length);".
                "$('#selectall').prop('checked', check);".
                '});'.
                '});
                ';

            $data['script_js'] = "$(function(){
            document.addEventListener('DOMContentLoaded', function () {
              window.stepper = new Stepper(document.querySelector('.bs-stepper'));
            });
            })";

            $data['groupChat'] = $request->session()->get('groupChat');
            $data['current_url'] = Route::current()->getName();

            return view('backend.chatModule.group.memberInfo', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function storeGroupChat(Request $request)
    {
        try {
            $group = $request->session()->get('group');
            $group['fy_id'] = currentFy()->id;
            $group['client_id'] = setClientId($request);
            $group['created_by'] = userInfo()->id;
            unset($group['total_members']);
            DB::beginTransaction();
            $group->save();
            $selectedUserIds = $request->input('user_id');
            $selectedUserIds[] = userinfo()->id;
            foreach ($selectedUserIds as $key => $userId) {
                $userMember = new GroupMembers();
                $userMember->member_id = $userId;
                $userMember->group_id = $group->id;
                $userMember->fy_id = currentFy()->id;
                $userMember->client_id = setClientId($request);
                $userMember->added_by = userInfo()->id;

                $userMember->save();
            }

            //update total group member in group table
            $groupMember = GroupMembers::query()->where('group_id', $group->id)->count();
            Group::where('id', $group->id)->update(['total_members' => $groupMember]);

            $request->session()->forget('group');
            //insert log
            //$this->logsRepository->insertLog($data->id, $this->menuId, 2);

            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return redirect(url('group'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function memberDelete(Request $request): RedirectResponse
    {
        try {
            // dd($request);

            if ($request->member_id) {
                DB::beginTransaction();

                // Delete the member from the group_member table
                DB::table('group_members')
                    ->where('member_id', $request->member_id)
                    ->where('group_id', $request->group_id)
                    ->delete();

                $countMember = GroupMembers::query()->where('group_id', $request->group_id)->count();
                Group::query()->where('id', $request->group_id)->update(['total_members' => $countMember]);
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

    public function groupDelete(Request $request): RedirectResponse
    {
        try {

            // Get the message count for the group
            $messageCount = DB::table('groups')
                ->join('group_chats', 'groups.id', '=', 'group_chats.group_id')
                ->where('groups.id', $request->group_id)
                ->count();

            if ($messageCount < 1) {
                DB::beginTransaction();

                DB::table('group_members')->where('group_id', $request->group_id)->delete();

                DB::table('groups')->where('id', $request->group_id)->delete();
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.deleteMessage'));
            } else {
                session()->flash('warning', Lang::get('chat.group_cannot_be_deleted'));
            }

            return back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
