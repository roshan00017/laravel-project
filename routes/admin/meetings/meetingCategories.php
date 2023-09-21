<?php

use App\Http\Controllers\Meetings\MeetingCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('masterSettings')->group(function () {
    Route::resource('/meetingCategories', MeetingCategoryController::class)
        ->except(['create', 'edit', 'show']);

    Route::post('/meetingCategories/status/{id}', [MeetingCategoryController::class, 'status']);

});
