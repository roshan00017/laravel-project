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
            @php
           
            if(@$page_url == 'dcRegisterBook' || @$page_url == 'dcDispatchBook'  )
            {
                $page_url = @$office_crreate_page_url;
            }else{
            $page_url = @$page_url;
            }
            
            @endphp
            
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
                            
                        </label>
                        {!! Form::text('contact_person',
                                Request::get('contact_person'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('office.contact_person'),
                                'autocomplete'=>'off',
                                
                                ])
                        !!}
                        {!! $errors->first('contact_person', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                        {{trans('office.contact_number')}}
                           
                        </label>
                        {!! Form::text('contact_no',
                                Request::get('contact_no'),
                                ['class'=>'form-control',
                                 'id'=>'contact_no',
                                'placeholder'=>trans('office.contact_number'),
                                'autocomplete'=>'off',
                            
                                ])
                        !!}
                        {!! $errors->first('contact_no', '<small class="text text-danger">:message</small>') !!}
                    </div>

                

                    {{-- <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('office.remarks')}}
                          
                        </label>
                        {!! Form::textarea('remarks',
                                Request::get('remarks'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('office.remarks'),
                                'rows '=>'4',
                                'autocomplete'=>'off',
                               
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

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
                            