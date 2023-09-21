<?php

use App\Http\Controllers\EDMIS\PatraConditionController;
use Illuminate\Support\Facades\Route;

Route::get('/patraReport', [PatraConditionController::class, 'index']);
