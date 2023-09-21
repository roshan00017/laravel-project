<?php

use App\Http\Controllers\Grevience\ComplaintController;
use Illuminate\Support\Facades\Route;

Route::resource('/complaints', ComplaintController::class);
Route::post('/complaints/status/{id}', [ComplaintController::class, 'status']);
Route::post('/complaintsProgres', [ComplaintController::class, 'postComplaintProgress'])->name('complaint.progress');
