<?php

use App\Http\Controllers\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::resource('/employees', EmployeeController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/employees/status/{id}', [EmployeeController::class, 'status']);
