<?php

use App\Http\Controllers\BasicDetails\PrivacyPolicyController;
use Illuminate\Support\Facades\Route;

Route::resource('/privacyPolicies', PrivacyPolicyController::class)
    ->except(['create', 'edit', 'show']);
