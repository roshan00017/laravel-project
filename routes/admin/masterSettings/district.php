<?php

use App\Http\Controllers\MasterSettings\DistrictController;
use Illuminate\Support\Facades\Route;

Route::resource('/districts', DistrictController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/districts/status/{id}', [DistrictController::class, 'status']);
