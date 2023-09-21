<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\BaseController;
use App\Repositories\Roles\MenuRepository;
use App\Repositories\Roles\RoleRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class PermissionController extends BaseController
{
    private RoleRepository $roleRepository;

    private MenuRepository $menuRepository;

    public function __construct(MenuRepository $menuRepository, RoleRepository $roleRepository)
    {
        parent::__construct();
        $this->menuRepository = $menuRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['roleList'] = $this->roleRepository->roleList();

            if ($request->has('role_id')) {
                $role_id = $request->get('role_id');
            } else {
                $role_id = 0;
            }

            if ($request->has('role_id')) {
                $data['menus'] = $this->menuRepository->getAccessMenu(0, $role_id);
            } else {
                $menus = 0;
            }

            $this->roleRepository->copyMenu($role_id);
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/permission.js',

            ];
            $data['page_title'] = getLan() == 'np' ? 'भूमिका पहुँच' : 'Permissions';
            $data['menuRepo'] = $this->menuRepository;

            return view('backend.roleManagement.permissions', $data);
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('app.technicalError'));

            return back();
        }
    }

    public function changeAccess($allowId, $id)
    {
        $this->roleRepository->changePermission($allowId, $id);
    }
}
