<?php

use App\Http\Controllers\EDMIS\DcRegisterBookLogController;
use Illuminate\Support\Facades\Route;

Route::get('/dcRegisterBookStatusLogDetails', [DcRegisterBookLogController::class, 'index']);
Route::get('/dcRegisterBookStatusLogDetails/{id}', [DcRegisterBookLogController::class, 'show']);
