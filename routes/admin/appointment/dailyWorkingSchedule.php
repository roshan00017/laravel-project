
<?php

use App\Http\Controllers\Appointment\DailyWorkingScheduleController;
use Illuminate\Support\Facades\Route;

Route::resource('/dailyschedules', DailyWorkingScheduleController::class)->except(['show']);
