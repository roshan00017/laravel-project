<div class="modal fade" id="statusUpdateModal{{ $key }}" aria-hidden="true" data-keyboard="false"
    data-backdrop="static">
    <div class="modal-dialog   modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    @if (systemSetting())
                        {{ getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
                    @else
                        {{ trans('message.pages.common.app_short_name') }}
                    @endif
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($data, ['method' => 'POST', 'url' => [$page_url . '/' . 'meetingStatusUpdate/' . $data->id]]) !!}
                <div class="row">

                    <div class="form-group col-md-12 {{ setFont() }}">

                        <label for="inputName">
                            {{ trans('meeting.meeting.meeting_status') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::select(
                            'meeting_status_id',
                            $meetingUpdateStatusList->pluck('name', 'id'),
                            Request::get('meeting_status_id'),
                            [
                                'class' => 'form-control select2 statusUpdate',
                                'style' => 'width: 100%',
                                'required',
                                'placeholder' => trans('meeting.meeting.select_status'),
                            ],
                        ) }}
                    </div>
                    <div class="form-group col-md-6 nepaliDate {{ setFont() }}" style="display: none">
                        <label for="inputName">
                            {{ trans('meeting.meeting.status_date_bs') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('status_date_bs', null, [
                            'class' => 'form-control nepaliDatePicker',
                            'placeholder' => trans('meeting.meeting.status_date_bs'),
                            'autocomplete' => 'off',
                            'id' => 'date_bs',
                        ]) !!}
                    </div>

                    <div class="form-group col-md-6 englishDate {{ setFont() }}" style="display: none">
                        <label for="inputName">
                            {{ trans('meeting.meeting.status_date_ad') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('status_date_ad', null, [
                            'class' => 'form-control englishDatePicker',
                            'placeholder' => trans('meeting.meeting.status_date_ad'),
                            'autocomplete' => 'off',
                            'id' => 'date_ad',
                        ]) !!}
                    </div>

                    <div class="form-group col-md-12 reasonBlock {{ setFont() }}" style="display: none"
                        id="reasonBlock">
                        <label for="inputDescription">
                            {{ trans('meeting.status.reason') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>


                        {!! Form::textarea('remarks', null, [
                            'class' => 'form-control',
                            'rows' => '4',
                            'id' => 'remark',
                            'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('details', '<span class="label label-danger">:message</span>') !!}
                    </div>

                </div>

                <div class="modal-footer justify-content-center {{ setFont() }}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
