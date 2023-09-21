<?php

use App\Http\Controllers\DCC\ServiceDepartmentController;
use Illuminate\Support\Facades\Route;

Route::resource('/serviceDepartment', ServiceDepartmentController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/serviceDepartment/status/{id}', [ServiceDepartmentController::class, 'status']);
