<?php

use App\Http\Controllers\EDMIS\StandingListController;
use Illuminate\Support\Facades\Route;

Route::resource('/standinglist', StandingListController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/standinglist/status/{id}', [StandingListController::class, 'status']);
