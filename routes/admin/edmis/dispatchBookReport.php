<?php

use App\Http\Controllers\EDMIS\DispatchBookController;
use Illuminate\Support\Facades\Route;

Route::get('/dispatchReport', [DispatchBookController::class, 'index']);
