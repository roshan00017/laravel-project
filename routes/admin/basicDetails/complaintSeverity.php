<?php

use App\Http\Controllers\BasicDetails\ComplaintSeverityController;
use Illuminate\Support\Facades\Route;

Route::resource('/complaintSeverity', ComplaintSeverityController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/complaintSeverity/status/{id}', [ComplaintSeverityController::class, 'status']);
