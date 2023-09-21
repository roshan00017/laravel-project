@php
    $name = setName();
@endphp
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
                        <div class="form-group col-md-6 {{setFont()}}">

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
                    <div class="form-group col-md-6  {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.system_setting.otp_setting.otp_limit')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::number('otp_limit',Request::get('otp_limit'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.system_setting.otp_setting.otp_limit'),
                                'autocomplete'=>'off',
                                 'min'=>1,
                                 'required'
                                ])
                        !!}
                        {!! $errors->first('otp_limit', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6  {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.system_setting.otp_setting.otp_duration')}}
                            <span class="text text-danger">
                                *
                            </span>

                        </label>
                        {!! Form::number('otp_duration',Request::get('otp_duration'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.system_setting.otp_setting.otp_duration'),
                                'autocomplete'=>'off',
                                'min'=>1,
                                'required'
                                ])
                        !!}
                        {!! $errors->first('otp_limit', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    @include('backend.components.commonEditStatus')
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
