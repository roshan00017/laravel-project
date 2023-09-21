<?php

use App\Http\Controllers\BasicDetails\ComplaintTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('/complaintTypes', ComplaintTypeController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/complaintTypes/status/{id}', [ComplaintTypeController::class, 'status']);
