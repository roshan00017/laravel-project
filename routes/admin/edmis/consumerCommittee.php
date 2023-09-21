<?php

use App\Http\Controllers\EDMIS\ConsumerCommitteeController;
use Illuminate\Support\Facades\Route;

Route::resource('/consumerCommittee', ConsumerCommitteeController::class);
