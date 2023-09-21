<?php

use App\Http\Controllers\MasterSettings\LocalBodyController;
use Illuminate\Support\Facades\Route;

Route::resource('/localBodies', LocalBodyController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/localBodies/status/{id}', [LocalBodyController::class, 'status']);
