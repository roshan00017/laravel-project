<?php

use App\Http\Controllers\BasicDetails\VisitingPurposeController;
use Illuminate\Support\Facades\Route;

Route::resource('/vistingPurposes', VisitingPurposeController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/vistingPurposes/status/{id}', [VisitingPurposeController::class, 'status']);
