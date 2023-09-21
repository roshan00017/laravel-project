<div class="modal fade"
     id="searchModal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-m">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill {{setFont()}}">
                <h4 class="modal-title">
                    <i class="fa fa-filter"></i>
                    {{trans('message.button.filter')}}
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

                {!! Form::open(['method'=>'get',
                     'url'=>$page_url,
                     'autocomplete'=>'off'])
                !!}

                    
                <div class="row {{setFont()}}">

                    <div class="form-group col-md-6  {{setFont()}}">
                        {!! Form::text('name_np',Request::get('name_np'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('meeting.meeting.name_np'),
                                'autocomplete'=>'off',
                                 
                                ])
                        !!}
                        {!! $errors->first('title', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6  {{setFont()}}">
                        {!! Form::text('name_en',Request::get('name_en'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('meeting.meeting.name_en'),
                                'autocomplete'=>'off',
                                  
                                ])
                        !!}
                       {!! $errors->first('title', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6  {{setFont()}}">
                        {!! Form::text('contact_no',Request::get('contact_no'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('message.pages.common.contact_number'),
                                'autocomplete'=>'off',
                                  
                                ])
                        !!}
                       {!! $errors->first('title', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6  {{setFont()}}">
                        {!! Form::text('email',Request::get('email'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('message.pages.common.contact_email'),
                                'autocomplete'=>'off',
                                  
                                ])
                        !!}
                       {!! $errors->first('title', '<small class="text text-danger">:message</small>') !!}
                    </div>


                </div>


                <div class="modal-footer justify-content-center {{setFont()}}">
                    @include('backend.components.buttons.filterAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
