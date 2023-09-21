<?php

use App\Http\Controllers\FrontEnd\SuchikritInfoController;
use Illuminate\Support\Facades\Route;

Route::get('suchikrit-info', [SuchikritInfoController::class, 'index'])
    ->name('suchikrit-info');

Route::post('suchikrit-store', [SuchikritInfoController::class, 'store'])
    ->name('suchikrit.store');

Route::get('otp-verify', [SuchikritInfoController::class, 'viewOtpVerify'])
    ->name('otp-verify');

#otp verify by email
Route::get('otpVerify', [SuchikritInfoController::class, 'otpVerifyByEmail'])
    ->name('otpVerify');

Route::post('otpVerify', [SuchikritInfoController::class, 'otpVerify'])
    ->name('otpVerify');

Route::get('login-info', [SuchikritInfoController::class, 'loginInfo'])
    ->name('loginInfo');

Route::post('newPasswordUpdate', [SuchikritInfoController::class, 'newPasswordUpdate'])
    ->name('newPasswordUpdate');
