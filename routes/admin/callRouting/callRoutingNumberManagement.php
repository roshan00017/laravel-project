<?php

use App\Http\Controllers\CallRouting\CallRoutingNumberManagementController;
use Illuminate\Support\Facades\Route;

Route::resource('/callRoutingNumberManagement', CallRoutingNumberManagementController::class)
    ->except(['create', 'edit', 'show']);
