<?php

use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Calendar\HolidayManagementController;
use Illuminate\Support\Facades\Route;

Route::resource('/calendarManagement', CalendarController::class)
    ->except(['create', 'edit', 'show']);

Route::resource('/holidayManagement', HolidayManagementController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/holidayManagement/status/{id}', [HolidayManagementController::class, 'status']);
