<?php

use App\Http\Controllers\MasterSearch\MasterSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/masterSearch', [MasterSearchController::class, 'index']);
