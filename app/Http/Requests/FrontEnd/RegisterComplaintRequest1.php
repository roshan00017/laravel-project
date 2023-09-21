<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterComplaintRequest1 extends FormRequest
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
            'name_ne' => 'required|min:3|max:100',
            'tole' => 'required|min:3|max:100',
            'mobile_no' => 'required|digits:10',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {

        return [
            'name_ne.required' => trans('frontEndValidation.registercomplaint.name_ne'),
            'name_ne.min' => trans('frontEndValidation.registercomplaint.name_ne_min'),
            'name_ne.max' => trans('frontEndValidation.registercomplaint.name_ne_max'),
            'tole.required' => trans('frontEndValidation.registercomplaint.tole'),
            'tole.min' => trans('frontEndValidation.registercomplaint.tole_min'),
            'tole.max' => trans('frontEndValidation.registercomplaint.tole_max'),
            'mobile_no.required' => trans('frontEndValidation.registercomplaint.mobile_no'),
            'mobile_no.digits' => trans('frontEndValidation.registercomplaint.mobile_no_digits'),
            'email.required' => trans('frontEndValidation.registercomplaint.email'),
            'email.email' => trans('frontEndValidation.registercomplaint.email_email'),
        ];

    }
}
