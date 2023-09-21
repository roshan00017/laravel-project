<?php

use App\Http\Controllers\BasicDetails\FaqController;
use Illuminate\Support\Facades\Route;

Route::resource('/faqs', FaqController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/faqs/status/{id}', [FaqController::class, 'status']);
