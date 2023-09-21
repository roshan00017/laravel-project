<?php

use App\Http\Controllers\BasicDetails\ComplaintSourceController;
use Illuminate\Support\Facades\Route;

Route::resource('/complaintSource', ComplaintSourceController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/complaintSource/status/{id}', [ComplaintSourceController::class, 'status']);
