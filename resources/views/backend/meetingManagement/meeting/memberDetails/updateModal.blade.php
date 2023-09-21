<div class="modal fade"
     id="editMember{{$key}}"
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
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::model($member,['method'=>'PUT',
                        'route'=>['meetingMembers.update',$member->id],
                        'enctype'=>'multipart/form-data',
                        'autocomplete'=>'off'])
                !!}
                <div class="row">


                    <div class="row {{setFont()}}">


                        <div class="form-group col-md-4">
                            <label for="inputName">
                                {{ trans('message.pages.common.name_en') }}
                                <span class="text text-danger">
                                    *
                                    </span>
                            </label>
                            {!! Form::text('name_en',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('message.pages.common.name_en'),
                                    'autocomplete'=>'off',

                                    ])
                            !!}
                            {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputName">
                                {{ trans('message.pages.common.name_np') }}
                                <span class="text text-danger">
                                    *
                                    </span>
                            </label>
                            {!! Form::text('name_np',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('message.pages.common.name_np'),
                                    'autocomplete'=>'off',

                                    ])
                            !!}
                            {!! $errors->first('name_np', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group col-md-4">
                            <label>
                                {{ trans('message.pages.common.designation') }}
                            </label>

                            <label class="text text-danger">
                                *
                            </label>

                            {!! Form::text('post',null,
                                    ['class'=>'form-control',
                                    'id'=>'login_user_name',
                                    'placeholder'=>trans('message.pages.common.designation'),
                                    'required'
                                    ])
                            !!}
                            {!! $errors->first('post', '<span class="text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group col-md-4">
                            <label>
                                {{ trans('message.pages.meeting_member.contact_no') }}
                            </label>
                            <label class="text text-danger">
                                *
                            </label>

                            {!! Form::text('contact_no',null,
                                    ['class'=>'form-control mobileNo',
                                    'required',
                                    'placeholder'=>trans('message.pages.meeting_member.contact_no'),
                                    ])
                            !!}
                            {!! $errors->first('contact_no', '<span class="text text-danger">:message</span>') !!}
                        </div>

                        <div class="form-group col-md-4">
                            <label>
                                {{ trans('message.pages.meeting_member.email') }}
                            </label>
                            <label class="text text-danger">
                                *
                            </label>

                            {!! Form::text('email',null,
                                    ['class'=>'form-control',
                                    'id'=>'email',
                                    'required',
                                    'placeholder'=>trans('message.pages.meeting_member.email'),
                                    ])
                            !!}
                            {!! $errors->first('email', '<span class="text text-danger">:message</span>') !!}
                        </div>


                        <div class="form-group col-md-12 {{setFont()}}">
                            @php
                                $data = $member;
                            @endphp

                            @include('backend.meetingManagement.meetingMember.is_invite.edit_invite')
                        </div>


                    </div>


                </div>


                <div class="modal-footer justify-content-center {{setFont()}}">

                    <button type="submit"
                            class="btn btn-success  rounded-pill"
                    >
                        <i class="fa fa-check-circle"></i>
                        {{trans('message.button.update')}}
                    </button>
                    &nbsp;      &nbsp;
                    <button type="button"
                            class="btn btn-danger  rounded-pill"
                            data-dismiss="modal"
                    >
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>
