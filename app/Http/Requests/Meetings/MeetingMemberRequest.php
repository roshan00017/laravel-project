<?php

namespace App\Http\Requests\Meetings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MeetingMemberRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($request->is_karyapalika == 1) {
            return [
                'meeting_id' => 'required',
            ];

        } else {
            return [
                'meeting_id' => 'required',
                'name_en' => 'required',
                'name_np' => 'required',
                'office' => 'required',
                'post' => 'required',
                'contact_no' => 'required|regex:/^98\d{8}$/|min:10',
                'email' => 'email|unique:users,email',
                'is_invite' => 'required',
            ];

        }

    }

    public function messages()
    {
        return [

            'meeting_id' => trans('validation.pages.meeting_member.meeting'),
            'name_en' => trans('validation.pages.common.name_en_required'),
            'name_np' => trans('validation.pages.common.name_np_required'),
            'office' => trans('validation.pages.meeting_member.office'),
            'post' => trans('validation.pages.meeting_member.post'),
            'contact_no' => trans('validation.pages.meeting_member.contact_no'),
            'email' => trans('validation.pages.meeting_member.email'),
        ];
    }
}
