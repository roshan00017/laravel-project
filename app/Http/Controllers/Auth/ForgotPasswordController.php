<?php

namespace App\Http\Controllers\Auth;

use App\Events\PasswordResetEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        $data['load_js'] = [
            'js/check_data.min.js',
            //'js/auth/passwordReset.min.js'
        ];

        return view('auth.passwords.email', $data);
    }

    public function forgotPassword(ForgotPasswordRequest $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $identity = Str::lower($request->identity);
            $user = User::query()->where('email', $identity)->first();
            if ($user == null) {
                return redirect()->back()->withInput($request->all())->with('forgotError', trans('auth.emailFailed'));
            } elseif ($user->status == false) {
                return redirect(route('login'))->withInput($request->all())->with('forgotError', trans('auth.authInactive'));
            }
            //set token
            $token = Str::random(100);
            //set value in password reset table
            DB::table('password_resets')->insert(
                ['email' => $user->email, 'token' => $token, 'created_at' => Carbon::now()]
            );
            if (isset($user->name_en)) {
                $userName = getLan() == 'np' ? $user->name_np : $user->name_en;
            } else {
                $userName = getLan() == 'np' ? $user->full_name_np : $user->full_name;
            }
            $data = [
                'token' => $token,
                'userName' => $userName,
                'email' => $user->email,
            ];

            //sent to email
            PasswordResetEvent::dispatch($data);

            return redirect()->route('login')->with('success', trans(trans('auth.passwordReset.password_link_message')));
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect()->route('login');
        }
    }
}
