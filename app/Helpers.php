<?php

use App\Models\Logs\LoginFails;
use App\Models\Roles\Menu;
use Hashids\Hashids;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Agent\Agent;

//allow add button
function allowAdd()
{
    return helperPermission()['isAdd'];
}

//allow edit button
function allowEdit()
{
    return helperPermission()['isEdit'];
}

//allow edit button
function allowDelete()
{
    return helperPermission()['isDelete'];
}

//allow index
function allowIndex()
{
    return helperPermission()['isIndex'];
}

//allow view button
function allowShow()
{
    return helperPermission()['isShow'];
}

function dataStatus(): array
{
    return [
        1 => trans('message.button.active'),
        0 => trans('message.button.inactive'),
    ];
}

//get device information
function device_info(): string
{
    $agentValue = new Agent();
    $browser = $agentValue->browser();
    $version = $agentValue->version($browser);
    $device = '';
    $platform = $agentValue->platform();
    if ($agentValue->isDesktop()) {
        $device = 'Desktop';
    } elseif ($agentValue->isMobile()) {
        $device = 'Mobile';
    } elseif ($agentValue->isPhone()) {
        $device = 'Phone';
    } elseif ($agentValue->isTablet()) {
        $device = 'Tablet';
    } elseif ($agentValue->isRobot()) {
        $device = 'Robot';
    }

    return $browser.' '.$version.' '.$platform.' '.$device;
}

/* CRUD Permission for blade file */
function helperPermission(): array
{
    //get Controller Name
    //get the access from database
    //set variable for add/edit/delete

    $action = app('request')->route()->getAction();

    /*
     * Splits the controller and store in array
     */
    $controllers = explode('@', class_basename($action['controller']));
    /*
     * Checks the existence of controller and method
     */

    $controller_name = $controllers[0] ?? '';

    $permission = [
        'isIndex' => false,
        'isAdd' => false,
        'isEdit' => false,
        'isShow' => false,
        'isDelete' => false,
    ];

    $value = Menu::join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
        ->select('user_roles.*', 'menus.*')
        ->where([
            ['role_id', '=', userInfo()->role_id],
            ['menu_controller', '=', $controller_name],
        ])
        ->first();

    if ($value != null || userInfo()->role_id == 1) {
        /* access for super admin */
        if (userInfo()->role_id == 1) {
            $isIndex = true;
            $isAdd = true;
            $isEdit = true;
            $isDelete = true;
            $isShow = true;
        } else {
            $isIndex = $value->allow_index;
            $isAdd = $value->allow_add;
            $isEdit = $value->allow_edit;
            $isDelete = $value->allow_delete;
            $isShow = $value->allow_show;
        }
        $permission = [
            'isIndex' => $isIndex,
            'isAdd' => $isAdd,
            'isEdit' => $isEdit,
            'isDelete' => $isDelete,
            'isShow' => $isShow,
        ];
    }

    return $permission;
}

function moduleAction($code = null): array|string
{
    $value = '';
    if ($code != null) {
        switch ($code) {
            case '1':
                $value = 'Create';
                break;
            case '2':
                $value = 'Update';
                break;
            case '3':
                $value = 'View';
                break;
            case '4':
                $value = 'Delete';
                break;
            case '5':
                $value = 'Status Active';
                break;
            case '6':
                $value = 'Status Inactive';
                break;
            case '7':
                $value = 'User Unblock';
                break;
            case '8':
                $value = 'IP Unblock';
                break;
            case '9':
                $value = 'Update Password';
                break;
            case '10':
                $value = 'Update Profile';
                break;
        }
    } else {
        $value = [

            '1' => 'Create',
            '2' => 'Update',
            '3' => 'View',
            '4' => 'Delete',
            '5' => 'Status Active',
            '6' => 'Status Inactive',
            '7' => 'User Unblock',
            '8' => 'IP Unblock',
            '9' => 'Update Password',
            '10' => 'Update Profile',
        ];
    }

    return $value;
}

/*
 * Random Password Generate Function
 */
function rand_string($length): string
{
    $chars = 'ABC123abc$%456#*EFGHIJ789efghijklmn!mnopqrstKLMNOPQRSTuvwxyzUVWX(YZ)';

    return substr(str_shuffle($chars), 0, $length);
}

