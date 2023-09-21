<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterComplaintRequest extends FormRequest
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
            'form_category_id' => 'required',
            'severity_type_id' => 'required',
            'description' => 'required',
            'office_id' => 'nullable',
            'file_name' => 'nullable|mimes:jpg,png,pdf,jpeg|max:2048',

        ];
    }

    public function messages()
    {

        return [
            'form_category_id.required' => trans('frontEndValidation.registercomplaint.form_category_id'),
            'severity_type_id.required' => trans('frontEndValidation.registercomplaint.severity_type_id'),
            'description.required' => trans('frontEndValidation.registercomplaint.description'),
            'office_id.nullable' => trans('frontEndValidation.registercomplaint.office_id'),
            'file_name.nullable' => trans('frontEndValidation.registercomplaint.file_name'),
            'file_name.mimes' => trans('frontEndValidation.registercomplaint.file_name_mimes'),
            'file_name.max' => trans('frontEndValidation.registercomplaint.file_name_max'),
        ];

    }
}
