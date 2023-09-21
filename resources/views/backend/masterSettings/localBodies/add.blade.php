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
                    <span aria-hidden="true"
                          data-toggle="tooltip"
                          title="Close"
                    >   &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                               'id'=>'addLocalBodyForm',
                              'url'=>$page_url
                              ])
                      !!}
                <div class="row">
                
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{ trans('localbody.province_code') }}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>
                        {{Form::select('province_code',
                                    $provinceList->pluck('name_en','id'),
                                    Request::get('province_code'),
                                    ['class'=>'form-control select2 select2-danger',
                                    'required',
                                    'id'=>"province_code",
                                     'style'=>'width: 100%',
                                    'placeholder'=> trans('localbody.select_province_name')
                                    ])
                     }}
                    </div>

                    

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{ trans('localbody.district_code') }}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>
                        
                        {{Form::select('district_code',
                                    $districtList->pluck('name_en','code'),
                                    Request::get('district_code'),
                                    ['class'=>'form-control select2 select2-danger',
                                    'required',
                                    'id'=>"district_code",
                                    'style'=>'width: 100%',
                                    'placeholder'=> trans('localbody.select_district_name')
                                    ])
                     }}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputName">
                        {{ trans('localbody.total_ward') }} 
                            <span class="text text-danger">
                                *
                                </span>
                        </label>
                        {!! Form::text('total_ward',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('localbody.total_ward'),
                                'autocomplete'=>'off',
                                'required'
                                ])
                        !!}
                        {!! $errors->first('total_ward', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputName">
                        {{ trans('localbody.select_local_body_name_en') }} 
                            <span class="text text-danger">
                                *
                                </span>
                        </label>
                        {!! Form::text('name_en',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('localbody.name_en'),
                                'autocomplete'=>'off',
                                'required'
                                ])
                        !!}
                        {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputName">
                        {{ trans('localbody.select_local_body_name_np') }}  
                            <span class="text text-danger">
                                *
                                </span>
                        </label>
                        {!! Form::text('name_np',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('localbody.name_np'),
                                'autocomplete'=>'off',
                                'required'
                                ])
                        !!}
                        {!! $errors->first('name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>


                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{ trans('localbody.code') }}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>

                     {!! Form::text('code',null,
                                ['class'=>'form-control',
                                'placeholder'=> trans('localbody.code'),
                                'autocomplete'=>'off',
                                'required'
                                ])
                        !!}
                        {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{ trans('localbody.web_url') }}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>

                     {!! Form::text('web_url',null,
                                ['class'=>'form-control',
                                'placeholder'=> trans('localbody.web_url'),
                                'autocomplete'=>'off',
                                'required'
                                ])
                        !!}
                        {!! $errors->first('web_url', '<small class="text text-danger">:message</small>') !!}
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
