<div class="modal fade" id="editModal{{ $key }}" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.edit') }}
                    <span style="font-size: 14px;"> {{ trans('validation.pages.common.mandatory_field_message') }}
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::model($data, [
                    'method' => 'PUT',
                    'route' => ['meetingAgendaList.update', $data->id],
                    'enctype' => 'multipart/form-data',
                    'autocomplete' => 'off',
                ]) !!}
                <div class="row">


                    <div class="form-group col-md-6  {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('meeting.common.meeting_code') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::select('meeting_id', $meetingList->pluck('code', 'id'), Request::get('meeting_id'), [
                            'class' => 'form-control select2',
                            'required',
                            'style' => 'width: 100%',
                            'placeholder' => trans('meeting.common.select_code'),
                        ]) }}
                    </div>
                    <div class="form-group col-md-12  {{ setFont() }}">
                        <label for="inputFeedback">
                            {{ trans('meeting.meeting_agenda_list.title') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
                        {!! $errors->first('title', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-12  {{ setFont() }}">
                        <label for="inputFeedback">
                            {{ trans('meeting.meeting_agenda_list.description') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::textarea('description', null, [
                            'class' => 'form-control',
                            'rows' => 4,
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <!-- @include('backend.components.commonEditStatus') -->
                </div>

                <div class="modal-footer justify-content-center {{ setFont() }}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>
