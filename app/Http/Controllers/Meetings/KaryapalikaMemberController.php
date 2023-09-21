<?php

namespace App\Http\Controllers\Meetings;

use App\Helpers\FileUploadLibraryHelper;
use App\Http\Controllers\Controller;
use App\Models\Meetings\KaryapalikaMember;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class KaryapalikaMemberController extends Controller
{
    private int $fileHeight = 128;

    private int $fileWidth = 128;

    protected CommonRepository $model;

    protected LogsRepository $logsRepository;

    private int $menuId = 45;

    public function __construct(KaryapalikaMember $model, LogsRepository $logsRepository)
    {
        $this->model = new CommonRepository($model);
        $this->logsRepository = $logsRepository;
    }

    public function index(Request $request)
    {

        try {
            $data['page_url'] = 'masterSettings/karyapalikaMembers';
            $data['page_route'] = 'karyapalikaMembers';
            $data['results'] = $this->model->getkaryapalikaMembers($request);
            $data['page_title'] = getLan() == 'np' ? 'कार्यपालिका सदस्यहरु' : 'Karyapalika Members';
            $data['request'] = $request;
            $data['show_button'] = true;
            $data['filePath'] = KaryapalikaMember::KARYAPALIKA_MEMBER_PROFILE_PATH;
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'js/custom_app.min.js',
                'js/check_data.min.js',
                'js/image_validation.min.js',
            ];
            $name = getLan() == 'np' ? 'name_np' : 'name_en';

            $data['script_js'] = "$(function(){
                $('.mobile').inputmask('9999999999', { 'placeholder': '98xxxxxxxx' })
            })";

            return view('backend.meetingManagement.karyapalikaMembers.index', $data);
        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            // Check if image file is uploaded
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = FileUploadLibraryHelper::setFileUploadName($image, $request->full_name);
                $data['image'] = $fileName;

                //set image path
                if ($data['image'] = $fileName) {
                    FileUploadLibraryHelper::setFileUploadPath($request->image, $data['image'], KaryapalikaMember::KARYAPALIKA_MEMBER_PROFILE_PATH, $this->fileWidth, $this->fileHeight);
                }
            }

            // Start transaction and create the record
            DB::beginTransaction();
            $create = $this->model->create($data);

            // Insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 1);

            // Commit transaction and display success message
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $member = $this->model->find($id);
            $data = $request->all();

            if ($member) {
                if ($member->image != null) {
                    FileUploadLibraryHelper::deleteExistingFile($member->image, KaryapalikaMember::KARYAPALIKA_MEMBER_PROFILE_PATH);
                }
                if (! empty($request->file('image'))) {
                    $data['image'] = FileUploadLibraryHelper::setFileUploadName($request->image, short_hash($member->full_name, 30).$member->login_member_name);
                    $imageSuccess = true;
                }
                DB::beginTransaction();
                $update = $this->model->update($data, $id);
                if ($update) {
                    if (isset($imageSuccess)) {
                        FileUploadLibraryHelper::setFileUploadPath($request->image, $data['image'], KaryapalikaMember::KARYAPALIKA_MEMBER_PROFILE_PATH, $this->fileWidth, $this->fileHeight);
                    }
                }
            }
            // insert log
            $this->logsRepository->insertLog($member->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $value = $this->model->find($id);

            if ($value) {
                if ($value->image != null) {
                    FileUploadLibraryHelper::deleteExistingFile($value->image, KaryapalikaMember::KARYAPALIKA_MEMBER_PROFILE_PATH);
                }
                DB::beginTransaction();
                $data['deleted_by'] = auth()->user()->id;
                $this->model->update($data, $id);
                $this->model->delete($id);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 4);
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

    public function status($id): RedirectResponse
    {
        try {
            $id = (int) $id;
            $user = $this->model->find($id);
            if ($user->status == 0) {
                DB::beginTransaction();
                $this->model->status($user->id, 1);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 5);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($user->status == 1) {
                DB::beginTransaction();
                $this->model->status($user->id, 0);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 5);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusInactiveMessage'));
            }

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
