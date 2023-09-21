<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

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
        'created_by',
        'updated_by',
        'deleted_by',
        'visited_date_en',
        'visited_date_np',
        'visit_count',
        'appointment_month_code',
        'visiting_to_elected_designation',
        'visiting_to_emp_designation',
        'visiting_to_designation_id',
        'elected_person_id',
        'employee_id',
        'appointment_status',
        'complaint_process',
    ];

    public function appointmentStatus(): BelongsTo
    {
        return $this->belongsTo(AppointmentStatus::class, 'appointment_status', 'id');
    }
}
