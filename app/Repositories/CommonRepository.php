<?php

namespace App\Repositories;

use App\Models\Roles\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CommonRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->orderBy('id', 'DESC')->paginate(10);
    }

    // create a new record in the database
    public function create(array $data)
    {

        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->find($id);

        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        $data = $this->model->findOrFail($id);

        return $data->delete();
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel(): Model
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model): static
    {
        $this->model = $model;

        return $this;
    }

    // Eager load database relationships
    public function with($relations): Builder
    {
        return $this->model->with($relations);
    }

    // find the record with the given id
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    //count record form table
    public function getTotalData($column_name = null, $column_value = null)
    {
        $data = $this->model;
        if (! empty($column_name)) {
            $data = $data->where($column_name, $column_value);
        }

        return $data
            ->count();
    }

    /* check foreign key form child table */
    public function checkForeignKey($foreignColumnName, $foreignId)
    {
        return $this->model
            ->where($foreignColumnName, $foreignId)
            ->count();
    }

    /* update  status from user request */
    public function status($id, $status)
    {
        return $this->model->where('id', $id)->update(['status' => $status]);
    }

    public function isInvite($id, $status)
    {
        return $this->model->where('id', $id)->update(['is_invite' => $status]);
    }

    // find last record
    public function findLastRecord($selectColumnName)
    {
        return $this->model->select($selectColumnName)->latest()->limit(1)->first();
    }

    public function getData($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        if ($request->name != null) {
            $result = $result
                ->where('name_en', 'LIKE', '%'.$request->name.'%')
                ->orWhere('name_np', 'LIKE', '%'.$request->name.'%');
        }
        $orderBy = getLan() == 'np' ? 'name_np' : 'name_en';

        return $result->orderBy($orderBy, 'ASC')
            ->paginate(10);
    }

    public function getFiscalYearData($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }

        return $result->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getFyStatus()
    {
        return $this->model
            ->where('status', '1')
            ->get();
    }

    public function getOtpSetting($request)
    {
        $result = $this->model;

        if ($request->client_id != null) {
            $result = $result->where('client_id', $request->client_id);
        }

        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }

        if ($request->name != null) {
            $result = $result
                ->where('otp_limit', 'LIKE', '%'.$request->name.'%')
                ->orWhere('otp_duration', 'LIKE', '%'.$request->name.'%');
        }
        $this->checkClientId($result);

        return $result->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getSmsSetting($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }

        if ($request->client_id != null) {
            $result = $result->where('client_id', $request->client_id);
        }

        if ($request->name != null) {
            $result = $result
                ->where('sms_token', 'LIKE', '%'.$request->name.'%')
                ->orWhere('sms_from', 'LIKE', '%'.$request->name.'%');
        }

        $this->checkClientId($result);

        return $result->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getMailSetting($request)
    {
        $result = $this->model;

        if ($request->client_id != null) {
            $result = $result->where('client_id', $request->client_id);
        }
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        $this->checkClientId($result);

        return $result->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public static function getCommonData($request, $result, $school_id = null, $student_id = null, $module = null)
    {
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        if ($request->mobile_no != null) {
            $result = $result->where('mobile_no', $request->mobile_no);
        }
        if ($request->email != null) {
            $result = $result->where('email', $request->email);
        }

        if ($request->name != null) {
            $result = $result
                ->where('name_en', 'LIKE', '%'.$request->name.'%')
                ->orWhere('name_np', 'LIKE', '%'.$request->name.'%');
        }

        return $result;
    }

    public function getRoleData($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        if ($request->client_id != null) {

            $result = $result->where('client_id', $request->client_id);
        }
        if ($request->name != null) {
            $result = $result
                ->where('name_en', 'LIKE', '%'.$request->name.'%')
                ->orWhere('name_np', 'LIKE', '%'.$request->name.'%');
        }
        if (userInfo()->role_id > 1) {
            if (userInfo()->role_id > 2) {
                $result = $result->where('client_id', userInfo()->client_id)
                    ->orWhere('role_level', 'all_client');
            }
            $result->whereNot('id', 1);
        }
        $orderBy = getLan() == 'np' ? 'name_np' : 'name_en';

        return $result->orderBy($orderBy, 'ASC')
            ->paginate(10);
    }

    public static function roleList()
    {
        $result = Role::query();
        if (userInfo()->role_id > 1) {
            if (userInfo()->role_id > 2) {
                $result = $result->where('client_id', userInfo()->client_id)
                    ->orWhere('role_level', 'all_client');
            }
        }

        return $result->whereNot('id', 1);
    }

    public static function getCommonCountData($model)
    {
        $result = $model;

        return $result->count();
    }

    public function getCategory($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        if ($request->name != null) {
            $result = $result
                ->where('name_en', 'LIKE', '%'.$request->name.'%')
                ->orWhere('name_np', 'LIKE', '%'.$request->name.'%');
        }
        $orderBy = getLan() == 'np' ? 'name_np' : 'name_en';

        return $result->orderBy($orderBy, 'ASC')
            ->paginate(10);
    }

    public function getMeetingMemberList($request)
    {
        $result = $this->model;
        if ($request->is_invite != null) {
            $result = $result->where('is_invite', $request->is_invite);
        }
        if ($request->name != null) {
            $result = $result
                ->where('name_en', 'LIKE', '%'.$request->name.'%')
                ->orWhere('name_np', 'LIKE', '%'.$request->name.'%');
        }
        $orderBy = getLan() == 'np' ? 'name_np' : 'name_en';

        if (! empty($request->email)) {
            $result = $result
                ->where('email', $request->email);
        }

        if (! empty($request->meeting_id)) {
            $result = $result
                ->where('meeting_id', $request->meeting_id);
        }

        if (! empty($request->contact_no)) {
            $result = $result
                ->where('contact_no', $request->contact_no);
        }

        return $result->orderBy($orderBy, 'ASC')
            ->paginate(10);
    }

    public function getAgenda($request)
    {
        $result = $this->model;

        if (! empty($request->title)) {
            $result = $result
                ->where('title', $request->title);
        }

        if (! empty($request->description)) {
            $result = $result
                ->where('description', $request->description);
        }

        if (! empty($request->meeting_id)) {
            $result = $result
                ->where('meeting_id', $request->meeting_id);
        }

        return $result->orderBy('id', 'ASC')
            ->paginate(10);
    }

    public function getFinalVerdict($request)
    {
        $result = $this->model;

        if (! empty($request->meeting_id)) {
            $result = $result
                ->where('meeting_id', $request->meeting_id);
        }

        return $result->orderBy('id', 'ASC')
            ->paginate(10);
    }

    public function getFinalVerdictFile($request)
    {
        $result = $this->model;

        if (! empty($request->meeting_id)) {
            $result = $result
                ->where('meeting_id', $request->meeting_id);
        }

        return $result->orderBy('id', 'ASC')
            ->paginate(10);
    }

    public function getFyData($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        if ($request->code != null) {
            $result = $result->where('code', $request->code);
        }

        return $result->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getHrDesignation($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        if ($request->code != null) {
            $result = $result
                ->where('code', $result->code);
        }

        return $result->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getComplaintList($request)
    {
        $result = $this->model;
        $orderBy = getLan() == 'np' ? 'name_ne' : 'name_en';

        return $result->orderBy($orderBy, 'ASC')
            ->paginate(10);
    }

    public function getSuggestion($request)
    {
        $result = $this->model;
        if ($request->suggestion_category_id != null) {
            $result = $result->where('suggestion_category_id', $request->suggestion_category_id);
        }

        return $result->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getFilterData($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        if ($request->name != null) {
            $result = $result
                ->where('name', 'LIKE', '%'.$request->name.'%')
                ->orWhere('name_ne', 'LIKE', '%'.$request->name.'%');
        }
        $orderBy = getLan() == 'np' ? 'name_ne' : 'name';

        return $result->orderBy($orderBy, 'ASC')
            ->paginate(10);
    }

    //check client id data
    public static function checkClientId($result)
    {
        if (systemAdmin() == false) {
            return $result->where('client_id', userInfo()->client_id);
        }
    }

    //client-setting
    public function getClientSetting($request)
    {

        $result = $this->model;
        if ($request->setting_code != null) {
            $result = $result->where('setting_code', $request->setting_code);
        }
        if ($request->client_id != null) {
            $result = $result->where('client_id', $request->client_id);
        }
        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($result);
        }

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getApiKeyData($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        if ($request->name != null) {
            $result = $result
                ->where('name', 'LIKE', '%'.$request->name.'%');
        }

        return $result->orderBy('name', 'ASC')
            ->paginate(10);
    }

    public function getMstSetting($request)
    {

        $result = $this->model;

        if ($request->client_id != null) {
            $result = $result->where('client_id', $request->client_id);
        }

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getkaryapalikaMembers($request)
    {
        $result = $this->model;
        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }
        if ($request->name != null) {
            $result = $result
                ->where('name_en', 'LIKE', '%'.$request->name.'%')
                ->orWhere('name_np', 'LIKE', '%'.$request->name.'%');
        }
        $orderBy = getLan() == 'np' ? 'name_np' : 'name_en';

        if ($request->email != null) {
            $result = $result->where('email', $request->email);
        }
        if ($request->mobile != null) {
            $result = $result->where('mobile', $request->mobile);
        }

        return $result->orderBy($orderBy, 'ASC')
            ->paginate(10);
    }

    public function getEmployeeList($request)
    {
        $result = $this->model;
        if ($request->first_name_en != null) {
            $result = $result
                ->where('first_name_en', 'LIKE', '%'.$request->first_name_en.'%')
                ->orWhere('first_name_np', 'LIKE', '%'.$request->first_name_np.'%');
        }
        $orderBy = getLan() == 'np' ? 'first_name_np' : 'first_name_en';

        if (! empty($request->email)) {
            $result = $result
                ->where('email', $request->email);
        }

        if (! empty($request->phone_number)) {
            $result = $result
                ->where('phone_number', $request->phone_number);
        }

        return $result->orderBy($orderBy, 'DESC')
            ->paginate(10);
    }

    public static function appointUserModule($query, $access_type, $access_user)
    {
        if (userInfo()->user_module == 'app') {
            return $query->where([$access_type => appointAccessInfo()->access_user_type, $access_user => appointAccessInfo()->appointment_access_user_id]);
        }
    }

    public static function fiscalYearData($query, $request)
    {
        if (is_null($request->fy_id)) {
            return $query->where('fy_id', currentFy()->id);
        } else {
            return $query->where('fy_id', $request->fy_id);
        }
    }
}
