<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;

class AppointmentHandover extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'appointment_id',
        'handover_date_ad',
        'handover_date_bs',
        'handover_time',
        'handover_section',
        'handover_to_person_id',
        'handover_reason',
        'handover_taken_by',
        'handover_taken_date_bs',
        'handover_taken_date_ad',
    ];
}
