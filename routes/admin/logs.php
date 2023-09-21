<?php

use App\Http\Controllers\Logs\ActionLogsController;
use App\Http\Controllers\Logs\FailedLoginLogsController;
use App\Http\Controllers\Logs\LoginLogsController;
use Illuminate\Support\Facades\Route;

Route::prefix('logs')->group(function () {
    Route::get('/loginLogs', [LoginLogsController::class, 'index']);

    Route::get('/failLoginLogs', [FailedLoginLogsController::class, 'index']);

    Route::get('/actionLogs', [ActionLogsController::class, 'index']);

    Route::post('/ip_block/{id}', [FailedLoginLogsController::class, 'ipUnblock']);
});
