<div class="modal fade"
     id="addHolidayModal"
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
            <div class="modal-body" style="text-align: left">

                {!! Form::open(['method'=>'post',
                        'id'=>'addForm',
                        'url'=>$page_url])
                !!}
                <div class="row">

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.name_np')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::text('name_np',
                                        Request::get('name_np'),
                                        ['class'=>'form-control',
                                        'required',
                                        'placeholder'=> trans('calendar.name_np')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.name_en')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::text('name_en',
                                        Request::get('name_en'),
                                        ['class'=>'form-control',
                                        'required',
                                        'placeholder'=> trans('calendar.name_en')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.holiday_date')}}
                            <span class="text text-danger">
                            *
                            </span>
                        </label>
                        {!!Form::text('date_np',
                                  Request::get('date_np'),
                                  ['class'=>'form-control holiday',
                                  'id' => 'date_from_bs',
                                  'autocomplete'=>'off',
                                  'required',
                                  'width'=>'100%','placeholder'=> trans('calendar.holiday_date')])
                          !!}
                    </div>
                    @if(systemAdmin() == true)
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.holiday_type')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('holiday_type',
                                        $holidayTypes,
                                        Request::get('holiday_type'),
                                        [
                                        'class'=>'form-control select2',
                                        'style'=>'width: 100%',
                                        'id'=>'holidayTypeId',
                                        'required',
                                        'placeholder'=> trans('calendar.holiday_type').' '.trans('calendar.select')
                                        ])
                         }}
                    </div>
                    @endif

                    <div class="form-group col-md-6 {{setFont()}}" id="province_only" style="display: none">
                        <label for="inputName">
                            {{trans('calendar.province')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('province_code[]',
                            $provinceList->pluck('name','id'),
                            Request::get('province_code'),
                            ['class'=>'form-control select2',
                            'style'=>'width: 100%',
                            'multiple',
                            'placeholder'=> trans('calendar.province').' '.trans('calendar.select')
                            ])
                        }}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}" id="district_only" style="display: none">
                        <label for="inputName">
                            {{trans('calendar.district')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('district_code[]',
                                        $districtList->pluck('name','id'),
                                        Request::get('district_code'),
                                        ['class'=>'form-control select2',
                                        'style'=>'width: 100%',
                                        'required',
                                        'multiple',
                                        'placeholder'=> trans('calendar.district').' '.trans('calendar.select')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}" id="valley_only" style="display: none">
                        <label for="inputName">
                            {{trans('calendar.valley')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('valley_code[]',
                            $valleyDistrictList->pluck('name','id'),
                            Request::get('valley_code'),
                            ['class'=>'form-control select2',
                            'style'=>'width: 100%',
                            'multiple',
                            'placeholder'=> trans('calendar.valley').' '.trans('calendar.select')
                            ])
                        }}
                    </div>


                    <div class="form-group col-md-6 {{setFont()}}" id="local_body_only" style="display: none">
                        <label for="inputName">
                            {{trans('calendar.local_body')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('local_body_code[]',
                            $localBodyList->pluck('name','id'),
                            Request::get('local_body_code'),
                            ['class'=>'form-control select2',
                            'style'=>'width: 100%',
                            'required',
                            'multiple',
                            'placeholder'=> trans('calendar.local_body').' '.trans('calendar.select')
                            ])
                        }}
                    </div>


                    

                    <div class="form-group col-md-6 {{ setFont() }}">
                        {{ Form::label('status', trans('calendar.is_publish')) }}
                        <br>
                        <div class="form-inline">
                            <div class="radio">
                                <label>
                                    {{ Form::radio('status', '1', false, ['class' => 'radio-button', 'style' => 'margin-top: 2px']) }}
                                    &nbsp;
                                    {{ trans('message.button.yes') }}
                                </label>
                            </div>
                            <div class="radio ml-3">
                                <label>
                                    {{ Form::radio('status', '0', true, ['class' => 'radio-button', 'style' => 'margin-top: 2px']) }}
                                    &nbsp;
                                    {{ trans('message.button.no') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.description')}}
                        </label>
                        {{Form::textarea('description',
                                        Request::get('description'),
                                            ['class'=>'form-control',
                                        'rows'=>2,
                                        'placeholder'=> trans('calendar.description')
                                        ])
                         }}
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12 modal-footer justify-content-center {{setFont()}}">
                        {{-- @include('backend.components.buttons.addAction') --}}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

  





