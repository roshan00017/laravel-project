<div class="modal fade"
     id="editModal{{$key}}"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.edit')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true"
                          data-toggle="tooltip"
                          title="Close"
                    >   &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        {!! Form::model($data,
                               ['method'=>'PUT',
                               'route'=>[$page_route.'.'.'update',$key]
                               
                               ])
                        !!}

                     
                        <div class="form-group col-md-12 {{ setFont() }}">
                            <label for="inputName">
                                {{ trans('chat.name') }}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::text('name', @$group->name, [
                                'class' => 'form-control',
                                'placeholder' => trans('chat.group_name'),
                                'required',
                                'autocomplete' => 'off',
                            ]) !!}
                        </div>

                        <div class="form-group col-md-12  {{ setFont() }}">
                            <label for="inputFeedback">
                                {{ trans('chat.group_details') }}
                            </label>
                            {!! Form::textarea('details', @$group->details, [
                                'class' => 'form-control',
                                'placeholder' => trans('meeting.meeting_agenda_list.description'),
                                'rows' => '4',
                                'autocomplete' => 'off',
                            ]) !!}
                            {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
