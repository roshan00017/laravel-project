<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserPasswordRequest extends FormRequest
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
     */
    public function rules(Request $request): array
    {
        $user_id = $request->user_id;
        if ($user_id == null) {
            return [
                'old' => 'required',
                'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'password_confirmation' => 'required',
            ];
        } else {
            return [
                'password' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'old.required' => trans('passwords.current_password_required_message'),
            'password.required' => trans('passwords.new_password_required_message'),
            'password.min' => trans('passwords.password_min_message'),
            'password.regex' => trans('passwords.password_validation_message'),
            'password_confirmation.required' => trans('passwords.confirm_password_required_message'),
        ];
    }
}
