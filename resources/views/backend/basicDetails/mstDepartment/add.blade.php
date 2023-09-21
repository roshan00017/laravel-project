<div class="modal fade" id="addModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.add')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                'id'=>'addForm',
                'url'=>'basicDetails/branchDepartments'])
                !!}
                <div class="row">
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.mst_department.code')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('code',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('message.pages.mst_department.code'),
                        'autocomplete'=>'off',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6 {{setFont()}}" style="display:none;">
                        <label for="inputName">
                            {{trans('message.pages.mst_department.client_id')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('client_id',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('message.pages.mst_department.client_id'),
                        'autocomplete'=>'off',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.mst_department.name_en')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name_en',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('message.pages.mst_department.name_en'),
                        'autocomplete'=>'off',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.mst_department.name_np')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name_np',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('message.pages.mst_department.name_np'),
                        'autocomplete'=>'off',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}" style="display:none;">
                        <label for="inputName">
                            {{trans('message.pages.mst_department.client_ward')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('client_ward',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('message.pages.mst_department.client_ward'),
                        'autocomplete'=>'off',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    @include('backend.components.commonAddStatus')
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.mst_department.description')}}
                        </label>
                        {!! Form::textarea('description',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('message.pages.mst_department.description'),
                        'rows'=>'4',
                        'autocomplete'=>'off',
                        ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>

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