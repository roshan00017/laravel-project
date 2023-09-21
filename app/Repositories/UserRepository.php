<?php

namespace App\Repositories;

use App\Models\User;
use App\SInterFace\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll($request = null)
    {
        $query = User::query()
            ->leftJoin('appointment_access_users as aau', 'users.id', '=', 'aau.user_id');
        $orderBy = getLan() == 'np' ? 'full_name_np' : 'full_name';
        if (!empty($request->role_id)) {
            $query->where('role_id', $request->role_id);
        }

        if (!empty($request->email)) {
            $query->where('users.email', $request->email);
        }

        if (!empty($request->login_user_name)) {
            $query->where('users.login_user_name', $request->login_user_name);
        }

        if ($request->status != null) {
            $query->where('users.status', $request->status);
        }
        if ($request->client_id != null) {
            $query->where('users.client_id', $request->client_id);
        }

        if (userInfo()->role_id > 2) {
            $query = $query->whereNot('users.role_id', 2);
            CommonRepository::checkClientId($query);
            if (userInfo()->user_module != 'client_admin') {
                $query = $query->where('users.user_module', userInfo()->user_module);
            }
        }

        $query = CommonRepository::getCommonData($request, $query);

        return $query
            ->select('users.*', 'aau.access_user_type', 'aau.appointment_access_user_id')
            ->whereNotIn('users.role_id', [1])
            ->where('users.id', '<>', auth()->user()->id)
            ->orderBy($orderBy, 'ASC')
            ->paginate(10);
    }
}