<div class="modal fade"
     id="editHolidayModal{{$key}}"
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
                    <span aria-hidden="true"
                          data-toggle="tooltip"
                          title="Close"
                    >   &times;
                    </span>
                </button>
            </div>
            {!! Form::model($data,
                                   ['method'=>'PUT',
                                   'route'=>[$page_route.'.'.'update',$data->id]
                                   ])
                            !!}
            <div class="modal-body" style="text-align: left">

                <div class="row">

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.name_np')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::text('name_np',
                                        $data->name_np,
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
                                        $data->name_en,
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
                                  $data->date_np,
                                  ['class'=>'form-control nepaliDatePicker date_np_edit',
                                  'autocomplete'=>'off',
                                  'required',
                                  'width'=>'100%','placeholder'=> trans('calendar.holiday_date')])
                          !!}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.holiday_type')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('holiday_type',
                                        $holidayTypes,
                                        $data->holiday_type,
                                        ['class'=>'form-control select2',
                                        'style'=>'width: 100%',
                                        'onChange'=>'displayGovBody('.$key.')',
                                        'id'=>'holidayTypeId'.$key,
                                        'required',
                                        'placeholder'=> trans('calendar.holiday_type').' '.trans('calendar.select')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}" id="province_only{{$key}}"
                        @if($data->holiday_type=='province_only') style="display: block" @else style="display: none" @endif
                    >
                        <label for="inputName">
                            {{trans('calendar.province')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('province_code[]',
                                        $provinceList->pluck('name','code'),
                                        $holidayDays,
                                        ['class'=>'form-control select2',
                                        'style'=>'width: 100%',
                                        'multiple',
                                        'placeholder'=> trans('calendar.province').' '.trans('calendar.select')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}" id="district_only{{$key}}"
                        @if($data->holiday_type=='district_only') style="display: block" @else style="display: none" @endif
                    >
                        <label for="inputName">
                            {{trans('calendar.district')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('district_code[]',
                                        $districtList->pluck('name','code'),
                                        $holidayDays,
                                        ['class'=>'form-control select2',
                                        'style'=>'width: 100%',
                                        'multiple',
                                        'placeholder'=> trans('calendar.district').' '.trans('calendar.select')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}" id="local_body_only{{$key}}"
                        @if($data->holiday_type=='local_body_only') style="display: block" @else style="display: none" @endif
                    >
                        <label for="inputName">
                            {{trans('calendar.local_body')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('local_body_code[]',
                                        $localBodyList->pluck('name','code'),
                                        $holidayDays,
                                        ['class'=>'form-control select2',
                                        'style'=>'width: 100%',
                                        'multiple',
                                        'placeholder'=> trans('calendar.local_body').' '.trans('calendar.select')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label>
                            {{ trans('message.commons.status') }}
                        </label>
                        <br>
                        <input class="radio-button"
                               type="radio"
                               name="status"
                               @if($data->status == true) checked @endif
                               value="1"
                               style="margin-top: 2px"
                        >
                        {{ trans('message.button.active') }}
                        &nbsp; &nbsp;
                        <input class="radio-button"
                               type="radio"
                               name="status"
                               @if($data->status == false) checked @endif
                               value="0"
                               style="margin-top: 2px"
                        >
                        {{ trans('message.button.inactive') }}
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

                <div class="col-md-12 modal-footer justify-content-center {{setFont()}}">
                    @include('backend.components.buttons.updateAction')
                </div>

            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
