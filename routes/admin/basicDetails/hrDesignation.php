<?php

use App\Http\Controllers\BasicDetails\HrDesignationController;
use Illuminate\Support\Facades\Route;

Route::resource('/hr_designation', HrDesignationController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/hr_designation/status/{id}', [HrDesignationController::class, 'status']);
