<?php

use App\Http\Controllers\BasicDetails\LetterSendingMediumController;
use Illuminate\Support\Facades\Route;

Route::resource('/letterSendingMedium', LetterSendingMediumController::class)
    ->except(['create', 'edit', 'show']);

// Route::post('/letterSendingMedium/status/{id}', [LetterSendingMediumController::class, 'status']);
