<?php

use App\Http\Controllers\BasicDetails\StatusController;
use Illuminate\Support\Facades\Route;

Route::resource('/status', StatusController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/status/status/{id}', [StatusController::class, 'status']);
