<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;

class AppointmentLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'appointment_id',
        'appointment_date_ad',
        'appointment_date_bs',
        'appointment_time',
        'appointment_time',
        'appointment_section',
        'appointment_to_person_id',
        'appointment_reason',
        'action_date_bs',
        'action_date_ad',
        'status',
        'status_date_en',
        'status_date_np',
        'appointment_type',
        'action_by',
    ];
}
