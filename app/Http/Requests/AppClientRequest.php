<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppClientRequest extends FormRequest
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
            'code' => 'unique:app_client,code',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => trans('validation.unique'),
        ];
    }
}