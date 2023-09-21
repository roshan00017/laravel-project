<?php

use App\Http\Controllers\FrontEnd\FaqController;
use Illuminate\Support\Facades\Route;

Route::get('faqs', [FaqController::class, 'index']);
