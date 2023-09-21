<div class="modal fade"
     id="addModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl">
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
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            {!! Form::open(['method'=>'post',
                                'id'=>'addForm',
                                'url'=>$page_url])
                        !!}

                <div class="row {{setFont()}}">

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                        {{trans('service_related_document.common.service_type')}}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>
                        {{Form::select('service_type_id',
                                    $serviceType->pluck('name','id'),
                                    Request::get('service_type_id '),
                                    ['class'=>'form-control select2',
                                    'style'=>'width: 100%',
                                    'placeholder'=> trans('service_related_document.common.service_type')
                                    ])
                     }}
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                        {{trans('service_related_document.common.service')}}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>
                        {{Form::select('service_id',
                                    $services->pluck('name','id'),
                                    Request::get('service_id '),
                                    ['class'=>'form-control select2',
                                    
                                    'id'=>'service-dropdown',
                                    'style'=>'width: 100%',
                                    'placeholder'=> trans('service_related_document.common.service')
                                    ])
                     }}
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{ trans('service_related_document.common.service_rate') }}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>
                        {!! Form::text('service_rate',null,
                                ['class'=>'form-control',
                                'required',
                                'id'=>'service_rate',
                                ])
                        !!}
                    </div>


                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('service_related_document.common.details_en') }} 
                            <span class="text text-danger">
                                *
                                </span>
                        </label>
                        {!! Form::textarea('document_detail_en',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('service_related_document.common.details_en'),
                                'autocomplete'=>'off',
                                'rows'=>2,
                                
                                ])
                        !!}
                        {!! $errors->first('document_detail_en', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('service_related_document.common.details_np') }} 
                            <span class="text text-danger">
                                *
                                </span>
                        </label>
                        {!! Form::textarea('document_detail_np',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('service_related_document.common.details_np'),
                                'autocomplete'=>'off',
                                'rows'=>2,
                                'required'
                                ])
                        !!}
                        {!! $errors->first('document_detail_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label>
                            {{ trans('service_related_document.common.service_time') }}
                        </label>

                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('service_time',null,
                                ['class'=>'form-control',
                                'id'=>'service_time',
                                'placeholder'=>trans('service_related_document.common.service_time'),
                                'required'
                                ])
                        !!}
                        {!! $errors->first('service_time', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                        {{trans('service_related_document.common.department')}}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>
                        {{Form::select('department_id',
                                    $department->pluck('name','id'),
                                    Request::get('department_id '),
                                    ['class'=>'form-control select2 select2-danger',
                                  
                                    
                                    'style'=>'width: 100%',
                                    'placeholder'=> trans('service_related_document.common.department')
                                    ])
                     }}
                    </div>

                   

                    

                </div>


                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.addAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
