<div class="modal fade" id="editModal{{$key}}" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.edit')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::model($data,['method'=>'PUT',
                'route'=>['serviceType.update',$data->id],
                'enctype'=>'multipart/form-data',
                'autocomplete'=>'off'])
                !!}
                <div class="row">


                    <div class="modal-body">
                        {!! Form::open(['method'=>'post',
                        'id'=>'addForm',
                        'url'=>$page_url
                        ])
                        !!}
                        <div class="row">


                            <div class="form-group col-md-6 {{setFont()}}">
                                <label for="inputName">
                                    {{trans('serviceType.serviceType.code')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('code',Request::get('code'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('serviceType.serviceType.code'),
                                'autocomplete'=>'off',
                                'required'
                                ])
                                !!}
                                {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group col-md-6 {{setFont()}}">
                                <label for="inputName">
                                    {{trans('serviceType.serviceType.name_np')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('name_np',
                                Request::get('name_np'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('serviceType.serviceType.name_np'),
                                'autocomplete'=>'off',
                                'required'
                                ])
                                !!}
                                {!! $errors->first('name_np', '<small class="text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group col-md-6 {{setFont()}}">
                                <label for="inputName">
                                    {{trans('serviceType.serviceType.name_en')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('name_en',
                                Request::get('name_en'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('serviceType.serviceType.name_en'),
                                'autocomplete'=>'off',
                                'required'
                                ])
                                !!}
                                {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                            </div>

                            @include('backend.components.commonAddStatus')


                        </div>
                        <div class="modal-footer justify-content-center {{setFont()}}">

                            @include('backend.components.buttons.addAction')
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
        </div>