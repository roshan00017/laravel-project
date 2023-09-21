<?php

use App\Http\Controllers\API\ApiKeyController;
use Illuminate\Support\Facades\Route;

Route::get('apiList', [ApiKeyController::class, 'getApiList']);
Route::post('apiKeyRegister', [ApiKeyController::class, 'storeApiKey']);
Route::get('apiKey/{name}', [ApiKeyController::class, 'getApiKey']);
