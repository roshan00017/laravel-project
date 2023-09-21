<?php

use App\Http\Controllers\Grevience\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notification.index');
