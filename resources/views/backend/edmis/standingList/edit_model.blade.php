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
                    <div class="col-md-12">

                        {!! Form::model($data,
                            ['method'=>'PUT',
                            'route'=>[$page_route.'.'.'update',$data->id
                            ]
                            ])
                     !!}

                    <div class="row">

                         
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.common.date')}}
                                <span class="text text-danger">*</span>
                            </label>
                            {!! Form::text('date_np', null, [
                                'class' => 'form-control nepaliDatePicker',
                                'placeholder' => trans('message.pages.common.date'),
                                'autocomplete' => 'off',
                                'id' => 'date_from_bs',
                                'required'
                            ]) !!}
                            {!! $errors->first('date_np', '<small class="text text-danger">:message</small>') !!}
                        </div>
    
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.common.type')}}
                                <span class="text text-danger">*</span>
                            </label>
                            {{ Form::select('type',
                                $standingtypelists,
                                Request::get('type'),
                                [
                                    'class' => 'form-control select2',
                                    'style' => 'width: 100%',
                                    'placeholder' => trans('message.pages.common.type'),
                                    'required' => 'required',
                                ])
                            }}
                            @if ($errors->has('type'))
                                <small class="text text-danger">{{ $errors->first('type') }}</small>
                            @endif
                        </div>
    
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.common.organization')}}
                                <span class="text text-danger">*</span>
                            </label>
                            {{ Form::select('organization',
                                $organizations,
                                Request::get('organization'),
                                [
                                    'class' => 'form-control select2',
                                    'style' => 'width: 100%',
                                    'placeholder' => trans('message.pages.common.organization'),
                                    'required' => 'required',
                                ])
                            }}
                            @if ($errors->has('organization'))
                                <small class="text text-danger">{{ $errors->first('organization') }}</small>
                            @endif
                        </div>
    
    
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.common.regd_no')}}
                                <span class="text text-danger">*</span>
                            </label>
                            {!! Form::number('regd_no', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('message.pages.common.regd_no'),
                                'autocomplete' => 'off',
                                'required'
                            ]) !!}
                            {!! $errors->first('regd_no', '<small class="text text-danger">:message</small>') !!}
                        </div>
    
                        <div class="form-group col-md-12 {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.common.description')}}
                                <span class="text text-danger">*</span>
                            </label>
                            {!! Form::textarea('description', null, [
                                'class' => 'form-control',
                                'style' => 'height: 100px',
                                'placeholder' => trans('message.pages.common.description'),
                                'autocomplete' => 'off',
                                'required',
                            ]) !!}
                            {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
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
