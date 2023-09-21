<?php

use App\Http\Controllers\EDMIS\DcDispatchBookController;
use Illuminate\Support\Facades\Route;

Route::resource('/dcDispatchBook', DcDispatchBookController::class);
