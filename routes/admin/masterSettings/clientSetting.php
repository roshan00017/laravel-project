<?php

use App\Http\Controllers\MasterSettings\ClientSettingController;
use Illuminate\Support\Facades\Route;

Route::resource('/masterSettings/clientSettings', ClientSettingController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/masterSettings/clientSettings/status/{id}', [ClientSettingController::class, 'status']);
