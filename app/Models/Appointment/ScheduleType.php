<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;

class ScheduleType extends Model
{
    public $timestamps = false;

    protected $table = 'schedule_types';

    protected $fillable = [
        'name_en',
        'name_np',
        'code',
        'status',
    ];
}
