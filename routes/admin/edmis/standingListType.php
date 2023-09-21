<?php

use App\Http\Controllers\EDMIS\StandingListTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('/standinglisttypes', StandingListTypeController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/standinglisttypes/status/{id}', [StandingListTypeController::class, 'status']);
