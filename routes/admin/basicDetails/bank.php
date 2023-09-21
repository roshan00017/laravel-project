<?php

use App\Http\Controllers\BasicDetails\BankController;
use Illuminate\Support\Facades\Route;

Route::resource('/bank', BankController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/bank/status/{id}', [BankController::class, 'status']);
