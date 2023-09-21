<div class="form-group col-md-4 {{setFont()}}">
    <label>
        {{ trans('message.pages.meeting_member.is_invite') }}
    </label>
    <br>
    <input class="radio-button"
           type="radio"
           name="status"
           @if($data->meeting_status_id == true) checked @endif
           value="1"
           style="margin-top: 2px"
    >
    {{ trans('message.button.active') }}
    <input class="radio-button"
           type="radio"
           name="status"
           @if($data->meeting_status_id == false) checked @endif
           value="0" style="margin-top: 2px"
    >
    {{ trans('message.button.uninvite') }}
</div>