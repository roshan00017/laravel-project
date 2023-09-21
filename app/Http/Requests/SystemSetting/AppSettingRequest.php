<?php

namespace App\Http\Requests\SystemSetting;

use Illuminate\Foundation\Http\FormRequest;

class AppSettingRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'app_name' => 'required|min:3|max:200',
            'app_logo' => 'nullable|mimes:jpeg,jpg,png||max:1048',

        ];
    }

    public function messages()
    {
        return [
            'app_name.required' => 'The  app  name field is required.',
            'app_logo.mimes' => 'The app logo must be a file of type: jpeg, jpg, png.',
            'app_logo.max' => 'Image size must be 1 MB !',
            'login_user_name.min' => 'The user name  at least 4 length.',
            'app_name.min' => 'The  name  at least 3 length.',

        ];
    }
}
