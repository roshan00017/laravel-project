@if ($data->is_present == true)
    <button type="button"
            class="btn btn-success btn-xs rounded-pill {{setFont()}}"
            title="{{trans('message.button.invite_update')}}"
    >
        {{trans('message.button.yes')}}
    </button>
    &nbsp;
    <input class="check-box" name="present_status"
           data-id="{{$data->id}}" type="checkbox">
    &nbsp;
    {{trans('message.button.no')}}
@else
    <button type="button"
            class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
            title="{{trans('message.button.invite_update')}}"
    >
        {{trans('message.button.no')}}
    </button>
    &nbsp;
    <input class="check-box"
           name="present_status"
           data-id="{{$data->id}}"
           type="checkbox"
    >
    &nbsp;
    {{trans('message.button.yes')}}
@endif