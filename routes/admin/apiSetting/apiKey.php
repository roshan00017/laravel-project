<?php

use App\Http\Controllers\ApiSetting\ApiKeySettingController;
use Illuminate\Support\Facades\Route;

Route::resource('/apiKey', ApiKeySettingController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/apiKey/status/{id}', [ApiKeySettingController::class, 'status']);
