@if($data->status == true)
    <button type="button"
            class="btn btn-success btn-xs rounded-pill {{setFont()}}"
            data-toggle="modal"
            data-target="#statusModal{{$key}}"
            title="{{trans('message.button.status_update')}}"
    >
        {{trans('message.button.active')}}
    </button>
@elseif($data->status== false)
    <button type="button"
            class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
            data-toggle="modal"
            data-target="#statusModal{{$key}}"
            title="{{trans('message.button.status_update')}}"
    >
        {{trans('message.button.inactive')}}
    </button>
@endif