<?php

namespace App\Http\Controllers\Auth;

use App\Facades\NepaliDate;
use App\Http\Controllers\Controller;
use App\Models\Logs\LoginFails;
use App\Models\Logs\LoginLogs;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     */
    protected string $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /* check username or email */
    public function checkIdentity(): JsonResponse
    {
        try {
            $identity = Str::lower($_POST['identity']);
            if (filter_var($identity, FILTER_VALIDATE_INT) == true) {
                $fieldName = 'mobile_no';
            } elseif (filter_var($identity, FILTER_VALIDATE_EMAIL) == true) {
                $fieldName = 'email';
            } else {
                $fieldName = 'login_user_name';
            }
            request()->merge([$fieldName => $identity]);
            $user = User::where($fieldName, $identity)->first();
            $message = '';

            if (is_null($user)) {
                $message = trans('auth.username_or_email_does_not_exist');
            }
            if ($user) {
                if ($user->block_status == true) {
                    $message = trans('auth.authBlock');
                } elseif ($user->status == false) {
                    $message = trans('auth.authInactive');
                }
            }
            if ($message) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ]);
            } else {
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went to wrong',
            ], 500);
        }
    }

    /* Check user status (active or not) */
    protected function credentials(Request $request): array
    {
        return array_merge($request->only($this->username(), 'password'), ['status' => '1']);
    }

    /* post login form data */
    public function login(Request $request)
    {
        try {

            //check form validation
            $messages = [
                'captcha.required' => trans('auth.login.captcha_required'),
                'identity.required' => trans('auth.login.identity_required'),
                'password.min' => trans('auth.login.password_min'),
                'password.required' => trans('auth.login.password_required'),
            ];
            //check captcha validation
            if (systemSetting() && systemSetting()->login_captcha_required == 1) {
                $request->validate([
                    'identity' => 'required|min:3|string',
                    'password' => 'required|min:3|string',
                    'captcha' => 'required|captcha',
                ], $messages);
            } else {
                $request->validate([
                    'identity' => 'required|string',
                    'password' => 'required|min:6|string',
                ], $messages);
            }
            //set remember me function
            if ($request->rememberme === null) {
                setcookie('login_email', $request->identity, 100);
                setcookie('login_pass', $request->password, 100);
            } else {
                setcookie('login_email', $request->identity, time() + 60 * 60 * 24 * 100);
                setcookie('login_pass', $request->password, time() + 60 * 60 * 24 * 100);
            }
            //default validation check
            // $this->validateLogin($request);
            $user = User::where($this->username(), $request->identity)->first();
            // dd($user);
            session()->put('fiscal_year_code', currentFy()->code);
            session()->put('fiscal_year_id', currentFy()->id);

            if (isset($user)) {
                if (! Hash::check($request->password, $user->password)) {
                    $errors = [$this->username() => trans('auth.invalid_password')];

                    return redirect()->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors($errors);
                }
                $loginFailed = getUserLoginFailed($user->id);
                if (systemSetting()->login_attempt_required == 1 && $loginFailed >= getLoginAttempt()->login_attempt_limit) {
                    $errors = [$this->username() => trans('auth.authBlock')];

                    return redirect()->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors($errors);
                }
                // check user  status is not 1. If so, override the default error message.
                if ($user->block_status == true) {
                    $errors = [$this->username() => trans('auth.authBlock')];

                    return redirect()->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors($errors);
                } elseif ($user->status == false) {
                    $errors = [$this->username() => trans('auth.authInactive')];

                    return redirect()->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors($errors);
                }

            } else {
                $loginFailed = getIpLoginFailed();

                if ($loginFailed >= getLoginAttempt()->login_attempt_limit) {
                    $errors = [$this->username() => trans('auth.authUnknown')];

                    return redirect()->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors($errors);
                }
            }

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);

            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        } catch (Exception $e) {
            //check form validation
            if ($e->status == 422) {
                Session::flash('error', $e->getMessage());
            } else {
                Session::flash('server_error', Lang::get('message.commons.technicalError'));
            }

            return back();
        }
    }

    /* redirect log out route  */
    public function logout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->flush();

        $request->session()->regenerate();
        session()->flash('success', trans('auth.login.logout_message'));

        return redirect(route('eoadmin'));
    }

    /* load captcha   */
    public function reloadCaptcha(): JsonResponse
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    /* load login form*/
    public function showLoginForm(): Factory|View|Application
    {
        /* load data for request */
        $data['load_js'] = [
            'js/check_data.min.js',
        ];
        $data['script_js'] = "$(function(){
               $('.toggle-password').click(function () {

                $(this).toggleClass('fa-eye fa-eye-slash');
                var input = $($(this).attr('toggle'));
                if (input.attr('type') == 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            })
          $('#loginForm').validate({
                 rules: {
                     identity: {
                         required: true,
                     },
            
                 },
                 messages: {
                     identity: {
                         required: 'अंग्रेजी नाम  अनिवार्य छ ।',
                     },
            
                 },
                 errorElement: 'span',
                 errorPlacement: function (error, element) {
                     error.addClass('invalid-feedback');
                     element.closest('.form-group').append(error);
                 },
                 highlight: function (element, errorClass, validClass) {
                     $(element).addClass('is-invalid');
                 },
                 unhighlight: function (element, errorClass, validClass) {
                     $(element).removeClass('is-invalid');
                 }
                });
         })";

        return view('auth.login', $data);
    }

    /* insert value login fails table  */
    protected function sendFailedLoginResponse(Request $request): RedirectResponse
    {
        $errors = [$this->username() => trans('auth.failed')];
        //set default variable for login fails table
        $user_id = null;
        $agent = device_info();
        //check user exist
        if (isset($user)) {
            $user_id = $user->id;
            $loginFailed = getUserLoginFailed($user->id);
            $loginFailCount = $loginFailed + 1;
        } else {
            $loginFailed = getIpLoginFailed();
            $loginFailCount = $loginFailed + 1;
        }
        $value = [
            'user_name' => $request->get('identity'),
            'fail_password' => $request->get('password'),
            'log_in_ip' => request()->ip(),
            'log_in_device' => $agent,
            'log_fails_date' => Carbon::now(),
            'log_fails_date_np' => NepaliDate::create(Carbon::now())->toBS(),
            'login_fail_count' => $loginFailCount,
            'user_id' => $user_id,
        ];
        LoginFails::create($value);

        //set user block status
        if (isset($user)) {
            if (systemSetting()->login_attempt_required == 1) {
                $loginFailedCount = getUserLoginFailed($user->id);
                $daysTotalAttempt = getLoginAttempt()->login_attempt_limit;
                $failedAttempt = $daysTotalAttempt - $loginFailedCount;
                //update user  block status
                if ($loginFailedCount == getLoginAttempt()->login_attempt_limit) {
                    User::where('id', $user->id)->update(['block_status' => '1']);
                }
                //set login fail attempt message
                if ($failedAttempt > 0) {
                    $errors = [$this->username() => trans('Invalid User Name or Password. You are left with'.' '.$failedAttempt.'  '.'Attempts')];
                } else {
                    $errors = [$this->username() => trans('auth.login.login_attempt_message')];
                }
            } else {
                $errors = [$this->username() => trans('auth.login.invalid_username_or_password')];
            }
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /* insert value login log table  */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        $agent = device_info();
        $value = [
            'user_id' => userInfo()->id,
            'log_in_ip' => request()->ip(),
            'log_in_device' => $agent,
            'log_in_date' => Carbon::now(),
            'log_in_date_np' => NepaliDate::create(Carbon::now())->toBS(),
        ];
        LoginLogs::create($value);

        return $this->authenticated($request, Auth::guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    public function username(): string
    {
        $identity = request()->get('identity');
        if (filter_var($identity, FILTER_VALIDATE_INT) == true) {
            $fieldName = 'mobile_no';
        } elseif (filter_var($identity, FILTER_VALIDATE_EMAIL) == true) {
            $fieldName = 'email';
        } else {
            $fieldName = 'login_user_name';
        }
        request()->merge([$fieldName => $identity]);

        return $fieldName;
    }

    /**
     * Attempt to log the user into the application.
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->boolean('remember')
        );
    }
}
