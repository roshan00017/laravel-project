<?php

use App\Http\Controllers\MasterSettings\ProvinceController;
use Illuminate\Support\Facades\Route;

Route::resource('/provinces', ProvinceController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/provinces/status/{id}', [ProvinceController::class, 'status']);
