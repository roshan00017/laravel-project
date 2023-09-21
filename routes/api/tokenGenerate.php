<?php

use App\Http\Controllers\API\TokenManagementController;
use Illuminate\Support\Facades\Route;

Route::post('tokenGenerate', [TokenManagementController::class, 'generateToken']);

Route::post('updateTokenStatus', [TokenManagementController::class, 'updateTokenStatus']);
