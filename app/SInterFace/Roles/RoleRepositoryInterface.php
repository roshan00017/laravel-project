<?php

namespace App\SInterFace\Roles;

interface RoleRepositoryInterface
{
    public function checkMenu($role_id, $menu_id);

    public function copyMenu($role_id);

    public function changePermission($role_id, $id);
}
