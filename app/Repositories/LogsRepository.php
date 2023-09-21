<?php

namespace App\Repositories;

use App\Facades\NepaliDate;
use App\Helpers\DateConverter;
use App\Models\ApiSetting\ApiAccess;
use App\Models\Logs\ActionLogs;
use App\Models\Logs\LoginFails;
use App\Models\Logs\LoginLogs;
use App\Models\Roles\Menu;
use App\Models\User;
use App\SInterFace\LogRepositoryInterface;
use Carbon\Carbon;

class LogsRepository implements LogRepositoryInterface
{
    private LoginLogs $loginLogs;

    private LoginFails $loginFails;

    private ActionLogs $actionLog;

    private DateConverter $dateConverter;

    public function __construct(
        LoginLogs $loginLogs,
        LoginFails $loginFails,
        ActionLogs $actionLog,
        DateConverter $dateConverter
    ) {
        $this->loginLogs = $loginLogs;
        $this->loginFails = $loginFails;
        $this->actionLog = $actionLog;
        $this->dateConverter = $dateConverter;
    }

    public function getAllLoginLog($request)
    {
        //set login in log date
        if (getLan() == 'np') {
            $log_date = 'log_in_date_np';
        } else {
            $log_date = 'log_in_date';
        }
        $result = $this->loginLogs
            ->leftJoin('users', 'login_logs.user_id', '=', 'users.id');

        if ($request->user_id != null && $request->from_date == null && $request->to_date == null) {
            $result = $result->where('user_id', $request->user_id);
        }

        if ($request->user_id) {
            $result = $result->where('user_id', $request->user_id);
        }
        if ($request->client_id) {
            $result = $result->where('client_id', $request->client_id);
        }

        if ($request->province_code != null) {
            $result = $result->where('login_logs.province_code', $request->province_code);
        }
        if ($request->district_code != null) {
            $result = $result->where('login_logs.district_code', $request->district_code);
        }
        if ($request->local_body_code != null) {
            $result = $result->where('login_logs.local_body_code', $request->local_body_code);
        }
        if ($request->ward_no != null) {
            $result = $result->where('login_logs.ward_no', $request->ward_no);
        }
        if ($request->school_id != null) {
            $result = $result->where('login_logs.school_id', $request->school_id);
        }

        if ($request->login_user_type != null) {
            $result = $result->where('login_logs.login_user_type', $request->login_user_type);
        }

        if ($request->login_guard != null) {
            $result = $result->where('login_logs.login_guard', $request->login_guard);
        }

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where($log_date, '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($log_date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where($log_date, '>=', $request->from_date)
                ->where($log_date, '<=', $request->to_date);
        }
        if (userInfo()->role_id > 1) {
            $result = $result
                ->where('users.role_id', '<>', 1);
        }

        return $result
            ->select('login_logs.*')
            ->orderBy('login_logs.id', 'desc')
            ->paginate(10);
    }

    public function getAllLoginFails($request)
    {
        //set login in log date
        if (getLan() == 'np') {
            $log_date = 'log_fails_date_np';
        } else {
            $log_date = 'log_fails_date';
        }
        $result = $this->loginFails
            ->leftJoin('users', 'login_fails.user_id', '=', 'users.id');

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where($log_date, '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($log_date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where($log_date, '>=', $request->from_date)
                ->where($log_date, '<=', $request->to_date);
        }

        if (userInfo()->role_id > 1) {
            $result = $result
                ->where('users.role_id', '<>', 1);
        }

        return $result
            ->orderBy('login_fails.id', 'desc')
            ->select('login_fails.*')
            ->paginate(10);
    }

    public function getAllActionLogs($request)
    {
        //set login in log date
        if (getLan() == 'np') {
            $log_date = 'action_date_np';
        } else {
            $log_date = 'action_date';
        }
        $result = $this->actionLog
            ->leftJoin('users', 'action_logs.action_user_id', '=', 'users.id');

        if ($request->module_name) {
            $result = $result->where('action_logs.action_module', $request->module_name);
        }
        if ($request->client_id) {
            $result = $result->where('client_id', $request->client_id);
        }

        if ($request->action_name) {
            $result = $result->where('action_logs.action_name', $request->action_name);
        }

        if ($request->user_id) {
            $result = $result->where('action_logs.action_user_id', $request->user_id);
        }

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where($log_date, '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($log_date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where($log_date, '>=', $request->from_date)
                ->where($log_date, '<=', $request->to_date);
        }

        /* check super admin */
        if (userInfo()->role_id > 1) {
            $result = $result
                ->where('users.role_id', '<>', 1);
        }

        return $result
            ->select('action_logs.*')
            ->orderBy('action_logs.id', 'desc')
            ->paginate(10);
    }

    public function moduleList()
    {
        return Menu::select('id', 'menu_name')
            ->where('action_module_status', 1)
            ->get();
    }

    /*  insert action from user action activity */
    public function insertLog($actionId, $moduleName, $logType, $actionUrl = null)
    {

        $actionDevice = device_info();
        $value['action_ip'] = request()->ip();
        $value['action_id'] = $actionId;
        $value['action_device'] = $actionDevice;
        $value['action_module'] = $moduleName;
        $value['action_date'] = Carbon::now();
        $value['action_date_np'] = NepaliDate::create(Carbon::now())->toBS();
        $value['action_user_id'] = auth()->user()->id;
        $value['action_name'] = $logType;
        $value['action_url'] = $actionUrl;

        return ActionLogs::create($value);
    }

    public function userList()
    {
        $query = User::query();

        /* check super admin */
        if (auth()->user()->role_id > 1) {
            $query = $query->whereNot('role_id', 1);
        }

        $orderBy = getLan() == 'np' ? 'full_name_np' : 'full_name';

        return $query
            ->orderBy($orderBy, 'ASC')
            ->get();
    }

    public function ipUnblock($id)
    {
        $value = LoginFails::query()->where('id', $id)->first();
        if ($value) {
            LoginFails::where('log_in_ip', $value->log_in_ip)->where('user_id', '=', null)->update(['login_fail_count' => null]);
            //create action log
            $this->insertLog($value->id, 13, 8);
            session()->flash('success', 'IP Successfully Unblock!');

            return back();
        }
    }

    public function getAllApiAccessLogs($request)
    {
        $result = ApiAccess::orderBy('id', 'desc');

        if ($request->api_key_id) {
            $result = $result->where('api_key_id', $request->api_key_id);
        }

        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where('created_at', '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where('created_at', '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->where('created_at', '>=', $request->from_date)
                ->where('created_at', '<=', $request->to_date);
        }

        $result = $result
            ->paginate(10);

        return $result;
    }
}
