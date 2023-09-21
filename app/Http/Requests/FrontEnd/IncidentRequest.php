<?php

namespace App\Http\Requests\FrontEnd;

use Illuminate\Foundation\Http\FormRequest;

class IncidentRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'mobile' => 'required|digits:10',
            'description' => 'required',
            'title' => 'required|min:3|max:100',
            'email' => 'required|email',
            'file' => 'nullable|mimes:jpg,png,pdf,jpeg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('frontEndValidation.registercomplaint.name_ne'),
            'name.min' => trans('frontEndValidation.registercomplaint.name_ne_min'),
            'name.max' => trans('frontEndValidation.registercomplaint.name_ne_max'),
            'mobile.required' => trans('frontEndValidation.registercomplaint.mobile_no'),
            'mobile.digits' => trans('frontEndValidation.registercomplaint.mobile_no_digits'),
            'title.required' => trans('frontEndValidation.registercomplaint.title'),
            'title.min' => trans('frontEndValidation.registercomplaint.title_min'),
            'title.max' => trans('frontEndValidation.registercomplaint.title_max'),
            'description.required' => trans('frontEndValidation.registercomplaint.description'),
            'email.required' => trans('frontEndValidation.registercomplaint.email'),
            'email.email' => trans('frontEndValidation.registercomplaint.email_email'),
            '.nullable' => trans('frontEndValidation.registercomplaint.file_name'),
            'file.mimes' => trans('frontEndValidation.registercomplaint.file_name_mimes'),
            'file.max' => trans('frontEndValidation.registercomplaint.file_name_max'),
        ];
    }
}
