<?php

use App\Http\Controllers\Grevience\SuggestionCategoryController;
use Illuminate\Support\Facades\Route;

Route::resource('/suggestionCategories', SuggestionCategoryController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/suggestionCategories/status/{id}', [SuggestionCategoryController::class, 'status']);
