<?php

use App\Http\Controllers\MasterSettings\SettingController;
use Illuminate\Support\Facades\Route;

Route::resource('/masterSettings/settings', SettingController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/masterSettings/settings/status/{id}', [SettingController::class, 'status']);
