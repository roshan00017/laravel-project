<?php

use App\Http\Controllers\BasicDetails\CountryController;
use Illuminate\Support\Facades\Route;

Route::resource('/countries', CountryController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/countries/status/{id}', [CountryController::class, 'status']);
