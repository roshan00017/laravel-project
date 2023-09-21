<div class="form-group col-md-4 {{setFont()}}">
    <label>
        {{ trans('message.commons.status') }}
    </label>
    <br>
    <input class="radio-button"
           type="radio"
           name="status"
           @if($data->status == true) checked @endif
           value="1"
           style="margin-top: 2px"
    >
    {{ trans('message.button.active') }}
    &nbsp; &nbsp;
    <input class="radio-button"
           type="radio"
           name="status"
           @if($data->status == false) checked @endif
           value="0" style="margin-top: 2px"
    >
    {{ trans('message.button.inactive') }}
</div>
