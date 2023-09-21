<?php

use App\Http\Controllers\DCC\ServiceRelatedDocumentController;
use Illuminate\Support\Facades\Route;

Route::resource('/servicesRelatedDocument', ServiceRelatedDocumentController::class)
    ->except(['create', 'edit', 'show']);
