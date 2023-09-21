@php
    $name = setName();
@endphp
<div class="modal fade" id="agendaListModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('meeting.meeting.page_title') }} {{ trans('message.pages.common.code') }}
                    {{ $data->code }} {{ getLan() == 'np' ? 'को  एजेन्डा सूची' : 'Agenda List' }}
                    {{ trans('message.pages.roles.details') }}

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $agendaList = @$meetingRepo->getMeetingAgendaList(@$data->id);
                ?>
                <div class="row">
                    @if (sizeof($agendaList) > 0)
                        <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline">
                                <thead class="th-header">
                                    <tr class="{{ setFont() }}">
                                        <th class="{{ setFont() }}" width="1%">
                                            {{ trans('message.commons.s_n') }}
                                        </th>
                                        <th class="{{ setFont() }}" width="50%">
                                            {{ trans('meeting.meeting_agenda_list.title') }}
                                        </th>
                                        <th class="{{ setFont() }}" width="50%">
                                            {{ trans('meeting.meeting_agenda_list.description') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agendaList as $key => $agenda)
                                        <tr>
                                            <th scope=row {{ setFont() }}>
                                                {{ ++$key }}
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

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                            <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{ trans('message.commons.no_record_found') }}
                            </label>
                        </div>
                    @endif

                </div>


                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{ setFont() }}"
                        data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{ trans('message.button.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
