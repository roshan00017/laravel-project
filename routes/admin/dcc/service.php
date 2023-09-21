<?php

use App\Http\Controllers\DCC\ServiceController;
use Illuminate\Support\Facades\Route;

Route::resource('/services', ServiceController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/services/status/{id}', [ServiceController::class, 'status']);