/* get all system setting */
function systemSetting()
{
    if (Schema::hasTable('app_settings')) {
        return \App\Models\SystemSetting\AppSetting::first();
    }
}

/* get logged in user info */
function userInfo(): ?Illuminate\Contracts\Auth\Authenticatable
{
    return Auth::user();
}

function setFont(): string
{
    if (session()->get('locale') == 'en') {
        return 'f-arial';
    } else {
        return 'f-kalimati';
    }
}

function setDatePicker(): array
{
    if (getLan() == 'np') {
        return [
            'from_date' => 'from_date_np',
            'to_date' => 'to_date_np',
            'dateClass' => 'nepaliDatePicker',
        ];
        function setDatePicker(): array
        {
            if (getLan() == 'np') {
                return [
                    'from_date' => 'from_date_np',
                    'to_date' => 'to_date_np',
                    'dateClass' => 'nepaliDatePicker',
                ];
            } else {
                return [
                    'from_date' => 'from_date_en',
                    'to_date' => 'to_date_en',
                    'dateClass' => 'englishDatePicker',

                ];
            }
        }
    } else {
        return [
            'from_date' => 'from_date_en',
            'to_date' => 'to_date_en',
            'dateClass' => 'englishDatePicker',

        ];
    }
}

function getLan(): string
{
    if (session()->get('locale') == 'en') {
        return 'en';
    } else {
        return 'np';
    }
}

function setName(): string
{
    if (session()->get('locale') == 'en') {
        return 'name_en';
    } else {
        return 'name_np';
    }
}

//get user login fails  count
function getUserLoginFailed($id)
{
    return LoginFails::select('login_fail_count')
        ->where([
            ['user_id', '=', $id],
            ['login_fail_count', '<>', null],
            ['log_fails_date', '=', \Carbon\Carbon::now()->toDateString()],
        ])
        ->count();
}

function getLoginAttempt()
{
    return \App\Models\SystemSetting\AppSetting::select('login_attempt_limit')
        ->first();
}

function getIpLoginFailed()
{
    return LoginFails::select('login_fail_count')
        ->where([
            ['log_in_ip', '=', request()->ip()],
            ['user_id', '=', null],
            ['login_fail_count', '<>', null],
            ['log_fails_date', '=', date('Y-m-d')],
        ])
        ->count();
}

function short_hash($value, $length)
{
    return substr(md5($value), 0, $length);
}

function userProfilePath()
{
    return \App\Models\User::USER_PROFILE_PATH.'/';
}

function currentFy()
{
    return \App\Models\Calendar\MstFiscalYear::where('status', 1)->first();
}

function isInvite(): array
{
    return [
        1 => trans('message.button.yes'),
        0 => trans('message.button.no'),
    ];
}

function smsSetting($client_id = null)
{
    if (Schema::hasTable('sms_settings')) {
        $value = \App\Models\SystemSetting\SmsSetting::where(['client_id' => $client_id, 'status' => true])->first();
        if (isset($value)) {
            $data = $value;

        } else {
            $data = \App\Models\SystemSetting\SmsSetting::whereNull('client_id')->first();
        }

        return $data;
    }
}

function mailSetting($client_id = null)
{
    if (Schema::hasTable('mail_settings')) {
        $value = \App\Models\SystemSetting\MailSetting::where(['client_id' => $client_id, 'status' => true])->first();
        if (isset($value)) {
            $data = $value;

        } else {
            $data = \App\Models\SystemSetting\MailSetting::whereNull('client_id')->first();
        }

        return $data;
    }
}

function appClientList()
{
    $name = getLan() == 'np' ? 'name_np' : 'name_en';
    if (Schema::hasTable('app_client')) {
        return \App\Models\MasterSettings\AppClient::orderBy('id', 'desc')->select('id', $name.' '.'as name')->get();
    }
}

