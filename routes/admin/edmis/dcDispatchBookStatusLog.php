<?php

use App\Http\Controllers\EDMIS\DcDispatchBookStatusLogController;
use Illuminate\Support\Facades\Route;

Route::get('/dcDispacthBookStatusLogDetails', [DcDispatchBookStatusLogController::class, 'index']);
Route::get('/dcDispacthBookStatusLogDetails/{id}', [DcDispatchBookStatusLogController::class, 'show']);
