<?php

use App\Http\Controllers\BasicDetails\OfficeController;
use Illuminate\Support\Facades\Route;

Route::resource('/complaintRelatedDepartment', OfficeController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/complaintRelatedDepartment/status/{id}', [OfficeController::class, 'status']);
