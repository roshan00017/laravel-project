<?php

namespace App\Http\Requests\FrontEnd;

use Illuminate\Foundation\Http\FormRequest;

class SuchikritRegisterRequest extends FormRequest
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
            'full_name_np' => 'required',
            'full_name_en' => 'required',
            'mobile_no' => 'required|unique:suchikrit_users,mobile_no',
            'email' => 'required|email|unique:suchikrit_users,email',
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
