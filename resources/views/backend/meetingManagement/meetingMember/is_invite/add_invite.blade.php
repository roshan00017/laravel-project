<label>
    {{ trans('message.pages.meeting_member.is_invite') }}
</label>
<br>
<input class="radio-button"
       type="radio"
       name="is_invite"
       checked
       value="1"
       style="margin-top: 2px"
>
{{ trans('message.button.yes') }}
&nbsp; &nbsp;
<input class="radio-button"
       type="radio"
       name="is_invite"
       value="0" 
       style="margin-top: 2px"
>
{{ trans('message.button.no') }}