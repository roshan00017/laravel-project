<?php

use App\Http\Controllers\ApiSetting\ApiAccessLogController;
use Illuminate\Support\Facades\Route;

Route::get('/apiAccessLogs', [ApiAccessLogController::class, 'index']);
