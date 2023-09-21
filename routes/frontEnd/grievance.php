<?php

use App\Http\Controllers\FrontEnd\GrievanceController;
use App\Http\Controllers\FrontEnd\IncidentController;
use Illuminate\Support\Facades\Route;

Route::get('complaint-info', [GrievanceController::class, 'complaintView'])
    ->name('complaint-info');

Route::post('postComplaint', [GrievanceController::class, 'postComplaint'])
    ->name('postComplaint');

Route::get('complaint-complainer', [GrievanceController::class, 'complainerInfoView'])
    ->name('complaint-complainer');

Route::post('postComplainer', [GrievanceController::class, 'postcomplainerInfoView'])
    ->name('postComplainer');

Route::get('complaint-confirm', [GrievanceController::class, 'confirmView'])
    ->name('complaint-confirm');

Route::post('postComplaintConfirm', [GrievanceController::class, 'postConfirmView'])
    ->name('postComplaintConfirm');

Route::get('track-complaint', [GrievanceController::class, 'trackComplaintView'])
    ->name('complaints.track');

Route::post('complaint-status', [GrievanceController::class, 'getComplaintStatus'])
    ->name('complaints.complaint-status');

//grevience inner page details
Route::get('complaint-suggestion-info', [GrievanceController::class, 'index'])
    ->name('complaint-suggestion-info');

Route::get('incidents', [IncidentController::class, 'recordIncident'])->name('incident.add');
Route::post('/incidentLocation', [IncidentController::class, 'store'])->name('incidentLocation.store');
