<div class="modal fade"
     id="addModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.add')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true"
                          data-toggle="tooltip" title="Close"
                    >   &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                               'id'=>'addForm',
                              'url'=>$page_url
                              ])
                      !!}
                <div class="row">
                   

                <div class="form-group col-md-6  {{setFont()}}">
                            <label for="inputName">
                                {{trans('meeting.common.meeting_code')}}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {{Form::select('meeting_id',
                                        $meetingList->pluck('code','id'),
                                        Request::get('meeting_id'),
                                        ['class'=>'form-control select2',
                                        'required',
                                        'id'=>'meeting_code',
                                        'style'=>'width: 100%',
                                        'placeholder'=> trans('meeting.common.select_code')
                                        ])
                        }}
                        </div>
                        <div class="form-group col-md-6  {{setFont()}}">
                        
                            <select class='form-control select2 selected'
                                    name='agenda_id'
                                    id='agenda_title'
                                    required
                                    style="width: 100%"
                                    disabled
                            >
                                <option class='form control'
                                        value=''

                                >
                                    {{trans('meeting.final_verdict.select_agenda')}}
                                </option>
                            </select>
                        </div>

                        

                    

                    <div class="form-group col-md-6  {{setFont()}}">
                        <label for="inputFeedback">
                            {{trans('meeting.final_verdict.feedback')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::textarea('feedback',Request::get('feedback'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('meeting.final_verdict.provide_feedback'),
                                'rows'=>'2',
                                'autocomplete'=>'off',
                                 'required'
                                ])
                        !!}
                        {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6  {{setFont()}}">
                        <label for="inputName">
                            {{trans('meeting.final_verdict.meeting_member')}}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>
                        <select class='form-control select2 selected'
                                name='member_id'
                                id='meeting_member'
                                required
                                style="width: 100%"
                                disabled
                        >
                            <option class='form control'
                                    value=''

                            >
                                {{trans('meeting.final_verdict.select_member')}}
                            </option>
                        </select>
                    </div>

                  </div>
                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.addAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
                            