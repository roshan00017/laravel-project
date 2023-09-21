<?php

use App\Http\Controllers\FrontEnd\SuggestionController;
use Illuminate\Support\Facades\Route;

Route::get('suggestion-info', [SuggestionController::class, 'create'])
    ->name('suggestion-info');

Route::post('suggestion', [SuggestionController::class, 'store'])
    ->name('suggestion.store');
