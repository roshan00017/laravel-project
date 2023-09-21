<?php

use App\Http\Controllers\Meetings\MeetingLinkListController;
use Illuminate\Support\Facades\Route;

Route::get('/meetingLinkList', [MeetingLinkListController::class, 'index']);
