<?php

namespace App\Http\Requests\FrontEnd;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInfoRequest extends FormRequest
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
            'name' => 'required',
            'email_address' => 'required',
            'address_info' => 'required',
            'mobile' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('frontEndValidation.suggestion.full_name_required'),
            'mobile.required' => trans('frontEndValidation.suggestion.mobile_required'),
        ];
    }
}
