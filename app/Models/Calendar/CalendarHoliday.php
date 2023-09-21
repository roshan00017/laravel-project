<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalendarHoliday extends Model
{
    use SoftDeletes;

    protected $fillable = ['id',
        'name_np',
        'description',
        'name_en',
        'date_np',
        'date_en',
        'holiday_type',
        'status',
        'is_notify',
    ];
}
