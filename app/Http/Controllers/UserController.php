<?php

namespace App\Http\Controllers;

use App\Events\RegisterUsersEvent;
use App\Helpers\FileUploadLibraryHelper;
use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\Users\UserPasswordRequest;
use App\Http\Requests\Users\UserRequest;
use App\Models\Appointment\AppointmentAccessUser;
use App\Models\BasicDetails\ElectedPerson;
use App\Models\BasicDetails\HrDesignation;
use App\Models\BasicDetails\VisitingPurpose;
use App\Models\EDMIS\Employee;
use App\Models\EDMIS\MemberType;
use App\Models\Logs\LoginFails;
use App\Models\Logs\LoginLogs;
use App\Models\User;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use App\Repositories\Roles\RoleRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    private int $fileHeight = 128;

    private int $fileWidth = 128;

    protected CommonRepository $model;

    private UserRepository $userRepository;

    private LogsRepository $logsRepository;

    private int $menuId = 5;

    public function __construct(
        User $user,
        UserRepository $userRepository,
        LogsRepository $logsRepository,

    ) {
        parent::__construct();
        // set the model
        $this->model = new CommonRepository($user);
        $this->userRepository = $userRepository;
        $this->logsRepository = $logsRepository;

    }

    /* update user block status */
    public function blockStatus(int $id): RedirectResponse
    {
        try {
            $user = $this->model->find($id);
            if ($user->block_status == 1) {
                DB::beginTransaction();
                User::where('id', $user->id)
                    ->update(['block_status' => 0]);
                //update log fails table
                LoginFails::where('user_id', $id)
                    ->update(['login_fail_count' => null]);
                //create action log
                $this->logsRepository->insertLog($user->id, $this->menuId, 7);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.unBlockStatusMessage'));
            } else {
                session()->flash('error', Lang::get('message.flash_messages.errorStatusMessage'));
            }

            return back();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(int $id): RedirectResponse
    {
        try {

            $user = $this->model->find($id);
            if ($user) {
                //delete existing image
                if ($user->image != null) {
                    FileUploadLibraryHelper::deleteExistingFile($user->image, User::USER_PROFILE_PATH);
                }
                DB::beginTransaction();
                $this->model->delete($id);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 4);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.deleteMessage'));

                return back();
            }
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        try {


            $data['roleList'] = RoleRepository::roleList();
            $data['results'] = $this->userRepository->getAll($request);
            $data['roleTypes'] = CommonRepository::roleList();
            $data['totalResult'] = $data['results']->total();
            $data['request'] = $request;
            $data['page_url'] = 'users';
            $data['page_route'] = 'users';
            $data['visitingPurposeList'] = VisitingPurpose::orderby('id', 'desc')->get();
            $data['employeeList'] = Employee::orderBy('id', 'desc')->get();
            $data['electedPersonList'] = ElectedPerson::orderBy('id', 'desc')->get();
            $data['memberTypeList'] = MemberType::orderBy('id', 'desc')->get();
            $data['hrDesignationList'] = HrDesignation::orderBy('id', 'desc')->get();

            $data['load_css'] = [
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/check_data.min.js',
                'js/image_validation.min.js',
                'js/role.min.js',
                'js/dataSubmit.js',
                'js/user.min.js',
                'js/UserAppointment.js',

            ];
            //check add client info
            $data['clientSmsInfo'] = User::query()->where('client_id', '=', userInfo()->client_id)->count();
            $data['page_title'] = getLan() == 'np' ? 'प्रयोगकर्ता व्यवस्थापन' : 'Users Management';
            $data['show_button'] = true;
            $data['filePath'] = User::USER_PROFILE_PATH;


            return view('backend.users.index', $data);
        } catch (Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    //check user profile link
    public function profile()
    {
        try {
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'js/check_data.min.js',
                'js/image_validation.min.js',
                'js/user.min.js',

            ];
            $checkLogin = LoginLogs::query()
                ->where('user_id', userInfo()->id)
                ->latest()->first();
            if (isset($checkLogin->created_at)) {
                $data['lastLogin'] = Carbon::createFromTimeStamp(strtotime($checkLogin->created_at))->diffForHumans();
            }
            $data['page_title'] = getLan() == 'np' ? 'मेरो प्रोफाइल' : 'My Profile';
            $data['userInfo'] = userInfo();
            $data['page_url'] = 'users';

            return view('backend.users.profile', $data);
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    //update profile pic
    public function profilePic(UploadFileRequest $request)
    {
        try {
            $value = $this->model->find(auth()->user()->id);
            if ($value) {
                if ($value->image != null) {
                    FileUploadLibraryHelper::deleteExistingFile($value->image, User::USER_PROFILE_PATH);
                }
                $fileName = FileUploadLibraryHelper::setFileUploadName($request->update_file, short_hash($value->full_name, 30) . $value->login_user_name);
                $imageSuccess = true;
                $update = User::where('id', $value->id)->update(['image' => $fileName]);
                if ($update) {

                    if (isset($imageSuccess)) {
                        FileUploadLibraryHelper::setFileUploadPath($request->update_file, $fileName, User::USER_PROFILE_PATH, $this->fileWidth, $this->fileHeight);
                    }
                    session()->flash('success', Lang::get('message.commons.imageUploadSuccess'));
                } else {
                    session()->flash('error', Lang::get('message.commons.imageUploadFailed'));
                }
            }

            return back();
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    //update status from user request
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
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            // Set client id from client if it's null
            if (is_null($request->client_id)) {
                $data['client_id'] = userInfo()->client_id;
            }

            $data['full_name'] = 'asdf';
            $data['email'] = Str::lower($request->email);
            $data['login_user_name'] = Str::lower($request->login_user_name);


            // Check request random password
            if ($request->rand_password == 1) {
                $password = rand_string(8);
                $data['password'] = bcrypt($password);
            }

            $password = rand_string(8);
            $data['password'] = bcrypt($password);

            //check image form request
            if (!empty($request->file('image'))) {
                if (!empty($request->file('image'))) {
                    $data['image'] = FileUploadLibraryHelper::setFileUploadName($request->image, $request->full_name);
                    $imageSuccess = true;
                }
            }

            $data['created_by'] = userInfo()->id;


            // Begin database transaction
            DB::beginTransaction();

            // Create the user record
            $create = $this->model->create($data);
            #check for appointment module user 
            if ($request->user_module == 'app') {

                if ($request->visiting_section == 'om') {
                    $accessUserData = [
                        'access_user_type' => $request->visiting_section,
                        'user_id' => $create->id,
                        'appointment_access_user_id' => $request->employee_id,
                    ];
                } elseif ($request->visiting_section == 'km') {
                    $accessUserData = [
                        'access_user_type' => $request->visiting_section,
                        'user_id' => $create->id,
                        'appointment_access_user_id' => $request->elected_person_id,
                    ];
                }

                AppointmentAccessUser::create($accessUserData);
            }

            // Insert log
            $this->logsRepository->insertLog($create->id, $this->menuId, 1);

            // Set image path
            if (isset($data['image'])) {
                FileUploadLibraryHelper::setFileUploadPath($request->image, $data['image'], User::USER_PROFILE_PATH, $this->fileWidth, $this->fileHeight);
            }

            // Check user request email sent
            if ($request->send_email == 1) {
                if ($request->rand_password == 1) {
                    $data['user_password'] = rand_string(8);
                } else {
                    $data['user_password'] = $request->password;
                }
                RegisterUsersEvent::dispatch($data);
            }

            DB::commit();

            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));


        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $user = $this->model->find($id);
            $data = $request->all();
            if ($request->user_module == 'app') {
                if ($request->visiting_section == 'om') {
                    $accessUserData = [
                        'access_user_type' => $request->visiting_section,
                        'user_id' => $user->id,
                        'appointment_access_user_id' => $request->employee,
                    ];
                } elseif ($request->visiting_section == 'km') {
                    $accessUserData = [
                        'access_user_type' => $request->visiting_section,
                        'user_id' => $user->id,
                        'appointment_access_user_id' => $request->elected_person_id,
                    ];
                }
                AppointmentAccessUser::updateOrCreate(['user_id' => $user->id], $accessUserData);
            }


            if ($user) {
                if ($user->image != null) {
                    FileUploadLibraryHelper::deleteExistingFile($user->image, User::USER_PROFILE_PATH);
                }
                if (!empty($request->file('image'))) {
                    $data['image'] = FileUploadLibraryHelper::setFileUploadName($request->image, short_hash($user->full_name, 30) . $user->login_user_name);
                    $imageSuccess = true;
                }
                DB::beginTransaction();
                $data['updated_by'] = userInfo()->id;
                $update = $this->model->update($data, $id);
                if ($update) {
                    if (isset($imageSuccess)) {
                        FileUploadLibraryHelper::setFileUploadPath($request->image, $data['image'], User::USER_PROFILE_PATH, $this->fileWidth, $this->fileHeight);
                    }
                }
            }
            // insert log
            $this->logsRepository->insertLog($user->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (Exception $e) {
            dd($e);

            DB::rollback();
            session()->flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }


    //update user password
    public function updatePassword(UserPasswordRequest $request): RedirectResponse
    {
        try {
            $user = '';
            if ($request->user_id != null) {
                if (is_null($request->password)) {
                    session()->flash('error', Lang::get('पासवर्ड  फिल्ड खाली हुनु भएन '));

                    return back();
                }
                $user = User::where('id', $request->user_id)->first();
            } else {
                if (Hash::check($request->input('old'), auth()->user()->password)) {
                    $user = User::where('id', auth()->user()->id)->first();
                } else {
                    session()->flash('error', 'Error Occurred!! Old password incorrect!');
                }
            }
            if ($user) {
                $request['password'] = Hash::make($request->input('password'));
                DB::beginTransaction();
                $this->model->update($request->all(), $user->id);
                DB::commit();
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 9);
                Auth::logout();

                $request->session()->flush();

                $request->session()->regenerate();
                session()->flash('success', trans('auth.login.password_update_message'));

                return redirect('/login');
            }

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    //update user profile
    public function updateProfile(UserRequest $request)
    {
        try {
            $user = $this->model->find(auth()->user()->id);

            if ($user) {
                DB::beginTransaction();
                $this->model->update($request->all(), $user->id);
                // insert log
                $this->logsRepository->insertLog($user->id, $this->menuId, 2);
                DB::commit();
                session()->flash('success', 'Your profile successfully updated!');

                return back();
            }
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /* delete existing file */
    public function deleteFile(Request $request): RedirectResponse
    {
        try {
            $value = $this->model->find($request->id ? $request->id : userInfo()->id);
            if ($value) {
                FileUploadLibraryHelper::deleteExistingFile($value->image, User::USER_PROFILE_PATH);
                User::where('id', $value->id)->update(['image' => null]);
                session()->flash('success', Lang::get('message.commons.imageDeletedSuccess'));
            } else {
                session()->flash('error', Lang::get('message.commons.imageDeletedFailed'));
            }

            return back();
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function checkData(Request $request): JsonResponse
    {
        try {
            $data = $this->model->find($request->id);

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Data Successfully Fetch !',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $value = User::query()->where('id', $request->id)->firstOrFail();
            $resetPassword = $value->login_user_name . rand_string(6);
            $name = getLan() == 'np' ? $value->full_name_np : $value->full_name;
            if ($value) {
                $password = Hash::make($resetPassword);
                $token = Str::random(100);
                DB::beginTransaction();
                User::where('id', $value->id)->update(['password' => $password, 'password_reset_token' => $token, 'password_reset_created_at' => Carbon::now()]);
                DB::commit();
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 9);
                //sent to email
                $data = [
                    'userName' => $name,
                    'password' => $resetPassword,
                    'token' => $token,
                    'email' => $value->email,
                    'login_user_name' => $value->login_user_name,
                    'type' => 'user',
                ];
                // passwordResetEvent($data);
                // session()->flash('success', $name . ' ' . $title . ' '. ($resetPassword). Lang::get('message.pages.common.password_reset_message'));
                session()->flash('success', $name . ' ' . Lang::get('passwords.user_password') . ' ' . Lang::get('message.pages.common.password_reset_message') . ' ' . Lang::get('passwords.reset_password_info'));

                return response()->json([
                    'status' => true,
                    'success' => $name . ' ' . Lang::get('message.pages.common.password_reset_message') . ' ' . Lang::get('message.pages.common.password_reset_message'),
                ]);

                //return back();
            }
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function appointmentInfo(Request $request)
    {
        $data['visitingPurposeList'] = VisitingPurpose::orderby('id', 'desc')->get();

        $data['employeeList'] = Employee::orderBy('id', 'desc')->get();
        $data['electedPersonList'] = ElectedPerson::orderBy('id', 'desc')->get();
        $data['memberTypeList'] = MemberType::orderBy('id', 'desc')->get();
        $data['hrDesignationList'] = HrDesignation::orderBy('id', 'desc')->get();
        $data['page_title'] = getLan() == 'np' ? 'भेट घाट व्यवस्थापन' : 'Appointment';
        $data['page_url'] = '/appointments';
        $data['page_route'] = 'appointments';
        $data['request'] = $request;

        $data['load_css'] = [
            'plugins/select2/css/select2.css',
            'plugins/datepicker/english/english-datepicker.css',
            'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
            'plugins/bs-stepper/css/bs-stepper.css',
        ];

        $data['load_js'] = [
            'plugins/select2/js/select2.full.min.js',
            'plugins/input-mask/jquery/inputmask.min.js',
            'plugins/input-mask/jquery/date_extension.min.js',
            'plugins/input-mask/jquery/extension.min.js',
            'plugins/select2/js/select2.full.min.js',
            'plugins/datepicker/english/english-datepicker.min.js',
            'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
            'js/custom_app.min.js',
            'js/dateConverter.js',
            'plugins/bs-stepper/js/bs-stepper.js',
            'js/appointment.js',
        ];
        $data['script_js'] = "$(function(){
            document.addEventListener('DOMContentLoaded', function () {
              window.stepper = new Stepper(document.querySelector('.bs-stepper'));
            });
            })";
        $data['appointment'] = $request->session()->get('appointment');

        $data['current_url'] = Route::current()->getName();

        return view('backend.appointment.appointmentInfo', $data);
    }
}