<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyWorkingSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'daily_working_schedules';

    protected $fillable = [
        'fy_id',
        'client_id',
        'start_time',
        'end_time',
        'location',
        'title',
        'details',
        'duration',
        'schedule_added_date_en',
        'schedule_added_date_np',
        'schedule_date_np',
        'schedule_date_en',
        'created_by',
        'updated_by',
        'deleted_by',
        'schedule_type',
        'type_id',
        'schedule_to_person_id',
        'schedule_end_date_en',
        'schedule_end_date_np',
        'is_schedule_same_day',
    ];
}
