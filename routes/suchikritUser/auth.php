<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SuchikritUserLoginController;
use Illuminate\Support\Facades\Route;

Route::get('reload-captcha', [SuchikritUserLoginController::class, 'reloadCaptcha']);

Route::get('sulogin', [SuchikritUserLoginController::class, 'showLoginForm'])
    ->name('sulogin');

Route::post('sulogin', [SuchikritUserLoginController::class, 'login'])
    ->name('sulogin');

Route::post('forgotPassword', [ForgotPasswordController::class, 'forgotPassword'])
    ->name('forgotPassword');

Route::get('passwordReset/{token}', [ResetPasswordController::class, 'getPassword'])
    ->name('getPassword');

Route::post('passwordReset', [ResetPasswordController::class, 'passwordReset'])
    ->name('passwordReset');

Route::get('passwordUpdate/{token}/{type}', [ResetPasswordController::class, 'getNewPassword'])
    ->name('passwordUpdate');
