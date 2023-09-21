<?php

use App\Http\Controllers\DCC\ServiceTokenLogManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/serviceTokeLogDetails/', [ServiceTokenLogManagementController::class, 'index']);

Route::get('/serviceTokeLogDetails/{token}', [ServiceTokenLogManagementController::class, 'show']);
