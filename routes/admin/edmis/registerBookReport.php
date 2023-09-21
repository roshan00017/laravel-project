<?php

use App\Http\Controllers\EDMIS\RegisterBookController;
use Illuminate\Support\Facades\Route;

Route::get('/registerReport', [RegisterBookController::class, 'index']);
