<?php

use App\Http\Controllers\EDMIS\DcDocumentController;
use Illuminate\Support\Facades\Route;

Route::resource('/dcDocument', DcDocumentController::class);
// Route::post('/dcDocument/add-file/{id}', [DcDocumentController::class,'store'] );
Route::get('dcDocuments/{id}', [DcDocumentController::class, 'showDetial']);
// Route::post('/meetingCategories/status/{id}', [MeetingCategoryController::class, 'status']);
