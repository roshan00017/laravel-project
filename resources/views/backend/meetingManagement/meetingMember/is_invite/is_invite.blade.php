@if($data->is_invite == true)
    <button type="button"
        class="btn btn-success btn-xs rounded-pill {{setFont()}}"
        data-toggle="modal"
        data-target="#isActiveModal{{$key}}"
        title="{{trans('message.button.invite_update')}}"
        >
        {{trans('message.button.yes')}}
    </button>
@elseif($data->is_invite== false)
        <button type="button"
            class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
            data-toggle="modal"
            data-target="#isActiveModal{{$key}}"
            title="{{trans('message.button.invite_update')}}"
        >
        {{trans('message.button.no')}}
        </button>
@endif