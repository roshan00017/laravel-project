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
                        aria-label="Close">
                    <span aria-hidden="true"
                          data-toggle="tooltip"
                          title="Close"
                    >   &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        {!! Form::model($data,
                               ['method'=>'PUT',
                               'route'=>[$page_route.'.'.'update',$data->id
                               ]
                               ])
                        !!}

                         <div class="form-group {{setFont()}}">
                            <label for="inputName">
                                {{trans('service.service_data.service_type')}}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                        {{Form::select('service_type_id',
                                    $serviceType->pluck('name','id'),
                                    Request::get('service_type_id '),
                                    ['class'=>'form-control select2 select2-danger',
                                    'required',
                                    
                                    'style'=>'width: 100%',
                                    'placeholder'=> trans('service.service_data.service_type')
                                    ])
                     }}
                        </div> 
                     
                        <div class="form-group {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.common.name_en')}}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::text('name_en',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('message.pages.common.name_en'),
                                    'autocomplete'=>'off',
                                    'required'
                                    ])
                            !!}
                            {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.common.name_np')}}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::text('name_np',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('message.pages.common.name_np'),
                                    'autocomplete'=>'off',
                                    'required'
                                    ])
                            !!}
                            {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                        </div>
                        @include('backend.components.commonAddStatus')
                        

                    </div>
                </div>
                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
