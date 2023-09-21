<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;

class AppointmentAccessUser extends Model
{
    protected $table = 'appointment_access_users';

    protected $fillable =
        [
            'user_id',
            'access_user_type',
            'appointment_access_user_id',
        ];
}
