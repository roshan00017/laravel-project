<div class="modal fade"
     id="editCalendarModal{{$key}}"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div
                    class="modal-header btn-primary rounded-pill"
            >
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
            <div class="modal-body" style="text-align: left">

                {!! Form::model($data,
                                    ['method'=>'PUT',
                                    'route'=>[$page_route.'.'.'update',$data->id
                                    ]
                                    ])
                             !!}
                <div class="row">
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.year')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('fy_code',
                                        $yearList->pluck('name','name'),
                                        Request::get('year_code'),
                                        ['class'=>'form-control select2',
                                        'style'=>'width: 100%',
                                        'required',
                                        'placeholder'=> trans('calendar.year').' '.trans('calendar.select')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.month')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('month_code',
                                        $monthList->pluck('name','code'),
                                        Request::get('month_code'),
                                        ['class'=>'form-control select2',
                                        'style'=>'width: 100%',
                                        'required',
                                        'placeholder'=> trans('calendar.month').' '.trans('calendar.select')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.week_day')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('week_day_code',
                                        $weekDayList->pluck('name','code'),
                                        Request::get('week_day_code'),
                                        ['class'=>'form-control',
                                        'style'=>'width: 100%',
                                        'required',
                                        'placeholder'=> trans('calendar.week_day').' '.trans('calendar.select')
                                        ])
                         }}
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.day')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {!! Form::number('day',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('calendar.day'),
                                'autocomplete'=>'off',
                                'min'=>1,
                                'required'
                                ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>

                </div>

                <div class="col-md-12 modal-footer justify-content-center {{setFont()}}">
                    @include('backend.components.buttons.addAction')
                </div>

            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
