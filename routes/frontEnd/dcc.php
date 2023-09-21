<?php

use App\Http\Controllers\FrontEnd\DCCController;
use Illuminate\Support\Facades\Route;

Route::get('digital-citizenship-charter-info', [DCCController::class, 'index'])
    ->name('digital-citizenship-charter.index');
