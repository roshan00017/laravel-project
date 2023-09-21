<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     */
    protected string $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getPassword($token): Factory|View|RedirectResponse|Application
    {
        try {
            $value = DB::table('password_resets')->where('token', $token)->first();
            if ($value == null) {
                return redirect()->route('login')->with('error', trans('auth.passwordReset.pass_link_duration'));
            }

            return view('auth.passwords.reset', ['token' => $token, 'email' => $value->email]);
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect()->route('login');
        }
    }

    public function passwordReset(PasswordResetRequest $request)
    {
        try {
            $value = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
            $this->checkNullValue($value);
            $user = User::query()->where('email', $request->email)->update(['password' => Hash::make($request->password)]);
            //delete token from password reset table
            if ($user) {
                DB::table('password_resets')->where(['email' => $request->email])->delete();
            }

            return redirect()->route('login')->with('success', trans('auth.passwordReset.password_changed_message'));
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect()->route('login');
        }
    }

    public function checkNullValue($value)
    {
        if ($value == null) {
            return redirect()->route('login')->with('error', trans('auth.passwordReset.token_valid_message'));
        }
    }
}
