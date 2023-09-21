<?php

namespace App\Http\Requests\SystemSetting;

use Illuminate\Foundation\Http\FormRequest;

class SmsSettingRequest extends FormRequest
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
            'sms_token' => 'required',
            'sms_from' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sms_token.required' => trans('validation.pages.common.name_en_required'),
            'sms_from.required' => trans('validation.pages.common.name_np_required'),
        ];
    }
}
