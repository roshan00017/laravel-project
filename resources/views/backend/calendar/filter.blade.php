<div class="modal fade"
     id="filterCalendarModal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
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
            <div class="modal-body" style="text-align: left">

                {!! Form::open(['method'=>'get',
                     'url'=>$page_url,
                     'autocomplete'=>'off'])
                !!}
                <div class="row {{setFont()}}">
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{trans('calendar.year')}}
                            <span class="text text-danger">*</span>
                        </label>
                        {{Form::select('year_code',
                                        $yearList->pluck('code','id'),
                                        Request::get('fy_code'),
                                        ['class'=>'form-control select2',
                                        'style'=>'width: 100%',
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
                                        'placeholder'=> trans('calendar.week_day').' '.trans('calendar.select')
                                        ])
                         }}
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
