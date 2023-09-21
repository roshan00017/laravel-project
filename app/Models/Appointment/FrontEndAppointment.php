<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;

class FrontEndAppointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'fy_id',
        'client_id',
        'full_name',
        'email',
        'mobile_no',
        'appointment_no',
        'appointment_date_ad',
        'appointment_date_bs',
        'time',
        'address',
        'visiting_section',
        'visiting_to_person_id',
        'visiting_purpose_id',
        'visiting_purpose_reason',
        'appointment_taken_date_ad',
        'appointment_taken_date_bs',
        'visiting_status',
        'appointment_type',
        'visit_count',
        'appointment_month_code',
        'date_bs',
        'date_ad',
        'appointment_time',
        'appointment_section',
        'appointment_to_emp_designation',
        'appointment_to_elected_designation',
        'emp_id',
        'ep_id',
        'appointment_purpose_id',
        'appointment_purpose_reason',
        'full_name',
        'name',
        'address_info',
        'email_address',
        'mobile',
    ];
}
