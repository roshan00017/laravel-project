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
                        'route'=>['mstSetting.update',$data->id],
                        'enctype'=>'multipart/form-data',
                        'autocomplete'=>'off'])
                !!}
                <div class="row">

                @if(systemAdmin() == true)
                        <div class="form-group col-md-4 {{setFont()}}">
                            <label for="inputName">
                                {{trans('common.local_body')}}
                                <span class="text text-danger">
                                *
                            </span>
                            </label>
                            {!!Form::select('client_id', appClientList()->pluck('name','id'),
                                Request::get('client_id'),
                                ['class'=>'form-control select2 clientInfo',
                                'style'=>'width: 100%;','placeholder'=>
                                trans('common.select_local_body')])
                            !!}
                        </div>
                    @endif


                <div class="form-group col-md-4  {{setFont()}}">
                        <label for="inputName">
                            {{trans('mstSetting.label_np')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('label_np',Request::get('label_np'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('mstSetting.label_np'),
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('label_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    

                    <div class="form-group col-md-4  {{setFont()}}">
                        <label for="inputFeedback">
                        {{trans('mstSetting.label_en')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('label_en',Request::get('label_en'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('mstSetting.label_en'),
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('label_en', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4  {{setFont()}}">
                        <label for="inputFeedback">
                        {{trans('mstSetting.value')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('value',Request::get('value'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('mstSetting.value'),
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('value', '<small class="text text-danger">:message</small>') !!}
                    </div>
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