function clientInfo($clientId = null)
{
    if (is_null($clientId)) {
        $clientId = config('client.client_id');
    }

    $name = getLan() == 'np' ? 'app_client.name_np' : 'app_client.name_en';
    $provinceName = getLan() == 'np' ? 'provinces.name_np' : 'provinces.name_en';
    $districtName = getLan() == 'np' ? 'd.name_np' : 'd.name_en';
    if (Schema::hasTable('app_client')) {
        $clientInfo = App\Models\MasterSettings\AppClient::leftJoin('local_bodies as lb', 'lb.id', '=', 'app_client.local_body_mapping_id')
                ->leftJoin('districts as d', 'd.code', '=', 'lb.district_code')
                ->leftJoin('provinces', 'provinces.code', '=', 'd.province_code')
                ->leftJoin('local_body_types as lbt', 'lbt.id', '=', 'lb.local_body_type_id')
                ->where('app_client.id', $clientId)->select(
                    'app_client.id', $name.' '.'as name',
                    'app_client.code',
                    'app_client.web_url',
                    'app_client.api_web_url', $provinceName.' '.'as province_name', $districtName.' '.'as district_name',
                    'lbt.id as local_body_type_id'
                )->first();
        if ($clientInfo) {
            return $clientInfo;
        } else {
            return \App\Models\MasterSettings\AppClient::leftJoin('local_bodies as lb', 'lb.id', '=', 'app_client.local_body_mapping_id')
                    ->leftJoin('districts as d', 'd.code', '=', 'lb.district_code')
                    ->leftJoin('provinces', 'provinces.code', '=', 'd.province_code')
                    ->leftJoin('local_body_types as lbt', 'lbt.id', '=', 'lb.local_body_type_id')
                    ->where('app_client.id', 20)->select(
                        'app_client.id', $name.' '.'as name',
                        'app_client.code',
                        'app_client.web_url',
                        'app_client.api_web_url', $provinceName.' '.'as province_name', $districtName.' '.'as district_name',
                        'lbt.id as local_body_type_id'
                    )->first();
        }
    }
}

function meetingStatus($meetingId = null)
{
    $query = \App\Models\Meetings\MstMeetingStatus::query();

    if ($meetingId != null) {
        return $query->where('id', $meetingId)->first();
    } else {
        $name = getLan() == 'np' ? 'name_np' : 'name_en';

        return $query->select('id', $name.' '.'as name')->pluck('name', 'id');
    }
}

function meetingAgendaFinalized()
{
    return [
        0 => trans('message.button.no'),
        1 => trans('message.button.yes'),
    ];
}

function setMeetingCode($clientId = null)
{

    if ($clientId != null) {
        return 'MT'.$clientId.rand_string(6);
    } else {
        return 'MT'.userInfo()->client_id.rand_string(6);
    }
}

