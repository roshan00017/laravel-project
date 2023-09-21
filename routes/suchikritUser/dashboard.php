<?php

use App\Http\Controllers\SuchikritUser\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/userDashboard', [DashboardController::class, 'index'])
    ->name('userDashboard');

Route::get('/user-profile', [DashboardController::class, 'profile']);
