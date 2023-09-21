<?php

use App\Http\Controllers\Appointment\ScheduleTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('/scheduleType', ScheduleTypeController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/scheduleType/status/{id}', [ScheduleTypeController::class, 'status']);
