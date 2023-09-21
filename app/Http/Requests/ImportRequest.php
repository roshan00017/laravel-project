<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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
            //'file'=> 'required|mimes:xlsx, csv, xls'
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => trans('validation.pages.common.file_required'),
            'file.mimes' => trans('validation.pages.common.file_type_message'),
        ];
    }
}
