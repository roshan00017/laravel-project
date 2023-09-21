<?php

namespace App\Http\Requests\FrontEnd;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
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
    public function rules(): array
    {
            return [
                'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'password_confirmation' => 'required',
            ];

    }

    public function messages()
    {
        return [
            'password.required' => trans('passwords.new_password_required_message'),
            'password.min' => trans('passwords.password_min_message'),
            'password.regex' => trans('passwords.password_validation_message'),
            'password_confirmation.required' => trans('passwords.confirm_password_required_message'),
        ];
    }
}
