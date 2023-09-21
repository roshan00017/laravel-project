<?php

use App\Http\Controllers\Meetings\KaryapalikaMemberController;
use Illuminate\Support\Facades\Route;

Route::resource('/masterSettings/karyapalikaMembers', KaryapalikaMemberController::class)
    ->except(['create', 'edit', 'show']);

Route::post('/masterSettings/karyapalikaMembers/status/{id}', [KaryapalikaMemberController::class, 'status']);
