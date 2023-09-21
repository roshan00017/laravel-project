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
                         'id'=>'addForm',
                        'url'=>'roleManagement/roles'])
                !!}
                <div class="row">
                    @if(systemAdmin() == true)
                        <div class="form-group col-md-12 {{setFont()}}">

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
                </div>
                @endif
                <div class="row">


                    <div class="form-group col-md-6 {{setFont()}}">
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

                    <div class="form-group col-md-6 {{setFont()}}">
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

                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputDescription">
                            {{trans('message.pages.roles.details')}}
                        </label>
                        {!! Form::textarea('details',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.roles.enter_role_description'),
                                'rows'=>'4',
                                'autocomplete'=>'off'
                                ])
                        !!}
                        {!! $errors->first('details', '<span class="label label-danger">:message</span>') !!}
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
