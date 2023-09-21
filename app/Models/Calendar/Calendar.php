<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendar extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'fy_code', 'month_code', 'week_day_code', 'day', 'full_date', 'full_date_en', 'status'];

    public function month()
    {
        return $this->belongsTo(CalendarMonth::class, 'month_code', 'code');
    }

    public function weekDays()
    {
        return $this->belongsTo(CalendarWeekDay::class, 'week_day_code', 'code');
    }
}
