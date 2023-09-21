<?php

use App\Http\Controllers\VoiceCallManagement\PhoneSmsManagementController;
use Illuminate\Support\Facades\Route;

Route::resource('/phoneSmsManagement', PhoneSmsManagementController::class)
    ->except(['create', 'edit']);

Route::post('/addMobileNumber', [PhoneSmsManagementController::class, 'addMobileNumber']);

Route::post('/updateMobileNumber', [PhoneSmsManagementController::class, 'updateMobileNumber']);

Route::post('/deleteMobileNumber', [PhoneSmsManagementController::class, 'deleteMobileNumber']);

Route::post('/runCampaign', [PhoneSmsManagementController::class, 'runCampaign']);
