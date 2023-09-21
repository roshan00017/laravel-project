<?php

use App\Http\Controllers\Chat\GroupChatController;
use App\Http\Controllers\Chat\GroupController;
use App\Http\Controllers\Chat\GroupMembersController;
use App\Http\Controllers\Chat\SingleChatController;
use Illuminate\Support\Facades\Route;

Route::resource('/group', GroupController::class);

Route::get('groupInfo', [GroupController::class, 'groupInfo'])
    ->name('chat.groupInfo');
// Route::resource('/chat/{id}', SingleChatController::class);
Route::resource('/chat/groups', GroupChatController::class);
// Route::resource('/members', GroupMembersController::class);

Route::get('memberInfo', [GroupController::class, 'memberInfo'])
    ->name('chat.memberInfo');

Route::post('groupChat', [GroupController::class, 'storeGroupChat'])
    ->name('chat.groupChat');

Route::put('memberUpdate', [GroupController::class, 'memberUpdate'])
    ->name('member.memberUpdate');

Route::delete('memberDelete', [GroupController::class, 'memberDelete'])
    ->name('member.memberDelete');

Route::delete('groupDelete', [GroupController::class, 'groupDelete'])
    ->name('group.groupDelete');
