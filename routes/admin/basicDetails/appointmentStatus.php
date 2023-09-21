<?php

use App\Http\Controllers\BasicDetails\AppointmentStatusController;
use Illuminate\Support\Facades\Route;

Route::resource('/appointmentStatus', AppointmentStatusController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/appointmentStatus/status/{id}', [AppointmentStatusController::class, 'status']);
