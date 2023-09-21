<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
            'name_en' => 'required',
            'name_np' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => trans('validation.pages.common.name_en_required'),
            'name_np.required' => trans('validation.pages.common.name_np_required'),
        ];
    }
}
