<div class="form-group col-md-4 {{setFont()}}">
    <label>
        {{ trans('message.pages.meeting_member.is_invite') }}
    </label>
    <br>
    <input class="radio-button"
           type="radio"
           name="status"
           @if($data->is_invite == true) checked @endif
           value="1"
           style="margin-top: 2px"
    >
    {{ trans('message.button.yes') }}
    <input class="radio-button"
           type="radio"
           name="status"
           @if($data->is_invite == false) checked @endif
           value="0" style="margin-top: 2px"
    >
    {{ trans('message.button.no') }}
</div>
