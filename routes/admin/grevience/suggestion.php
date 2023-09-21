<?php

use App\Http\Controllers\Grevience\SuggestionController;
use Illuminate\Support\Facades\Route;

Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestion');

Route::get('/suggestions/{id}', [SuggestionController::class, 'show'])->name('suggestions.show');
