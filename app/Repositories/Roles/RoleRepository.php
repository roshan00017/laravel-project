<?php

namespace App\Repositories\Roles;

use App\Models\Roles\Menu;
use App\Models\Roles\Role;
use App\Models\Roles\UserRole;
use App\SInterFace\Roles\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function checkMenu($role_id, $menu_id)
    {
        return UserRole::where('role_id', '=', $role_id)
            ->where('menu_id', '=', $menu_id)
            ->count();
    }

    public function copyMenu($role_id)
    {
        if ($role_id != 0) {
            $menus = Menu::all();
            foreach ($menus as $menu) {
                if ($this->checkMenu($role_id, $menu->id) == 0) {
                    // dd($this->checkMenu($role_id, $menu->id));
                    UserRole::create(
                        [
                            'role_id' => $role_id,
                            'menu_id' => $menu->id,
                            'allow_index' => 0,
                            'allow_add' => 0,
                            'allow_edit' => 0,
                            'allow_delete' => 0,
                            'allow_show' => 0,
                        ]
                    );
                }
            }
        }
    }

    public function changePermission($allowId, $id)
    {
        if ($allowId == 1) {
            $value = UserRole::where('id', '=', $id)
                ->select('allow_index')->first();
            if ($value->allow_index == 1) {
                UserRole::where('id', '=', $id)
                    ->update(['allow_index' => ($value->allow_index == '1') ? '0' : '1', 'allow_add' => '0',
                        'allow_edit' => '0', 'allow_delete' => '0', 'allow_show' => '0', ]);
            } else {
                UserRole::where('id', '=', $id)
                    ->update(['allow_index' => ($value->allow_index == '1') ? '0' : '1']);
            }
        } elseif ($allowId == 2) {
            $value = UserRole::where('id', '=', $id)
                ->select('allow_add')->first();
            if ($value->allow_add == 0) {
                UserRole::where('id', '=', $id)
                    ->update(['allow_add' => ($value->allow_add == '1') ? '0' : '1', 'allow_index' => '1']);
            } else {
                UserRole::where('id', '=', $id)
                    ->update(['allow_add' => ($value->allow_add == '1') ? '0' : '1']);
            }
        } elseif ($allowId == 3) {
            $value = UserRole::where('id', '=', $id)
                ->select('allow_edit')->first();
            if ($value->allow_edit == 0) {
                UserRole::where('id', '=', $id)
                    ->update(['allow_edit' => ($value->allow_edit == '1') ? '0' : '1', 'allow_index' => '1']);
            } else {
                UserRole::where('id', '=', $id)
                    ->update(['allow_edit' => ($value->allow_edit == '1') ? '0' : '1']);
            }
        } elseif ($allowId == 4) {
            $value = UserRole::where('id', '=', $id)
                ->select('allow_delete')->first();
            if ($value->allow_delete == 0) {
                UserRole::where('id', '=', $id)
                    ->update(['allow_delete' => ($value->allow_delete == '1') ? '0' : '1', 'allow_index' => '1']);
            } else {
                UserRole::where('id', '=', $id)
                    ->update(['allow_delete' => ($value->allow_delete == '1') ? '0' : '1']);
            }
        } elseif ($allowId == 5) {
            $value = UserRole::where('id', '=', $id)
                ->select('allow_show')->first();
            if ($value->allow_show == 0) {
                UserRole::where('id', '=', $id)
                    ->update(['allow_show' => ($value->allow_show == '1') ? '0' : '1', 'allow_index' => '1']);
            } else {
                UserRole::where('id', '=', $id)
                    ->update(['allow_show' => ($value->allow_show == '1') ? '0' : '1']);
            }
        } elseif ($allowId == 6) {
            $value = UserRole::where('id', '=', $id)
                ->select('allow_index')->first();
            if ($value->allow_index == 0) {
                UserRole::where('id', '=', $id)
                    ->update(['allow_index' => 1, 'allow_add' => 1, 'allow_edit' => 1, 'allow_delete' => 1, 'allow_show' => 1]);
            } else {
                UserRole::where('id', '=', $id)
                    ->update(['allow_index' => 0, 'allow_add' => 0, 'allow_edit' => 0, 'allow_delete' => 0, 'allow_show' => 0]);
            }
        }
    }

    public static function roleList()
    {
        $name = getLan() == 'np' ? 'name_np' : 'name_en';
        $result = Role::query()
            ->select('id', $name.' '.'as name');
        if (userInfo()->role_id > 2) {

            $result = $result->where('client_id', userInfo()->client_id)
                ->orWhere('role_level', 'all_client');
        }

        return $result->whereNotIn('id', [1,  userInfo()->role_id])->orderBy('id', 'DESC')
            ->get();
    }
}
