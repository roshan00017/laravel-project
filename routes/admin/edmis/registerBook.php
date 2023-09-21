<?php

use App\Http\Controllers\EDMIS\DcRegisterBookController;
use Illuminate\Support\Facades\Route;

Route::resource('/dcRegisterBook', DcRegisterBookController::class);
