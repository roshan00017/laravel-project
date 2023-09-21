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
                <div class="row">
                    <div class="col-md-12">

                        {!! Form::open(['method'=>'post',
                                'url'=>$page_url])
                        !!}
                        <div class="form-group {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.system_setting.api_setting.app_name')}}
                            </label>
                            {!! Form::text('name',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('message.pages.system_setting.api_setting.app_name'),
                                    'autocomplete'=>'off',
                                    'id'=>'app_name'
                                    ])
                            !!}
                            {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                        </div>


                        <div class="form-group {{setFont()}}">
                            <label for="status">
                                {{trans('message.commons.status')}}
                            </label>
                            <br>
                            <div class="icheck-success d-inline">
                                <input type="radio"
                                       id="readio3"
                                       name="status"
                                       value="1"
                                       checked
                                >
                                <label for="readio3">
                                    {{trans('message.button.active')}}
                                </label>
                            </div>
                            &nbsp; &nbsp;
                            <div class="icheck-success d-inline">
                                <input type="radio"
                                       id="readio4"
                                       name="status"
                                       value="0">
                                <label for="readio4">
                                    {{trans('message.button.inactive')}}
                                </label>
                            </div>

                        </div>


                        <div class="modal-footer justify-content-center {{setFont()}}">

                            @include('backend.components.buttons.addAction')
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