function hashIdGenerate($id)
{
    $hashids = new Hashids('', hashIdLen(), 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');

    return $hashids->encode($id);
}

function hashIdLen(): int
{
    return 8;
}

function userModule(): array
{
    if (getLan() == 'np') {
        if (userInfo()->role_id > 1) {

            return [
                'client_admin' => 'Client Admin',
                'edmis' => 'EDMIS',
                'mms' => 'MMS',
                'ghs' => 'GHS',
                'dcc' => 'DCC',
                'app' => 'Appointment',
            ];
        } else {

            return [
                'system_admin' => 'System Admin',
                'client_admin' => 'Client Admin',
                'edmis' => 'EDMIS',
                'mms' => 'MMS',
                'ghs' => 'GHS',
                'dcc' => 'DCC',
                'app' => 'Appointment',
            ];
        }
    } else {
        if (userInfo()->role_id > 1) {

            return [
                'client_admin' => 'Client Admin',
                'edmis' => 'EDMIS',
                'mms' => 'MMS',
                'ghs' => 'GHS',
                'dcc' => 'DCC',
                'app' => 'Appointment',
            ];
        } else {

            return [
                'system_admin' => 'System Admin',
                'client_admin' => 'Client Admin',
                'edmis' => 'EDMIS',
                'mms' => 'MMS',
                'ghs' => 'GHS',
                'dcc' => 'DCC',
                'app' => 'Appointment',
            ];
        }
    }
}

//check  hole system admin access
function systemAdmin()
{
    if (userInfo()->user_module == 'system_admin' && is_null(userInfo()->client_id)) {
        return true;
    } else {
        return false;
    }

}

//check  hole system admin access
function checkClientAdmin()
{
    if (userInfo()->user_module == 'client_admin' && userInfo()->client_id != null) {
        return true;
    } else {
        return false;
    }

}

//check  hole system admin access
function checkUserModule()
{

    return userInfo()->user_module;

}

function setClientId($request = null)
{
    if (systemAdmin() == false) {
        return userInfo()->client_id;
    } else {
        return $request->client_id ? $request->client_id : clientInfo()->id;
    }

}

//check  sms service provider
function smsServiceProvider()
{

    return [
        'DOIT' => 'DOIT',
        'SPARROW' => 'SPARROW',
        'OTHER' => 'OTHER',

    ];

}

function notifyType($type = null): array|string
{
    $value = '';
    if ($type != null) {
        switch ($type) {
            case 'complaint':
                $value = getLan() == 'np' ? 'गुनासो' : 'Complaint';
                break;
            case 'suggestion':
                $value = getLan() == 'np' ? 'सुझाव' : 'Suggestion';
                break;
            case 'incident':
                $value = getLan() == 'np' ? 'घटना' : 'Incident';
                break;
            case 'appointment':
                $value = getLan() == 'np' ? 'भेटघाट' : 'Appointment';
                break;
        }
    } else {
        $value = [

            'complaint' => getLan() == 'np' ? 'गुनासो' : 'Complaint',
            'suggestion' => getLan() == 'np' ? 'सुझाव' : 'Suggestion',
            'incident' => getLan() == 'np' ? 'घटना' : 'Incident',
            'appointment' => getLan() == 'np' ? 'भेटघाट' : 'Appointment',
        ];
    }

    return $value;
}

//ott channel link

function settingInfo($setting_code = null)
{
    $data = \App\Models\MasterSettings\ClientSetting::query()->where(['client_id' => clientInfo()->id, 'setting_code' => $setting_code, 'status' => true])->first();

    if (isset($data)) {
        return $data->value;
    }

    return null;
}

function moduleName($module_name = null): array|string
{
    $value = '';
    if ($module_name != null) {
        switch ($module_name) {
            case 'edmis':
                $value = getLan() == 'np' ? 'कार्यालय व्यवस्थापन प्रणाली' : 'Office Automation';
                break;
            case 'ghs':
                $value = getLan() == 'np' ? 'गुनासो तथा सुझाव व्यवस्थापन' : 'Complaint & Suggestion Management';
                break;
            case 'mms':
                $value = getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting Management';
                break;
            case 'dcc':
                $value = getLan() == 'np' ? 'विद्युतीय नागरिक बडापत्र' : 'Digital Citizen Character';
                break;
        }
    } else {
        $value = [

            'edmis' => getLan() == 'np' ? 'कार्यालय व्यवस्थापन प्रणाली' : 'Office Automation',
            'ghs' => getLan() == 'np' ? 'गुनासो तथा सुझाव व्यवस्थापन' : 'Complaint & Suggestion Management',
            'mms' => getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting management',
            'dcc' => getLan() == 'np' ? 'विद्युतीय नागरिक बडापत्र' : 'Digital Citizen Character',
        ];
    }

    return $value;
}

function moduleServiceName($module_name = null): array|string
{
    $value = '';
    if ($module_name != null) {
        switch ($module_name) {
            case 'dispatch_book':
                $value = getLan() == 'np' ? 'चलानी किताब' : 'Dispatch Book';
                break;
            case 'register_book':
                $value = getLan() == 'np' ? 'दर्ता किताब' : 'Register Book';
                break;
            case 'complaint':
                $value = getLan() == 'np' ? 'गुनासो' : 'Complaint';
                break;
            case 'meeting':
                $value = getLan() == 'np' ? 'बैठक' : 'Meeting';
                break;
            case 'sifaris':
                $value = getLan() == 'np' ? 'सिफारिस' : 'Sifaris';
                break;
        }
    } else {
        $value = [

            'dispatch_book' => getLan() == 'np' ? 'चलानी किताब' : 'Dispatch Book',
            'register_book' => getLan() == 'np' ? 'दर्ता किताब' : 'Register Book',
            'complaint' => getLan() == 'np' ? 'गुनासो' : 'Complaint',
            'meeting' => getLan() == 'np' ? 'बैठक' : 'Meeting',
            'sifaris' => getLan() == 'np' ? 'सिफारिस' : 'Sifaris',
        ];
    }

    return $value;
}

function paginate($items, $perPage = 10, $page = null, $options = [])
{
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);

    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
}

