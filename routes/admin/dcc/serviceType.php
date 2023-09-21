<?php

use App\Http\Controllers\DCC\ServiceTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('/serviceType', ServiceTypeController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/serviceType/status/{id}', [ServiceTypeController::class, 'status']);
