<div class="form-group col-md-12 ">
    <label class="{{ setFont() }}">
        {{ trans('meeting.meeting.agenda') }}
    </label>
    <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
        @if (sizeof($agendaList) > 0)

            <thead class="th-header">

            <tr class="{{ setFont() }}">

                <th width="10px">
                    {{ trans('message.commons.s_n') }}
                </th>

                <th>
                    {{ trans('meeting.meeting.agenda_title') }}
                </th>

                <th>
                    {{ trans('meeting.meeting.description') }}
                </th>

                <th style="width: 100px;">
                    {{ trans('message.commons.action') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($agendaList as $key => $agenda)
                <tr>
                    <th scope="row {{ setFont() }}">
                        {{ ($agendaList->currentpage() - 1) * $agendaList->perpage() + $key + 1 }}
                    </th>

                    <td class="{{ setFont() }}">
                        @if (isset($agenda->title))
                            {{ $agenda->title }}
                        @endif
                    </td>

                    <td class="{{ setFont() }}">
                        @if (isset($agenda->description))
                            {{ $agenda->description }}
                        @endif
                    </td>


                    <td>

                        @if (allowEdit() && $value->agenda_finalized == 0 && $value->meeting_status_id
                                            == 1)
                            <button type="button" class="btn btn-info btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
                                    data-target="#editModal{{ $key }}" data-placement="top"
                                    title="{{ trans('message.button.edit') }}">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        @endif
                        &nbsp;

                        @if (allowDelete() && $value->agenda_finalized == 0 && $value->meeting_status_id
                                            == 1)
                            <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}"
                                    data-toggle="modal" data-target="#deleteModal{{ $key }}"
                                    data-placement="top" title="{{ trans('message.button.delete') }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif

                    </td>
                </tr>
                {{--                    @include('backend.meetingManagement.meeting.agendaDetails.updateModal')--}}
                @include('backend.meetingManagement.meeting.agendaDetails.updateModal')
                @include('backend.meetingManagement.meeting.agendaDetails.deleteModal')
            @endforeach
            </tbody>

    </table>
    @else
        <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
            <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                <i class="fas fa-ban" style="margin-top: 6px"></i>
                {{ trans('message.commons.no_record_found') }}
            </label>
        </div>
    @endif

</div>
