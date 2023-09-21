<?php

use App\Http\Controllers\DCC\ServiceTokenManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/serviceTokenList/', [ServiceTokenManagementController::class, 'index'])
    ->name('serviceTokenList.index');
