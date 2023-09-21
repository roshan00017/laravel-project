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
                        'route'=>['complaintRelatedDepartment.update',$data->id],
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
                                    {{trans('message.pages.common.code')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('code',Request::get('code'),
                                        ['class'=>'form-control',
                                        'placeholder'=>trans('message.pages.common.code'),
                                        'autocomplete'=>'off',
                                         'required'
                                        ])
                                !!}
                                {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                            </div>
                        
        
                            <div class="form-group col-md-6 {{setFont()}}">
                                <label for="inputName">
                                    {{trans('message.pages.common.name_en')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('name',
                                        Request::get('name'),
                                        ['class'=>'form-control',   
                                        'placeholder'=>trans('message.pages.common.name_en'),
                                        'autocomplete'=>'off',
                                         'required'
                                        ])
                                !!}
                                {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                            </div>
        
                            <div class="form-group col-md-6 {{setFont()}}">
                                <label for="inputName">
                                    {{trans('message.pages.common.name_np')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('name_ne',
                                        Request::get('name_ne'),
                                        ['class'=>'form-control',   
                                        'placeholder'=>trans('message.pages.common.name_np'),
                                        'autocomplete'=>'off',
                                         'required'
                                        ])
                                !!}
                                {!! $errors->first('name_np', '<small class="text text-danger">:message</small>') !!}
                            </div>
        
                            <div class="form-group col-md-6 {{setFont()}}">
                                <label for="inputName">
                                {{trans('office.address')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('address',
                                        Request::get('address'),
                                        ['class'=>'form-control',   
                                        'placeholder'=>trans('office.address'),
                                        'autocomplete'=>'off',
                                         'required'
                                        ])
                                !!}
                                {!! $errors->first('address', '<small class="text text-danger">:message</small>') !!}
                            </div>
        
                            <div class="form-group col-md-6 {{setFont()}}">
                                <label for="inputName">
                                {{trans('office.contact_person')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('contact_person',
                                        Request::get('contact_person'),
                                        ['class'=>'form-control',   
                                        'placeholder'=>trans('office.contact_person'),
                                        'autocomplete'=>'off',
                                         'required'
                                        ])
                                !!}
                                {!! $errors->first('contact_person', '<small class="text text-danger">:message</small>') !!}
                            </div>
        
                            <div class="form-group col-md-6 {{setFont()}}">
                                <label for="inputName">
                                {{trans('office.contact_number')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('contact_no',
                                        Request::get('contact_no'),
                                        ['class'=>'form-control',   
                                        'placeholder'=>trans('office.contact_number'),
                                        'autocomplete'=>'off',
                                        'id'=>'contact_no',
                                         'required'
                                        ])
                                !!}
                                {!! $errors->first('contact_no', '<small class="text text-danger">:message</small>') !!}
                            </div>
        
                        
        
                            {{-- <div class="form-group col-md-12 {{setFont()}}">
                                <label for="inputName">
                                    {{trans('office.remarks')}}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::textarea('remarks',
                                        Request::get('remarks'),
                                        ['class'=>'form-control',   
                                        'placeholder'=>trans('office.remarks'),
                                        'rows '=>'4',
                                        'autocomplete'=>'off',
                                         'required'
                                        ])
                                !!}
                                {!! $errors->first('remarks', '<small class="text text-danger">:message</small>') !!}
                            </div> --}}
        
                            
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
