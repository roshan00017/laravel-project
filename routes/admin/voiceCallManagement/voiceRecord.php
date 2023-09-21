<?php

use App\Http\Controllers\VoiceCallManagement\VoiceRecordController;
use Illuminate\Support\Facades\Route;

Route::get('/voiceRecordManagement', [VoiceRecordController::class, 'index']);
