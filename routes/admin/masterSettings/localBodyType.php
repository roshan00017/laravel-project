<?php

use App\Http\Controllers\MasterSettings\LocalBodyTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('/localBodyTypes', LocalBodyTypeController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/localBodyTypes/status/{id}', [LocalBodyTypeController::class, 'status']);
