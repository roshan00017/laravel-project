<?php

use App\Http\Controllers\Grevience\IncidentReportingController;
use Illuminate\Support\Facades\Route;

Route::get('/incidentReporting', [IncidentReportingController::class, 'index'])
    ->name('incidentReporting');

Route::get('/incidentReporting/{id}', [IncidentReportingController::class, 'show'])
    ->name('incidentReporting.show');
