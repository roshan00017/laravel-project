<?php

use App\Http\Controllers\TokenManagement\TokenListController;
use Illuminate\Support\Facades\Route;

Route::get('/tokenManagement', [TokenListController::class, 'index']);
