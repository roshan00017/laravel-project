<?php

namespace App\Http\Requests\FrontEnd;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'appointment_time' => 'required', // Add your validation rules for 'appointment_time' field
            'appointment_section' => 'required', // Add your validation rules for 'appointment_section' field
            'appointment_to_emp_designation' => 'required_if:appointment_section,om', // Add your validation rules for 'appointment_to_emp_designation' field
            'appointment_to_elected_designation' => 'required_if:appointment_section,km', // Add your validation rules for 'appointment_to_elected_designation' field
            'appointment_purpose_id' => 'required', // Add your validation rules for 'appointment_purpose_id' field
        ];
    }

    public function messages()
    {
        return [
            'appointment_time.required' => trans('frontEndValidation.appointment.appointment_time'),
            'appointment_section.required' => trans('frontEndValidation.appointment.appointment_section'),
            'appointment_to_emp_designation.required_if' => trans('frontEndValidation.appointment.appointment_to_emp_designation'),
            'appointment_to_elected_designation.required_if' => trans('frontEndValidation.appointment.appointment_to_elected_designation'),
            'appointment_purpose_id.required' => trans('frontEndValidation.appointment.appointment_purpose_id'),

        ];
    }
}
