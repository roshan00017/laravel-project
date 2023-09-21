<?php

use App\Http\Controllers\FrontEnd\OfficeAutomationController;
use Illuminate\Support\Facades\Route;

Route::get('office-automation-info', [OfficeAutomationController::class, 'index'])
    ->name('office-automation.index');
