<?php

use App\Http\Controllers\Meetings\FinalVerdictController;
use App\Http\Controllers\Meetings\MeetingAgendaListController;
use App\Http\Controllers\Meetings\MeetingController;
use App\Http\Controllers\Meetings\MeetingMemberController;
use Illuminate\Support\Facades\Route;

Route::resource('/finalVerdicts', FinalVerdictController::class)
    ->except(['edit', 'show']);

Route::resource('/meetingAgendaList', MeetingAgendaListController::class)
    ->except(['edit', 'show']);
Route::post('/meetingAgendaList/status/{id}', [MeetingAgendaListController::class, 'status']);

Route::resource('/meetings', MeetingController::class);

Route::post('/meeting/status/{id}', [MeetingController::class, 'status']);

Route::post('/meetings/agendaStatusUpdate/{id}', [MeetingController::class, 'agendaStatusUpdate']);

Route::post('/meetings/meetingStatusUpdate/{id}', [MeetingController::class, 'meetingStatusUpdate']);

Route::resource('/meetingMembers', MeetingMemberController::class)
    ->except(['edit', 'show']);

Route::post('/meetingMembers/status/{id}', [MeetingMemberController::class, 'status']);

Route::post('/addMeetingMembers', [MeetingController::class, 'addMeetingMembers']);

Route::get('/meetingAgendaList/create/{id}', [MeetingController::class, 'addAgendaByMeeting']);

Route::get('/meetingAgendaDetails/{id}', [MeetingController::class, 'meetingAgendaDetails'])
    ->name('agendaDetails');

Route::get('/agendaDetailsByMeeting/{id}', [MeetingController::class, 'agendaDetailsByMeeting'])
    ->name('agendaDetailsByMeeting');

Route::get('/memberDetailsByMeeting/{id}', [MeetingController::class, 'memberDetailsByMeeting'])
    ->name('memberDetailsByMeeting');