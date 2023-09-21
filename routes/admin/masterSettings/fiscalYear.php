<?php

use App\Http\Controllers\MasterSettings\FiscalYearController;
use Illuminate\Support\Facades\Route;

Route::resource('/fiscalYears', FiscalYearController::class)
    ->except(['create', 'edit', 'show']);
Route::post('/fiscalYears/status/{id}', [FiscalYearController::class, 'status']);
