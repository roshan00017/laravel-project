<div class="modal fade"
     id="addModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog">
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
                               'class'=>'submitData',
                               'enctype' => 'multipart/form-data',
                              'url'=>$page_url
                              ])
                      !!}
                <div class="row">


                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('voiceCallManagement.title')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name',Request::get('name'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('voiceCallManagement.title'),
                                'autocomplete'=>'off',
                                 'required'
                                ])
                        !!}
                    </div>
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('voiceCallManagement.service')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!!Form::select('services',   tingTingService(),
                            Request::get('services'),
                            ['class'=>'form-control select2',
                            'style'=>'width: 100%;','placeholder'=>
                            trans('voiceCallManagement.service')])
                        !!}
                    </div>

                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('voiceCallManagement.sendMedium')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!!Form::select('send_medium',   tingTingSendMedium(),
                            Request::get('send_medium'),
                            ['class'=>'form-control select2 sendMedium',
                            'style'=>'width: 100%;','placeholder'=>
                            trans('voiceCallManagement.sendMedium')])
                        !!}
                    </div>

                    <div class="form-group col-md-12 individualNumberBlock {{setFont()}}" style="display: none">
                        <label for="inputName">
                            {{trans('voiceCallManagement.add_individual_number')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('individual_number',Request::get('individual_number'),
                                ['class'=>'form-control mobileNo',
                                'placeholder'=>trans('voiceCallManagement.add_individual_number'),
                                'autocomplete'=>'off',
                                ])
                        !!}
                    </div>

                    <div class="form-group col-md-12 bulkNumberBlock {{setFont()}}" style="display: none">
                        <label for="inputName">
                            {{trans('voiceCallManagement.import_bulk_numbers')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        <input type="file" class="form-control"
                               accept=".xlsx" name="send_to_number_file">
                        <br>
                        <a href="{{asset('design/sample_number.xlsx')}}"
                           class="text fa-pull-left text-primary {{setFont()}}"
                           data-placement="top" title="{{trans('exam.excel_template')}}{{trans('message.pages.common.viewFile')}}"
                        >
                            Format : sample_number.xlsx
                        </a>
                    </div>

                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('voiceCallManagement.description')}}
                        </label>
                        {!! Form::textarea('description',null,
                                 ['class'=>'form-control',
                                 'placeholder'=>trans('voiceCallManagement.description'),
                                 'rows'=>'4',
                                 'autocomplete'=>'off'
                                 ])
                         !!}
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
