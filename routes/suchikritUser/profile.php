<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::resource('/su', ProfileController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/users/status/{id}', [ProfileController::class, 'status']);

Route::post('/users/block_status/{id}', [ProfileController::class, 'blockStatus']);

Route::get('/my-profile', [ProfileController::class, 'profile']);

Route::post('/profile/profilePic', [ProfileController::class, 'profilePic']);

Route::post('/profileUpdate', [ProfileController::class, 'updateProfile']);

Route::post('/updatePassword', [ProfileController::class, 'updatePassword']);

Route::post('/users/passwordReset', [ProfileController::class, 'resetPassword']);

Route::post('users/fileDelete', [ProfileController::class, 'deleteFile']);

Route::post('/users/checkData', [ProfileController::class, 'checkData'])
    ->name('user.checkData');
