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
                          data-toggle="tooltip"
                          title="Close"
                    >   &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                                'enctype'=>'multipart/form-data',
                                'url'=>$page_url
                              ])
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
                        <input type="file"
                               class="form-control-file profile-img"
                               accept=".jpg, .jpeg, .png, .JPG, .JPEG, .PNG"
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

                    @include('backend.components.commonAddStatus')

                    

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
                            