<?php

use App\Http\Controllers\BasicDetails\OrganizationTypesController;
use Illuminate\Support\Facades\Route;

Route::resource('/organizationTypes', OrganizationTypesController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/organizationTypes/status/{id}', [OrganizationTypesController::class, 'status']);
