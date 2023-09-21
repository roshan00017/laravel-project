<?php

use App\Http\Controllers\BasicDetails\BranchDepartmentMediumController;
use Illuminate\Support\Facades\Route;

Route::resource('/branchDepartments', BranchDepartmentMediumController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/branchDepartments/status/{id}', [BranchDepartmentMediumController::class, 'status']);
