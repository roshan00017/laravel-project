<div class="modal fade"
     id="editModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.edit')}}
                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                                                    <span aria-hidden="true"
                                                          data-toggle="tooltip"
                                                          title="Close"
                                                    >
                                                        &times;
                                                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::model($result,['method'=>'PUT',
                                'route'=>[$page_route.'.'.'update',$result['id']],
                                'enctype'=>'multipart/form-data',
                                'autocomplete'=>'off'])
                        !!}
                        <div class="form-group {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.system_setting.app_setting.app_name')}} [English )
                            </label>

                            {!! Form::text('app_name',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>'Enter App    Name',
                                    'autocomplete'=>'off'])
                            !!}
                            {!! $errors->first('app_name', '<small class="text text-danger">:message</small>') !!}
                        </div>
                        <div class="form-group {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.system_setting.app_setting.app_name')}} [ Nepali ]
                            </label>

                            {!! Form::text('app_name_np',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>'Enter App    Name',
                                    'autocomplete'=>'off'])
                            !!}
                            {!! $errors->first('app_name', '<small class="text text-danger">:message</small>') !!}
                        </div>
                        <div class="form-group {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.system_setting.app_setting.app_short_name')}} [ Nepali ]
                            </label>

                            {!! Form::text('app_short_name_np',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>'Enter App    Name',
                                    'autocomplete'=>'off'])
                            !!}
                            {!! $errors->first('app_short_name_np', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.system_setting.app_setting.app_short_name')}} [ English ]
                            </label>

                            {!! Form::text('app_short_name',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>'Enter App    Name',
                                    'autocomplete'=>'off'])
                            !!}
                            {!! $errors->first('app_short_name', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group {{setFont()}}">
                            <label for="image">
                                {{trans('message.pages.system_setting.app_setting.app_logo')}}
                            </label>
                            <input type="file"
                                   class="form-control-file"
                                   name="app_logo"
                            >
                            {!! $errors->first('app_logo', '<span class="text text-danger">:message</span>') !!}

                            @if($errors->has('app_logo') == null)
                                <span class="text text-danger"
                                      style="font-size: 12px;color: #ff042c"
                                >
                                                                     {{trans('message.pages.users_management.file_upload_message')}}
                                                                </span>
                            @endif
                        </div>
                        <div class="modal-footer justify-content-center {{setFont()}}">

                            @include('backend.components.buttons.updateAction')
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>