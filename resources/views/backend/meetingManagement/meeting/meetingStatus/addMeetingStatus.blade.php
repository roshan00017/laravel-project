<label>
    {{ trans('message.pages.meeting_member.meeting_status_id') }}
</label>
<br>
<input class="radio-button"
       type="radio"
       name="meeting_status_id"
       checked
       value="1"
       style="margin-top: 2px"
>
{{ trans('meeting.meeting.meeting_status_id_active') }}
&nbsp; &nbsp;
<input class="radio-button"
       type="radio"
       name="meeting_status_id"
       value="0"
       style="margin-top: 2px"
>
{{ trans('meeting.meeting.meeting_status_id_inactive') }}