<?php

namespace App\Http\Requests\SystemSetting;

use Illuminate\Foundation\Http\FormRequest;

class OtpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
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
            'otp_limit' => 'required',
            'otp_duration' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'otp_limit.required' => trans('validation.pages.common.name_en_required'),
            'otp_duration.required' => trans('validation.pages.common.name_np_required'),
        ];
    }
}
