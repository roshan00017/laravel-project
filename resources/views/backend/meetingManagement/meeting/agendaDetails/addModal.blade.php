<div class="modal fade" id="addModal{{ $key }}" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.add') }}
                    <span style="font-size: 14px;"> {{ trans('validation.pages.common.mandatory_field_message') }}
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'post', 'url' => 'meetingAgendaList']) !!}
                <div class="row">

                    <input type="hidden" name="meeting_id" value="{{ $data->id }}"
                        class="form-group col-md-12  {{ setFont() }}">
                    <input type="hidden" value="true" name="fromMeeting">
                    <div class="form-group col-md-12  {{ setFont() }}">
                        <label for="inputFeedback">
                            {{ trans('meeting.meeting_agenda_list.title') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('title', Request::get('title'), [
                        'class' => 'form-control',
                        'placeholder' => trans('meeting.meeting_agenda_list.title'),
                        'autocomplete' => 'off',
                        'required',
                        ]) !!}
                        {!! $errors->first('title', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-12  {{ setFont() }}">
                        <label for="inputFeedback">
                            {{ trans('meeting.meeting_agenda_list.description') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::textarea('description', Request::get('description'), [
                        'class' => 'form-control',
                        'placeholder' => trans('meeting.meeting_agenda_list.description'),
                        'rows' => '4',
                        'autocomplete' => 'off',
                        'required',
                        ]) !!}
                        {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                    </div>
                </div>

                <div class="modal-footer justify-content-center {{ setFont() }}">

                    @include('backend.components.buttons.addAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>