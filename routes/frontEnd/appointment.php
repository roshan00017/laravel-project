<?php

use App\Http\Controllers\FrontEnd\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('appointment-schedule', [AppointmentController::class, 'index'])
    ->name('appointment-schedule');

Route::get('appointment-info', [AppointmentController::class, 'appointmentInfo'])
    ->name('appointment-info');

Route::post('appointmentInfo', [AppointmentController::class, 'postAppointmentInfo'])
    ->name('appointmentInfo');

Route::get('personal-info', [AppointmentController::class, 'getPersonalInfo'])
    ->name('personalInfo');

Route::post('personal-info', [AppointmentController::class, 'postPersonalDetails'])
    ->name('personalInfo');

Route::get('appointment-confirm', [AppointmentController::class, 'appointmentConfirm'])
    ->name('appointmentConfirm');

Route::post('appointment-status', [AppointmentController::class, 'getAppointmentStatus'])
    ->name('appointment-status');

Route::post('appointment-history', [AppointmentController::class, 'getAppointmentHistory'])
    ->name('appointment-history');

Route::post('appointment-confirm', [AppointmentController::class, 'storeAppointmentConfirm'])
    ->name('appointmentConfirm');
