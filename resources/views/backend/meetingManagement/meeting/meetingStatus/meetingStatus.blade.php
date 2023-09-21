@if ($data->meeting_status_id == 1)
    <button type="button" class="btn btn-warning btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
        data-target="#statusUpdateModal{{ $key }}" title="{{ trans('message.button.invite_update') }}">
        {{ trans('meeting.status.pending') }}
    </button>
@elseif($data->meeting_status_id == 2)
    <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}"
        title="{{ trans('message.button.invite_update') }}">
        {{ trans('meeting.status.canceled') }}
    </button>
@elseif($data->meeting_status_id == 3)
    <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
        data-target="#statusUpdateModal{{ $key }}" title="{{ trans('message.button.invite_update') }}">
        {{ trans('meeting.status.postponed') }}
    </button>
@elseif($data->meeting_status_id == 4)
    <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
        data-target="#statusUpdateModal{{ $key }}" title="{{ trans('message.button.invite_update') }}">
        {{ trans('meeting.status.preponed') }}
    </button>
@elseif($data->meeting_status_id == 5)
    <button type="button" class="btn btn-success btn-xs rounded-pill {{ setFont() }}"
        title="{{ trans('message.button.invite_update') }}">
        {{ trans('meeting.status.execute') }}
    </button>
@endif