function appVersion()
{
    return \App\Models\MasterSettings\AppVersion::query()->orderBy('id', 'desc')->latest()->first();
}

function chartModule()
{
    return [

        'edmis' => getLan() == 'np' ? 'कार्यालय व्यवस्थापन प्रणाली' : 'Office Automation',
        'ghs' => getLan() == 'np' ? 'गुनासो तथा सुझाव व्यवस्थापन' : 'Complaint & Suggestion Management',
        'mms' => getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting management',
        'dcc' => getLan() == 'np' ? 'विद्युतीय नागरिक बडापत्र' : 'Digital Citizen Character',
    ];
}

function tingTingService($service = null): array|string
{
    $value = '';
    if ($service != null) {
        switch ($service) {
            case 'PHONE':
                $value = getLan() == 'np' ? 'फोन' : 'Phone';
                break;
            case 'SMS':
                $value = getLan() == 'np' ? 'एस.एम.एस' : 'Sms';
                break;
        }
    } else {
        $value = [

            'PHONE' => getLan() == 'np' ? 'फोन' : 'Phone',
            'SMS' => getLan() == 'np' ? 'एस.एम.एस' : 'Sms',
        ];
    }

    return $value;
}

function tingTingSendMedium($service = null): array|string
{
    $value = '';
    if ($service != null) {
        switch ($service) {
            case '1':
                $value = getLan() == 'np' ? 'व्यक्तिगत' : 'Individual';
                break;
            case '2':
                $value = getLan() == 'np' ? 'समूह' : 'Bulk Upload';
                break;
        }
    } else {
        $value = [

            '1' => getLan() == 'np' ? 'व्यक्तिगत' : 'Individual',
            '2' => getLan() == 'np' ? 'समूह' : 'Bulk Upload',
        ];
    }

    return $value;
}

function tingTingVoiceInput($service = null): array|string
{
    $value = '';
    if ($service != null) {
        switch ($service) {
            case 'np_prasanna':
                $value = 'Prasanna';
                break;
            case 'np_rija':
                $value = 'Rija';
                break;
        }
    } else {
        $value = [

            'np_prasanna' => 'Prasanna',
            'np_rija' => 'Rija',
        ];
    }

    return $value;
}

function provinceList($data = null): Illuminate\Database\Eloquent\Collection|array
{
    $result = \App\Models\MasterSettings\Province::query();

    return $result
        ->select('id', 'code', setName().' '.'as name')
        ->where('status', true)
        ->get();
}

function districtList(): Illuminate\Database\Eloquent\Collection|array
{
    $result = \App\Models\MasterSettings\District::query();

    return $result
        ->select('id', 'code', setName().' '.'as name')
        ->where('status', true)
        ->get();
}
function districtListByCode($code): Illuminate\Database\Eloquent\Collection|array
{
    return \App\Models\MasterSettings\District::query()
        ->select('id', 'code', setName().' '.'as name')
        ->where(['province_code' => $code, 'status' => true])
        ->get();
}

function localBodyList(): Illuminate\Database\Eloquent\Collection|array
{
    $result = \App\Models\MasterSettings\LocalBody::query();

    return $result
        ->select('id', 'code', setName().' '.'as name')
        ->where('status', true)
        ->get();
}

function localBodyListByCode($code): Illuminate\Database\Eloquent\Collection|array
{
    return \App\Models\MasterSettings\LocalBody::query()
        ->select('id', 'code', setName().' '.'as name')
        ->where(['district_code' => $code, 'status' => true])
        ->get();
}

function getWardListByLocalBodyCode($code): array
{
    $value = \App\Models\MasterSettings\LocalBody::query()
        ->where(['code' => $code, 'status' => true])
        ->first();

    return range(1, $value ? $value->total_ward : 0);
}

function appointmentDepartment($department = null): array|string
{
    $value = '';
    if ($department != null) {
        switch ($department) {
            case 'km':
                $value = getLan() == 'np' ? 'जन-प्रतिनिधि ' : 'Elected Person';
                break;
            case 'om':
                $value = getLan() == 'np' ? 'कर्मचारी' : 'Office Staff';
                break;
        }
    } else {
        $value = [

            'km' => getLan() == 'np' ? 'जन-प्रतिनिधि ' : 'Elected Person',
            'om' => getLan() == 'np' ? 'कर्मचारी' : 'Office Staff',
        ];
    }

    return $value;
}

