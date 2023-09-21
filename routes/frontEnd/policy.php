<?php

use App\Http\Controllers\FrontEnd\PrivacyPolicyController;
use Illuminate\Support\Facades\Route;

Route::get('policy', [PrivacyPolicyController::class, 'index']);
