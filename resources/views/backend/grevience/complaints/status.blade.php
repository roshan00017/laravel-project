@if($data->status == 1)
    <button type="button" class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
            data-target="#statusModal{{ $key }}" title="{{ trans('message.button.status_update') }}">
        {{ getLan() == 'np' ? $data->complaintStatus->name_ne : $data->complaintStatus->name }}
    </button>
@elseif($data->status == 2)
    <button type="button" class="btn btn-success btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
    data-target="#statusModal{{ $key }}" title="{{ trans('message.button.status_update') }}">
        {{ getLan() == 'np' ? $data->complaintStatus->name_ne : $data->complaintStatus->name }}
    </button>
@elseif($data->status == 3)
    <button type="button" class="btn btn-info btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
            data-target="#statusModal{{ $key }}" title="{{ trans('message.button.status_update') }}">
        {{ getLan() == 'np' ? $data->complaintStatus->name_ne : $data->complaintStatus->name }}
    </button>
@elseif($data->status == 6)
    <button type="button" class="btn btn-info btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
            data-target="#statusModal{{ $key }}" title="{{ trans('message.button.status_update') }}">
        {{ getLan() == 'np' ? $data->complaintStatus->name_ne : $data->complaintStatus->name }}
    </button>
@elseif($data->status == 4)
    <button type="button" class="btn btn-warning btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
            data-target="#statusModal{{ $key }}" title="{{ trans('message.button.status_update') }}">
        {{ getLan() == 'np' ? $data->complaintStatus->name_ne : $data->complaintStatus->name }}
    </button>
@elseif($data->status == 8)
    <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
            data-target="#statusModal{{ $key }}" title="{{ trans('message.button.status_update') }}">
        {{ getLan() == 'np' ? $data->complaintStatus->name_ne : $data->complaintStatus->name }}
    </button>
@endif
