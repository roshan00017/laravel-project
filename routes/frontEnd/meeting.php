<?php

use App\Http\Controllers\FrontEnd\MMSController;
use Illuminate\Support\Facades\Route;

Route::get('meeting-management-info', [MMSController::class, 'index'])
    ->name('meeting-management-info.index');
