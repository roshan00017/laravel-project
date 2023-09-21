<?php

namespace App\Http\Requests\FrontEnd;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentInfoRequest1 extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'address_info' => 'required',
            'email_address' => 'required|email',
            'mobile' => 'required|digits:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('frontEndValidation.suggestion.name'),
            'name.min' => trans('frontEndValidation.suggestion.name_min'),
            'name.max' => trans('frontEndValidation.suggestion.name_max'),
            'mobile.required' => trans('frontEndValidation.suggestion.mobile'),
            'mobile.digits' => trans('frontEndValidation.suggestion.mobile_digits'),
            'address_info.required' => trans('frontEndValidation.suggestion.address_info'),
            'email_address.required' => trans('frontEndValidation.suggestion.email'),
            'email_address.email' => trans('frontEndValidation.suggestion.email_email'),
        ];
    }
}
