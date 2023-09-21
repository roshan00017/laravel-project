<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules(Request $request)
    {
        if ($this->method() == 'PUT') {
            $rules = [
                //'role_id' => 'required',
                'full_name' => 'required|regex:/[A-Za-z. -]/|min:3|max:40',
                'avatar_image' => 'mimes:jpeg,jpg,png|max:1048',
            ];
        } else {
            if ($request->update_status == '1') {
                $rules = [
                    'full_name' => 'required|regex:/[A-Za-z. -]/|min:3|max:200',
                ];
            } elseif ($request->update_status == '2') {
                $rules = [
                    'email' => 'required|unique:users,email,'.Auth::user()->id,
                    'login_user_name' => 'required|min:4|max:40|unique:users,login_user_name,'.Auth::user()->id,

                ];
            } else {
                $rules = [
                    //'role_id' => 'required',
                    'full_name' => 'required|regex:/[A-Za-z. -]/|min:3|max:40',
                    'avatar_image' => 'mimes:jpeg,jpg,png||max:1048',
                    'email' => 'required|unique:users,email',
                    'login_user_name' => 'required|min:3|max:40|unique:users,login_user_name',

                ];
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'avatar_image.max' => trans('validation.pages.users_management.avatar_image_max'),
            'avatar_image.mimes' => trans('validation.pages.users_management.avatar_image_mimes'),
            'email.required' => trans('validation.pages.users_management.email_required'),
            'email.unique' => trans('validation.pages.users_management.email_unique'),
            'full_name.required' => trans('validation.pages.users_management.full_name_required'),
            'login_user_name.required' => trans('validation.pages.users_management.login_user_name_required'),
            'login_user_name.unique' => trans('validation.pages.users_management.login_user_name_unique'),
            'role_id.required' => trans('validation.pages.users_management.role_id'),

        ];
    }
}
