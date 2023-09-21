<?php

use App\Http\Controllers\Roles\MenuController;
use App\Http\Controllers\Roles\PermissionController;
use App\Http\Controllers\Roles\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('roleManagement')->group(function () {
    Route::resource('/menus', MenuController::class)
        ->except(['create', 'edit', 'show']);

    Route::post('/menus/menuControllerChangeStatus/{id}', [MenuController::class, 'status']);

    Route::resource('/roles', RoleController::class)
        ->except(['create', 'edit', 'show']);

    Route::post('/roles/status/{id}', [RoleController::class, 'status']);

    Route::get('/permissions', [PermissionController::class, 'index']);

    Route::get('permissions/{allowId}/{id}', [PermissionController::class, 'changeAccess']);
});
