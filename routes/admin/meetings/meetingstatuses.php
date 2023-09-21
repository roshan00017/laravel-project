<?php

use App\Http\Controllers\Meetings\MeetingStatusController;
use Illuminate\Support\Facades\Route;

Route::resource('/meetingstatuses', MeetingStatusController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/meetingstatuses/status/{id}', [MeetingStatusController::class, 'status']);
