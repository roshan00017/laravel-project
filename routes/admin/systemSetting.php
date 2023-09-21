<?php

use App\Http\Controllers\SystemSettings\AppSettingController;
use App\Http\Controllers\SystemSettings\EmailSettingController;
use App\Http\Controllers\SystemSettings\LoginSettingController;
use App\Http\Controllers\SystemSettings\OtpSettingController;
use App\Http\Controllers\SystemSettings\SmsSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('systemSetting')->group(function () {
    Route::resource('/appSetting', AppSettingController::class)
        ->except(['create', 'edit', 'show']);

    Route::resource('/mailSetting', EmailSettingController::class)
        ->except(['create', 'edit', 'show']);

    Route::post('/mailSetting/status/{id}', [EmailSettingController::class, 'status']);

    Route::resource('/smsSetting', SmsSettingController::class)
        ->except(['create', 'edit', 'show']);

    Route::post('/smsSetting/status/{id}', [SmsSettingController::class, 'status']);

    Route::resource('/otpSetting', OtpSettingController::class)
        ->except(['create', 'edit', 'show']);

    Route::post('/otpSetting/status/{id}', [OtpSettingController::class, 'status']);

    Route::resource('/loginSetting', LoginSettingController::class)
        ->except(['create', 'edit', 'show']);

    Route::post('/uploadSystemSettingFile/{id}', [AppSettingController::class, 'uploadFile']);

    Route::post('/updateStatus/{id}', [LoginSettingController::class, 'updateStatus']);
});
