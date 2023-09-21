<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    public $timestamps = false;

    protected $table = 'appointment_status';

    protected $fillable = [
        'name_en',
        'name_np',
        'code',
        'status',
    ];
}
