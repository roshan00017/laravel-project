<?php

namespace App\Http\Requests\FrontEnd;

use Illuminate\Foundation\Http\FormRequest;

class SuggestionRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'mobile' => 'required|digits:10',
            'email' => 'required|email',
            'suggestion_category_id' => 'required',
            'suggestions' => 'required',
            'suggestion_file' => 'nullable|mimes:jpeg,jpg,png,pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('frontEndValidation.suggestion.name'),
            'name.min' => trans('frontEndValidation.suggestion.name_min'),
            'name.max' => trans('frontEndValidation.suggestion.name_max'),
            'mobile.required' => trans('frontEndValidation.suggestion.mobile'),
            'mobile.digits' => trans('frontEndValidation.suggestion.mobile_digits'),
            'email.required' => trans('frontEndValidation.suggestion.email'),
            'email.email' => trans('frontEndValidation.suggestion.email_email'),
            'suggestion_category_id.required' => trans('frontEndValidation.suggestion.suggestion_category_id'),
            'suggestions.required' => trans('frontEndValidation.suggestion.suggestions'),
            'suggestion_file.mimes' => trans('frontEndValidation.suggestion.suggestion_file_mimes'),
            'suggestion_file.max' => trans('frontEndValidation.suggestion.suggestion_file_max'),
        ];
    }
}
