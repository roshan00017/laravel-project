<?php

use App\Http\Controllers\MasterSettings\AppClientController;
use Illuminate\Support\Facades\Route;

Route::resource('/appClients', AppClientController::class);

Route::post('/appClients/status/{id}', [AppClientController::class, 'status']);
