@if($data->meeting->meeting_status_id  == 5)
         <button type="button"
            class="btn btn-success btn-xs rounded-pill {{setFont()}}"
            title="{{trans('message.button.invite_update')}}"
         >
        {{trans('message.button.yes')}}
    </button>
@else
    <button type="button"
            class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                 data-toggle="modal"
            data-target="#fileStatusModal{{$key}}"
            title="{{trans('message.button.invite_update')}}"
         >
        {{trans('message.button.no')}}
    </button>
@endif