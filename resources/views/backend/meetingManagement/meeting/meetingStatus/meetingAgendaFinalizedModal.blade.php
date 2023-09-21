<?php
$agendaList = @$meetingRepo->getMeetingAgendaList(@$data->id);
?>
<div class="modal fade statusUpdateModal " id="agendaStatusModal{{ $key }}" aria-hidden="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    @if (systemSetting())
                        {{ getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
                    @else
                        {{ trans('message.pages.common.app_short_name') }}
                    @endif
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([
                'method' => 'POST',
               // 'class' => 'inline agendaUpdate',
                'url' => [$page_url . '/' . 'agendaStatusUpdate/' . $data->id],
            ]) !!}

            <div class="modal-body">
                @if (!$agendaList->isEmpty())
                    @if ($data->agenda_finalized == 1)
                        <input type="hidden" name="agenda_finalized" value="0">
                        <h5 class="{{ setFont() }}">
                            {{ trans('meeting.meeting.are_you_sure_agenda_finalized') }}
                        </h5>
                    @else
                        <input type="hidden" name="agenda_finalized" value="0">
                        <h5 class="{{ setFont() }}">
                            {{ trans('meeting.meeting.are_you_sure_agenda_finalized') }}
                        </h5>
                    @endif
                @endif
                <div class="row">
                    @if (sizeof($agendaList) > 0)
                        <div class="card-body col-md-12">
                            <h5 class="{{ setFont() }}">
                                {{ getLan() == 'np' ? 'एजेन्डा सूची' : 'Agenda List' }}
                            </h5>
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
                            <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                                <h6 class="text-center {{ setFont() }}">
                                    {{ trans('meeting.meeting_agenda_list.message1') }}
                                </h6>
                                <a class="btn btn-sm btn-info rounded-pill {{ setFont() }}"
                                    href="{{ url('meetingAgendaList/create/' . hashIdGenerate($data->id)) }}">
                                    <i class="fa fa-save"></i>
                                    {{ trans('message.button.update') }}

                                </a>
                            </div>
                        </div>
                        <div class="form-group col-md-3 {{ setFont() }}">
                            <label for="status">
                                {{ trans('message.pages.users_management.send_email') }}
                            </label>
                            <br>
                            <input class="radio-button" type="radio" name="send_email" value="1"
                                style="margin-top: 2px">
                            {{ trans('message.button.yes') }} &nbsp; &nbsp;
                            <input class="radio-button" type="radio" name="send_email" value="0"
                                style="margin-top: 2px" checked>
                            {{ trans('message.button.no') }}
                        </div>
                        <div class="form-group col-md-3 {{ setFont() }}">
                            <label for="status">
                                {{ trans('SMS पठाउनुहोस्') }}
                            </label>
                            <br>
                            <input class="radio-button" type="radio" name="send_sms" value="1"
                                style="margin-top: 2px">
                            {{ trans('message.button.yes') }} &nbsp; &nbsp;
                            <input class="radio-button" type="radio" name="send_sms" value="0"
                                style="margin-top: 2px" checked>
                            {{ trans('message.button.no') }}
                        </div>
                        <div class="form-group col-md-3 {{ setFont() }}">
                            <label for="status">
                                {{ getLan() =='np' ? 'अडियो रेकर्ड  गर्नुहोस् ': trans('Convert Audio') }}
                            </label>
                            <br>
                            <input class="radio-button" type="radio" name="convert_voice" value="1"
                                style="margin-top: 2px">
                            {{ trans('message.button.yes') }} &nbsp; &nbsp;
                            <input class="radio-button" type="radio" name="convert_voice" value="0"
                                style="margin-top: 2px" checked>
                            {{ trans('message.button.no') }}
                        </div>
                        <div class="form-group col-md-3  phoneSmsService {{ setFont() }}">
                            <label for="status">
                                {{ getLan() =='np' ? 'Phone / SMs पठाउनुहोस्  ': trans('Convert Audio') }}
                            </label>
                            <br>
                            <input class="radio-button" type="radio" name="create_campaign" value="1"
                                   style="margin-top: 2px">
                            {{ trans('message.button.yes') }} &nbsp; &nbsp;
                            <input class="radio-button" type="radio" name="create_campaign" value="0"
                                   style="margin-top: 2px" checked>
                            {{ trans('message.button.no') }}
                        </div>
                        <div class="form-group col-md-3 serviceList {{ setFont() }}" style="display: none">
                            <label for="inputName">
                                {{trans('voiceCallManagement.service')}}
                                <span class="text text-danger">
                                *
                            </span>
                            </label>
                            {!!Form::select('services',   tingTingService(),
                                Request::get('services'),
                                ['class'=>'form-control service select2',
                                'style'=>'width: 50%;','placeholder'=>
                                trans('voiceCallManagement.service')])
                            !!}
                        </div>
                    @else
                        <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                            <h5 class="text-center {{ setFont() }}">
                                {{ trans('meeting.meeting_agenda_list.message') }}
                            </h5>
                            <a class="btn btn-primary btn-sm  rounded-pill {{ setFont() }}"
                                href="{{ url('meetingAgendaList/create/' . hashIdGenerate($data->id)) }}">
                                <i class="fa fa-plus-circle"></i>
                                {{ trans('meeting.meeting_agenda_list.add_new') }}

                            </a>
                        </div>
                    @endif

                </div>
            </div>
            <div class="modal-footer justify-content-center {{ setFont() }}">
                @if (!$agendaList->isEmpty())
                    <button type="submit" class="btn btn-primary rounded-pill">
                        <i class="fa fa-check-circle"></i>
                        {{ trans('message.button.yes') }}
                    </button>
                @endif &nbsp; &nbsp;
                <button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal">
                    <i class="fa fa-times-circle"></i>
                    {{ trans('message.button.no') }}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@include('backend.meetingManagement.meeting.agendaDetails.addModal')
