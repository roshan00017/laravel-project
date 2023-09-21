<?php

use App\Http\Controllers\EDMIS\MemberTypeController;
use Illuminate\Support\Facades\Route;

Route::resource('/membertypes', MemberTypeController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/membertypes/status/{id}', [MemberTypeController::class, 'status']);
