<?php

use App\Http\Controllers\Meetings\FinalVerdictFileController;
use Illuminate\Support\Facades\Route;

Route::resource('/finalVerdictFile', FinalVerdictFileController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/finalVerdictFile/fileStatusUpdate/{id}', [FinalVerdictFileController::class, 'fileStatusUpdate']);
