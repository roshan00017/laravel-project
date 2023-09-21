<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Roles\MenuRequest;
use App\Models\Roles\Menu;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class MenuController extends BaseController
{
    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 4;

    public function __construct(Menu $menu, LogsRepository $logsRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($menu);
        $this->logsRepository = $logsRepository;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            //check foreign key from  users child table
            $userRole = $this->model->checkForeignKey($id);

            if ($userRole < 1) {
                DB::beginTransaction();
                $menu = $this->model->find($id);
                $this->model->delete($id);
                // insert log
                $this->logsRepository->insertLog($menu->id, $this->menuId, $this->menuId);
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menus'] = $this->model->all();
        $data['parentList'] = Menu::all();
        $data['page_url'] = 'roleManagement/menus';
        $data['page_route'] = 'menus';

        return view('backend.roleManagement.menu', $data);
    }

    public function status($id): RedirectResponse
    {
        try {
            $id = (int) $id;
            //check foreign key from  users child table
            $userRole = $this->model->checkForeignKey($id);
            if ($userRole < 1) {
                $menu = Menu::find($id);
                if ($menu->status == 0) {
                    DB::beginTransaction();
                    $this->model->status($menu->id, 1);
                    // insert log
                    $this->logsRepository->insertLog($menu->id, $this->menuId, 5);
                    DB::commit();
                    session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
                } elseif ($menu->status == 1) {
                    $this->model->status($menu->id, 0);
                    // insert log
                    $this->logsRepository->insertLog($menu->id, $this->menuId, 5);
                    DB::commit();
                    session()->flash('success', Lang::get('message.flash_messages.statusInactiveMessage'));
                }
            } else {
                session()->flash('warning', Lang::get('message.flash_messages.warningMessage'));
            }

            return back();
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $create = $this->model->create($request->all());
            // insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, int $id): RedirectResponse
    {
        try {
            $menu = $this->model->find($id);
            DB::beginTransaction();
            $this->model->update($request->all(), $id);
            // insert log
            $this->logsRepository->insertLog($menu->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
