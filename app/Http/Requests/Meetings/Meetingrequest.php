<?php

namespace App\Http\Requests\Meetings;

use Illuminate\Foundation\Http\FormRequest;

class MeetingRequest extends FormRequest
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
            'name_en' => 'required',
            'name_np' => 'required',
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
