<?php

namespace App\Http\Controllers\FrontEnd;

use App\Events\RegisterSuchikritUserEvent;
use App\Facades\NepaliDate;
use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\NewPasswordRequest;
use App\Http\Requests\FrontEnd\SuchikritRegisterRequest;
use App\Models\EDMIS\SuchikritUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use phpseclib3\Crypt\Hash;

class SuchikritInfoController extends Controller
{
    protected SuchikritUser $model;

    public function __construct(SuchikritUser $suchikritUser)
    {

        $this->model = $suchikritUser;

    }

    public function index(Request $request)
    {

        try {
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'js/register.js',

            ];
            $data['script_js'] = "$(function(){
               $('#mobile').inputmask('9999999999', { placeholder: '' });
            })";
            $data['page_title'] = getLan() == 'np' ? 'सुचिकृत दर्ता' : 'Suchikrit Register';
            $data['current_url'] = Route::current()->getName();
            $data['suchitkritUserInfo'] = $request->session()->get('suchitkritUserInfo');

            return view('frontend.suchikritUser.personalInfo', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(SuchikritRegisterRequest $request)
    {
        try {
            $data = $request->all();
            $otp_code = mt_rand(100000, 999999);
            $otp_token = Str::random(100);
            DB::beginTransaction();
            $data['otp_code'] = $otp_code;
            $data['opt_token'] = $otp_token;
            $data['otp_count'] = 1;
            $data['client_id'] = clientInfo()->id;
            $data['register_date_bs'] =NepaliDate::create(Carbon::now())->toBS();
            $data['register_date_ad'] =Carbon::now();
            $data['otp_created_date_bs'] =NepaliDate::create(Carbon::now())->toBS();
            $data['otp_created_date_ad'] =Carbon::now();
            $create = $this->model->create($data);

            if ($request->otp_code == $data['otp_code']) {
                $data['status'] = 'false';
            }
            //send sms with otp code
            if (smsSetting(clientInfo()->id)) {
                SmsHelper::sendSms($create->mobile_no, 'OTP Code:' . $otp_code);
            }
            if (mailSetting(clientInfo()->id)) {
                $mailData = [
                    'full_name' => getLan() == 'np' ? $create->full_name_np : $create->full_name_en,
                    'mobile' => $create->mobile_no,
                    'email' => $create->email,
                    'otp_code' => $otp_code,
                    'otp_token' => $otp_token,
                ];
                RegisterSuchikritUserEvent::dispatch($mailData);
            }
            DB::commit();
            if (empty($request->session()->get('suchitkritUserInfo'))) {
                $suchitkritUserInfo = new SuchikritUser();
                $suchitkritUserInfo->fill($data);
                $request->session()->put('suchitkritUserInfo', $suchitkritUserInfo);
            } else {
                $suchitkritUserInfo = $request->session()->get('suchitkritUserInfo');
                $suchitkritUserInfo->fill($request->all());
            }
            Session::flash('success', Lang::get('message.flash_messages.suchikrit_user_registered'));
            $data['email'] = $create->email;
            $data['client_id'] = $create->client_id;
            $data['page_title'] = getLan() == 'np' ? 'सुचिकृत दर्ता' : 'Suchikrit Register';
            /* load data for request */
            // $data['load_js'] = 'assets/js/check_data_info.js';
            // return view('frontend.suchikritUser.otpVerify', $data);

           # return redirect()->route('otp-verify');
            return response()->json([
                'status' => true,
                'success' => Lang::get('message.flash_messages.suchikrit_user_registered'),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function viewOtpVerify(Request $request)
    {

        try {

            #check suchikrit user info
            $suchitkritUserInfo = $request->session()->get('suchitkritUserInfo');
            if (is_null($suchitkritUserInfo)) {
                Session::flash('server_error', 'Method Not Allowed');

                return redirect('/');
            }


            $data['page_title'] = getLan() == 'np' ? 'सुचिकृत दर्ता' : 'Suchikrit Register';
            $data['script_js'] = "$(function(){
               $('#otp_code').on('change', function () {
                   const otp_code = $(this).val();
                  if (otp_code !== '') {
                    $.post(
                        site_url + '/check_otp',
                        {
                          otp_code: otp_code,
                          _token: $('meta[name=csrf-token]').attr('content'),
                        },
                        function (status) {
                          if (status.status === true) {
                            $('#error').html(status.message);
                            $('#check_data_modal').modal('show');
                            $('#otp_code').val('');
                            $('#btn-add').prop('disabled', true);
                            setTimeout(function () {
                              $('#check_data_modal').modal('hide');
                            }, 5000);
                          } else {
                            $('#btn-add').prop('disabled', false);
                          }
                        }
                    );
                  }
                });
            })";
            $data['current_url'] = Route::current()->getName();

            return view('frontend.suchikritUser.otpVerify', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function otpVerify(Request $request)
    {

        try {
            #check suchikrit user info
            $suchitkritUserInfo = $request->session()->get('suchitkritUserInfo');
            if (is_null($suchitkritUserInfo)) {
                Session::flash('server_error', 'Method Not Allowed');

                return redirect('/');
            }
            #check otp code
            $checkInfo = SuchikritUser::query()->where(['email' => $suchitkritUserInfo->email, 'otp_code' => $request->otp_code])->first();
            if ($checkInfo) {
                SuchikritUser::query()->where('id', $checkInfo->id)->update(['status' => true]);
                Session::flash('success', getLan() ? 'तपाईको प्रयोगकर्ता दर्ता प्रकृया सम्पन्न भयो । कृपया  पासवर्ड अपडेट गरेर मात्र लग - इन गर्नुहोला । ' : 'Your user registration process is complete. Please update the password and log in only');
                return redirect()->route('loginInfo');
            } else {
                Session::flash('server_error', getLan() ? 'Opt Code रेकर्ड सग मेल खाएन' : 'Otp code does not exist !');

                return back();
            }

        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function loginInfo(Request $request)
    {

        try {

            $data['page_title'] = getLan() == 'np' ? 'सुचिकृत दर्ता' : 'Suchikrit Register';
            $data['current_url'] = Route::current()->getName();

            return view('frontend.suchikritUser.loginInfo', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function newPasswordUpdate(NewPasswordRequest $request)
    {

        try {
            $suchitkritUserInfo = $request->session()->get('suchitkritUserInfo');
            #check otp code
            $checkInfo = SuchikritUser::query()->where(['email' => $suchitkritUserInfo->email])->first();
            if ($checkInfo) {
                SuchikritUser::query()->where(['email' => $suchitkritUserInfo->email])->update([
                    'password' => bcrypt($request->password),
                    'password_status' => true,
                ]);
                $request->session()->forget('suchitkritUserInfo');
                Session::flash('success', getLan() ? 'तपाईंको पासवर्ड परिवर्तन गरिएको छ! नया पासवर्ड राखेर लग - इन गर्नुहोस । ' : 'Your password has been changed! Log in with a new password.');
                return redirect()->route('suchitkritUserInfo');
            } else {
                Session::flash('server_error', Lang::get('message.commons.technicalError'));

                return redirect('/suchikrit-info');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function otpVerifyByEmail(Request $request)
    {

        try {
            $otpCode = decrypt($request->token);
            if ($otpCode) {
                $result = SuchikritUser::query()->where('otp_code', $otpCode)->first();
                $now = Carbon::now();
                $createTime = \Carbon\Carbon::parse($result->otp_created_date_ad);
                $diffMinutes = $createTime->diffInMinutes($now);

//                if ($result->status == true) {
//                    return redirect(route('login'))->withInput()->with('otpLoginError', 'तपाईंको खाता पहिले  नै  सक्रिय  भईसकेको छ  ! कृपया  Username र Password प्रयोग गरी लगईन गर्नुहोस् ।');
//
//                } elseif ($diffMinutes > otpSetting(clientInfo()->id)->otp_duration) {
//                    return redirect(route('login'))->with('otpError', 'OTP  कोडको  समय अवधिसकिएको छ !  कृपया नयाँ OTP कोड अनुरोध गर्नुहोस् ।');
//
//                }
                SuchikritUser::query()->where('id', $result->id)->update(['status' => true]);
                Session::flash('success', getLan() ? 'तपाईको प्रयोगकर्ता दर्ता प्रकृया सम्पन्न भयो । कृपया  पासवर्ड अपडेट गरेर मात्र लग - इन गर्नुहोला । ' : 'Your user registration process is complete. Please update the password and log in only');
                return redirect()->route('loginInfo');
            }


        } catch (\Exception $e) {
            //check for encryption format to decryption
            if ($e->getMessage() == 'The payload is invalid.') {
                Session::flash('server_error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('otp-verify');
            }
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect('otp-verify');
        }
    }
}
