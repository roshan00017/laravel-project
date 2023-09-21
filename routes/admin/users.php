<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('/users', UserController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/users/status/{id}', [UserController::class, 'status']);

Route::post('/users/block_status/{id}', [UserController::class, 'blockStatus']);

Route::get('/my-profile', [UserController::class, 'profile']);

Route::post('/profile/profilePic', [UserController::class, 'profilePic']);

Route::post('/profileUpdate', [UserController::class, 'updateProfile']);

Route::post('/updatePassword', [UserController::class, 'updatePassword']);

Route::post('/users/passwordReset', [UserController::class, 'resetPassword']);

Route::post('users/fileDelete', [UserController::class, 'deleteFile']);

Route::post('/users/checkData', [UserController::class, 'checkData'])
    ->name('user.checkData');
