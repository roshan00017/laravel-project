<?php

use App\Http\Controllers\BasicDetails\MstSettingController;
use Illuminate\Support\Facades\Route;

Route::resource('/mstSetting', MstSettingController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/mstSetting/status/{id}', [MstSettingController::class, 'status']);
