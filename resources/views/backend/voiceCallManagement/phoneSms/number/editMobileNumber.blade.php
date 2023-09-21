<div class="modal fade updateModal"
     id="editMobile{{$key}}"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('voiceCallManagement.addMobileNo')}}
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
                {!! Form::model($value,
                             ['method'=>'POST',
                             'class'=>'submitData',
                             'url'=>['updateMobileNumber']
                             ])
                      !!}
                <div class="row">
                    <input type="hidden" name="campaign_id" value="{{$campaignDetails->id}}">
                    <input type="hidden" name="number_id" value="{{$value->id}}">
                    <input type="hidden" name="api_number_id" value="{{$value->api_number_id}}">
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('voiceCallManagement.mobileNo')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('number',Request::get('number'),
                                ['class'=>'form-control mobileNo',
                                'placeholder'=>trans('voiceCallManagement.mobileNo'),
                                'autocomplete'=>'off',
                                 'required'
                                ])
                        !!}
                    </div>


                </div>
                <div class="modal-footer justify-content-center {{setFont()}}">

                    <button type="submit"
                            class="btn btn-success  rounded-pill"
                    >
                        <i class="fa fa-save"></i>
                        {{trans('message.button.update')}}
                    </button>
                    &nbsp;
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
    <!-- /.modal-dialog -->
</div>
