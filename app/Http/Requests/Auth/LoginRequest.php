<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        if (systemSetting() && systemSetting()->login_captcha_required == 1) {
            return [
                'identity' => 'required|min:3|string',
                'password' => 'required|min:3|string',
                'captcha' => 'required|captcha',
            ];
        } else {
            return [
                'identity' => 'required|min:3|string',
                'password' => 'required|min:3|string',
            ];
        }
    }

    public function messages()
    {
        return [
            'captcha.captcha' => trans('auth.login.captcha_confirm'),
            'captcha.required' => trans('auth.login.captcha_required'),
            'identity.required' => trans('auth.login.identity_required'),
            'password.min' => trans('auth.login.password_min'),
            'password.required' => trans('auth.login.password_required'),
        ];
    }
}
