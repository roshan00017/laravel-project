<?php

namespace App\SInterFace\Roles;

interface MenuRepositoryInterface
{
    public static function getAccessMenu($id, $type_id);

    public static function getMenu($id);

    public static function getMenus();

    public static function getMenuLink($controllerName);
}
