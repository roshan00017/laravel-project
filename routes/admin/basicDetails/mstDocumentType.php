<?php

use App\Http\Controllers\BasicDetails\DocumentTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('/documentTypes', DocumentTypeController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/documentTypes/status/{id}', [DocumentTypeController::class, 'status']);
