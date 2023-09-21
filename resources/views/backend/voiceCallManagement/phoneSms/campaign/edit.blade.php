<div class="modal fade updateModal"
     id="editModal{{$key}}"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.edit')}}
                    <span style="font-size: 14px"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
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
                {!! Form::model($data,
                              ['method'=>'PUT',
                              'class'=>'submitData',
                              'route'=>[$page_route.'.'.'update',$data->campaign_api_id]
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
                        {!! Form::text('campaign_name',Request::get('campaign_name'),
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
                        {!!Form::select('campaign_service',   tingTingService(),
                            Request::get('campaign_service'),
                            ['class'=>'form-control select2',
                            'style'=>'width: 100%;','placeholder'=>
                            trans('voiceCallManagement.service')])
                        !!}
                    </div>


                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('voiceCallManagement.description')}}
                        </label>
                        {!! Form::textarea('campaign_detail',null,
                                 ['class'=>'form-control',
                                 'placeholder'=>trans('voiceCallManagement.description'),
                                 'rows'=>'4',
                                 'autocomplete'=>'off'
                                 ])
                         !!}
                    </div>

                </div>
            </div>

            <div class="modal-footer justify-content-center {{setFont()}}">

                <button type="submit"
                        class="btn btn-success  rounded-pill"
                >
                    <i class="fa fa-check-circle"></i>
                    {{trans('message.button.update')}}
                </button>
              &nbsp;  &nbsp;
                <button type="button"
                        class="btn btn-danger  rounded-pill"
                        data-dismiss="modal"
                >
                    <i class="fa fa-times-circle"></i>
                    {{trans('message.button.close')}}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- /.modal-content -->
</div>