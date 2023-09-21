<?php

use App\Http\Controllers\FrontEnd\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('frontEnd.dashboard');

Route::post('token-status-info', [DashboardController::class, 'checkTokenStatus'])
    ->name('frontEnd.token-status-info');


include_once 'faq.php';

include_once 'policy.php';

include_once 'suggestion.php';

include_once 'officeAutomation.php';

include_once 'grievance.php';

include_once 'dcc.php';

include_once 'meeting.php';

include_once 'appointment.php';

include_once 'suchikrit.php';
