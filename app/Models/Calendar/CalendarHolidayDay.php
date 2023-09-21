<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalendarHolidayDay extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'calendar_holiday_id', 'gov_body_id'];
}
