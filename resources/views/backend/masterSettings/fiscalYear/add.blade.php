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
                'url'=>'/fiscalYears'])
                !!}
                <div class="row">
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.fiscal_year.code')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('code',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('message.pages.fiscal_year.code'),
                        'autocomplete'=>'off',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.fiscal_year.date_from_bs')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('date_from_bs',null,
                        ['class'=>'form-control nepaliDatePicker',
                        'placeholder'=>trans('message.pages.fiscal_year.date_from_bs'),
                        'autocomplete'=>'off',
                        'id'=>'date_from_bs',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('date_from_bs', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.fiscal_year.date_from_ad')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('date_from_ad',null,
                        ['class'=>'form-control englishDatePicker',
                        'placeholder'=>trans('message.pages.fiscal_year.date_from_ad'),
                        'autocomplete'=>'off',
                        'id'=>'date_from_ad',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('date_from_ad', '<small class="text text-danger">:message</small>') !!}
                    </div>


                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.fiscal_year.date_to_bs')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('date_to_bs',null,
                        ['class'=>'form-control nepaliDatePicker ',
                        'placeholder'=>trans('message.pages.fiscal_year.date_to_bs'),
                        'autocomplete'=>'off',
                        'required',
                        'id'=>'date_to_bs',
                        ])
                        !!}
                        {!! $errors->first('date_to_bs', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.fiscal_year.date_to_ad')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('date_to_ad',null,
                        ['class'=>'form-control englishDatePicker',
                        'placeholder'=>trans('message.pages.fiscal_year.date_to_ad'),
                        'autocomplete'=>'off',
                        'required',
                        'id'=>'date_to_ad'
                        ])
                        !!}
                        {!! $errors->first('date_to_ad', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    @include('backend.components.commonAddStatus')
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.fiscal_year.description')}}
                        </label>
                        {!! Form::textarea('description',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('message.pages.fiscal_year.description'),
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