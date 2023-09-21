<?php
$agendaList = @$meetingRepo->getMeetingAgendaList(@$data->id);
?>
@if ($data->agenda_finalized == 1)
    <button type="button" class="btn btn-success btn-xs rounded-pill {{ setFont() }}"
            title="{{ trans('message.button.invite_update') }}">
        {{ trans('message.button.yes') }}
    </button>
@elseif($data->agenda_finalized == 0)
    @if (sizeof($agendaList) > 0)
        @if($data->meeting_status_id ==2 || $data->meeting_status_id ==5 )
            <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}">
                {{ trans('message.button.no') }}
            </button>
        @else
            <a href="{{url('/meetingAgendaDetails/'.hashIdGenerate($data->id))}}"
               class="btn btn-danger btn-xs rounded-pill {{ setFont() }}"
               title="{{ trans('message.button.show') }}">
                {{ trans('message.button.no') }}
            </a>
        @endif
    @else
        @if($data->meeting_status_id ==2 || $data->meeting_status_id ==5 )
            <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}">
                {{ trans('message.button.no') }}
            </button>
        @else
            <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
                    data-target="#agendaStatusModal{{ $key }}" title="{{ trans('message.button.invite_update') }}">
                {{ trans('message.button.no') }}
            </button>
        @endif
    @endif
@endif
