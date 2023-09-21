<?php

namespace App\Http\Requests\FrontEnd;

use Illuminate\Foundation\Http\FormRequest;

class TokenStatusRequest extends FormRequest
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
            'type'=>'required',
            'token_no'=>'required',
        ];

    }
    public function messages()
    {
        return [
            'type.required' => getLan() =='np' ? 'प्रकार आवश्यक छ' : 'Type is required.',
            'token_no.required' => getLan() =='np' ? 'टिकट नं. आवश्यक छ' : 'Ticket is required.',
        ];
    }
}
