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
                        'route'=>['clientSettings.update',$data->id],
                        'enctype'=>'multipart/form-data',
                        'autocomplete'=>'off'])
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
                        <label for="inputFeedback">
                        {{trans('clientSetting.client_setting')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!!Form::select('setting_code', $masterSettingList->pluck('name','code'),
                                Request::get('setting_code'),
                                ['class'=>'form-control select2 clientInfo', 'required',
                                'style'=>'width: 100%;','placeholder'=>
                                trans('clientSetting.select_client_setting')])
                            !!}
                    </div>

                    <div class="form-group col-md-12  {{setFont()}}">
                        <label for="inputName">
                        {{trans('clientSetting.value')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::textarea('value',Request::get('value'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('clientSetting.enter_value'),
                                'rows'=>2,
                                'required',
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('value', '<small class="text text-danger">:message</small>') !!}
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
