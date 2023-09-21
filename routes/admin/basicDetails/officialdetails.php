<?php

use App\Http\Controllers\BasicDetails\OfficialDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/officialdetails', [OfficialDetailController::class, 'index']);
