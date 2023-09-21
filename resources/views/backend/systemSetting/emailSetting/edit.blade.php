@php
    $name = setName();
@endphp
<div class="modal fade"
     id="editModal{{$key}}"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.edit')}}
                    <span style="font-size: 14px"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
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
                {!! Form::model($data,
                              ['method'=>'PUT',
                              'route'=>[$page_route.'.'.'update',$data->id]
                              ])
                       !!}

                    <div class="row">
                        @if(systemAdmin() ==true)
                            <div class="form-group col-md-4 {{setFont()}}">
                                <label for="inputName">
                                    {{trans('common.local_body')}}
                                    <span class="text text-danger">
                                *
                            </span>
                                </label>
                                {!!Form::select('client_id',   appClientList()->pluck('name','id'),
                                    Request::get('client_id'),
                                    ['class'=>'form-control select2 clientInfo',
                                    'style'=>'width: 100%;','placeholder'=>
                                    trans('common.select_local_body')])
                                !!}
                            </div>
                        @endif
                        <div class="form-group col-md-4">
                            <label>
                                {{trans('message.pages.system_setting.mail_setting.mail_from_address')}}
                            </label>
                            <label class="text text-danger">
                                *
                            </label>

                            {!! Form::text('mail_from_address',null,
                                        ['class'=>'form-control','required'])
                            !!}
                            {!! $errors->first('mail_from_address', '<span class="text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                {{trans('message.pages.system_setting.mail_setting.mail_driver')}}
                            </label>
                            <label class="text text-danger">
                                *
                            </label>

                            {!! Form::text('mail_driver',null,
                                        ['class'=>'form-control','required'])
                            !!}
                            {!! $errors->first('mail_driver', '<span class="text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                {{trans('message.pages.system_setting.mail_setting.mail_host_name')}}
                            </label>
                            <label class="text text-danger">
                                *
                            </label>

                            {!! Form::text('mail_host_name',null,
                                        ['class'=>'form-control','required'])
                            !!}
                            {!! $errors->first('mail_host_name', '<span class="text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                {{trans('message.pages.system_setting.mail_setting.mail_port_number')}}
                            </label>
                            <label class="text text-danger">
                                *
                            </label>

                            {!! Form::text('mail_port',null,
                                        ['class'=>'form-control','required'])
                            !!}
                            {!! $errors->first('mail_port', '<span class="text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                {{trans('message.pages.system_setting.mail_setting.mail_user_name')}}
                            </label>
                            <label class="text text-danger">
                                *
                            </label>

                            {!! Form::text('mail_user_name',null,
                                        ['class'=>'form-control','required'])
                            !!}
                            {!! $errors->first('mail_user_name', '<span class="text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                {{trans('message.pages.system_setting.mail_setting.mail_password')}}
                            </label>
                            <label class="text text-danger">
                                *
                            </label>

                            <div class="input-group-append">
                                <input type="password"
                                       name="mail_password"
                                       value="{{ $data->mail_password }}"
                                       class="form-control"
                                       id='edit-toggle-password'
                                >
                                <div class="input-group-text">
                                    <i class="fa fa-eye field-icon edit-toggle-password"
                                       toggle="#edit-toggle-password"
                                       data-toggle="tooltip"
                                       title="Show Password">
                                    </i>
                                </div>
                            </div>
                            {!! $errors->first('mail_password', '<span class="text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label>
                                {{trans('message.pages.system_setting.mail_setting.mail_encryption')}}
                            </label>
                            <label class="text text-danger">
                                *
                            </label>

                            {!! Form::text('mail_encryption',null,
                                        ['class'=>'form-control','required'])
                            !!}
                            {!! $errors->first('mail_encryption', '<span class="text text-danger">:message</span>') !!}
                        </div>


                        @include('backend.components.commonEditStatus')
                    </div>
                </div>

                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
