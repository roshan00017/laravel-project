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
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::model($data,['method'=>'PUT',
                        'route'=>['karyapalikaMembers.update',$data->id],
                        'enctype'=>'multipart/form-data',
                        'autocomplete'=>'off'])
                !!}
                <div class="row">


                <div class="form-group col-md-4  {{setFont()}}">
                        <label for="inputName">
                            {{ trans('message.pages.common.name_np') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name_np',Request::get('name_np'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.common.name_np'),
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    

                    <div class="form-group col-md-4  {{setFont()}}">
                        <label for="inputFeedback">
                        {{ trans('message.pages.common.name_en') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name_en',Request::get('name_en'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('message.pages.common.name_en'),
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4  {{setFont()}}">
                        <label for="inputFeedback">
                        {{ trans('message.pages.common.designation') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('designation',Request::get('designation'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('message.pages.common.designation'),
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('designation', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4  {{setFont()}}">
                        <label for="inputFeedback">
                        {{ trans('message.pages.meeting_member.email') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('email',Request::get('email'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('message.pages.meeting_member.email'),
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('email', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4  {{setFont()}}">
                        <label for="inputFeedback">
                        {{ trans('message.pages.meeting_member.contact_no') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('mobile',Request::get('mobile'),
                                ['class'=>'form-control mobile',   
                                'placeholder'=>trans('message.pages.meeting_member.contact_no'),
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('mobile', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">

                        <label for="image">
                            {{ trans('message.pages.users_management.user_image') }}
                        </label>
                        <input  type="file"
                                class="form-control-file profile-img"
                                accept="image/jpeg, image/png, image/gif"
                                name="image"
                            >
                        {!! $errors->first('image', '<span class="text text-danger">:message</span>') !!}

                        @if($errors->has('image') == null)
                            <span class="text text-danger"
                                  style="font-size: 11px;color: #ff042c"
                            >
                              {{trans('message.pages.users_management.file_upload_message')}}
                            </span>
                        @endif
                    </div>
                    @include('backend.components.commonEditStatus')

                </div>


                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>