function appointmentType($type = null): array|string
{
    $value = '';
    if ($type != null) {
        switch ($type) {
            case 'p':
                $value = getLan() == 'np' ? 'Public ' : 'Public';
                break;
            case 's':
                $value = getLan() == 'np' ? 'System' : ' System';
                break;
        }
    } else {
        $value = [

            'p' => getLan() == 'np' ? 'Public ' : 'Public',
            's' => getLan() == 'np' ? 'System' : ' System',
        ];
    }

    return $value;
}

function appointmentStatus($status = null): array|string
{
    $value = '';
    if ($status != null) {
        switch ($status) {
            case 'v':
                $value = getLan() == 'np' ? 'भेटघाट भईसकेको  ' : 'Visited';
                break;
            case 'h':
                $value = getLan() == 'np' ? 'हस्तान्तरण गरिएको' : 'Handover';
                break;
        }
    } else {
        $value = [

            'v' => getLan() == 'np' ? 'भेटघाट भईसकेको  ' : 'Visited',
            'h' => getLan() == 'np' ? 'हस्तान्तरण गरिएको' : 'Handover',
        ];
    }

    return $value;
}

function serviceTokenStatus()
{

    return [

        'st' => trans('frontendSuggestion.service_token.start_token'),
        'ca' => trans('frontendSuggestion.service_token.cancelled_token'),
        'co' => trans('frontendSuggestion.service_token.complete_token'),
    ];
}

//check appointment access user info
function appointAccessInfo()
{
    return \App\Models\Appointment\AppointmentAccessUser::query()->where('user_id', userInfo()->id)->first();
}

function fiscalYearList()
{
    return \App\Models\Calendar\MstFiscalYear::query()->orderBy('id', 'desc')->get();
}
function apiKeyExpireTimeSetting(): int
{
    $data = \App\Models\SystemSetting\AppSetting::first();
    if ($data->api_key_expire_time) {
        $expire_time = $data->api_key_expire_time;
    } else {
        $expire_time = 24;
    }

    return $expire_time;
}

function callRoutingNumberType($type = null)
{

    $value = '';
    if ($type != null) {
        switch ($type) {
            case 'emergency_contact':
                $value = getLan() == 'np' ? 'आकस्मिक सम्पर्क' : 'Emergency Contact';
                break;
            case 'police_number':
                $value = getLan() == 'np' ? 'प्रहरी सम्पर्क' : 'Police Number';
                break;
            case 'ambulance_number':
                $value = getLan() == 'np' ? 'यम्बुलेन्स सम्पर्क' : 'Ambulance Number';
                break;
            case 'firebrigade_number':
                $value = getLan() == 'np' ? 'दमकल सम्पर्क' : 'Fire Brigade Number';
                break;
        }
    } else {
        $value = [

            'emergency_contact' => getLan() == 'np' ? 'आकस्मिक सम्पर्क' : 'Emergency Contact',
            'police_number' => getLan() == 'np' ? 'प्रहरी सम्पर्क' : 'Police Number',
            'ambulance_number' => getLan() == 'np' ? 'यम्बुलेन्स सम्पर्क' : 'Ambulance Number',
            'firebrigade_number' => getLan() == 'np' ? 'दमकल सम्पर्क' : 'Fire Brigade Number',
        ];
    }

    return $value;
}

function tokenType()
{
     return  [

            'a' => getLan() == 'np' ? 'भेटघाट ' : 'Appointment',
            'c' => getLan() == 'np' ? 'गुनासो' : 'Complaint',
        ];
}

function registerType()
{
    return  [

        'c' => getLan() == 'np' ? 'गुनासो' : 'Complaint',
        's' => getLan() == 'np' ? 'सुझाव ' : 'Suggestion',
    ];
}

//not used only for reference
function otpSetting($client_id = null)
{
    if(Schema::hasTable('otp_settings')) {
        $value = \App\Models\SystemSetting\OtpSetting::where(array('client_id' => $client_id, 'status' => true))->first();
        if (isset($value)) {
            $data = $value;

        } else {
            $data = \App\Models\SystemSetting\OtpSetting::whereNull('client_id')->first();
        }
        return $data;
    }
}
