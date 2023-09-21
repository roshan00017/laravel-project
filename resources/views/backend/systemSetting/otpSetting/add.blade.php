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
                               'id'=>'addOtpForm',
                              'url'=>$page_url
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
