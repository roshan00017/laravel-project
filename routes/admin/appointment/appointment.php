<?php

use App\Http\Controllers\Appointment\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::resource('/appointments', AppointmentController::class)->except(['create']);

Route::get('appointmentInfo', [AppointmentController::class, 'appointmentInfo'])
    ->name('appointment.appointmentInfo');

Route::get('personalInfo', [AppointmentController::class, 'personalInfo'])
    ->name('appointment.personalInfo');

Route::post('personalInfo', [AppointmentController::class, 'postPersonalDetails'])
    ->name('appointment.personalInfo');

Route::get('appointmentConfirm', [AppointmentController::class, 'appointmentConfirm'])
    ->name('appointment.appointmentConfirm');

Route::post('appointmentConfirm', [AppointmentController::class, 'storeAppointmentConfirm'])
    ->name('appointment.appointmentConfirm');

Route::post('appointmentHandover', [AppointmentController::class, 'appointmentHandover'])
    ->name('appointment.appointmentHandover');

Route::post('appointments/status/{id}', [AppointmentController::class, 'updateAppointmentStatus'])
    ->name('appointment.status');

Route::post('/complaintsProgress', [AppointmentController::class, 'postComplaintProgress'])->name('appointment.progress');
