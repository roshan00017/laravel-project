<?php

namespace App\Http\Middleware;

use App\Models\Roles\Menu;
use Closure;

class RolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function handle($request, Closure $next): mixed
    {
        /* Retrieves the action from request and gets the Controller Name and Method Name*/
        $action = app('request')->route()->getAction();

        /*
         * Splits the controller and store in array
         */
        $controllers = explode('@', class_basename($action['controller']));
        /*
         * Checks the existence of controller and method
         */
        $controller_name = $controllers[0] ?? '';
        $method_name = $controllers[1] ?? '';

        /*
         *List of controller where permissions are not necessary
         */

        $publicController = ['HomeController'];

        /*
         * checks the controller in array where permission are not allowed
         */
        if (! in_array($controller_name, $publicController)) {
            /*
             * Joins User Roles and Menus on the basis of user_type_id from user_roles and menu_controller from menus
             */
            $value = Menu::join('user_roles', 'menus.id', '=', 'user_roles.menu_id')
                ->select('user_roles.*', 'menus.*')
                ->where([
                    ['role_id', '=', userInfo()->role_id],
                    ['menu_controller', '=', $controller_name],
                ])
                ->first();
            if (is_null($value) && userInfo()->role_id > 1) {
                $this->sorry();
            } else {
                /*
                 * List of method where permissions are checked
                 */
                $arr = ['index', 'create', 'edit', 'destroy', 'show'];

                /*
                 * Search whether the method name exist in the array
                 */
                if (in_array($method_name, $arr)) {
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

                    switch ($method_name) {
                        case 'index':
                            if ($isIndex == false) {
                                $this->sorry();
                            }
                            break;
                        case 'create':
                            if ($isAdd == false) {
                                $this->sorry();
                            }
                            break;
                        case 'edit':
                            if ($isEdit == false) {
                                $this->sorry();
                            }
                            break;
                        case 'destroy':
                            if ($isDelete == false) {
                                $this->sorry();
                            }
                            break;
                        case 'show':
                            if ($isShow == false) {
                                $this->sorry();
                            }
                            break;
                    }
                }
            }
        }

        return $next($request);
    }

    public function sorry()
    {
        abort(401);
    }
}
