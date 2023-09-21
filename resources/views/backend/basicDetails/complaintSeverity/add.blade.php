<div class="modal fade"
     id="addModal"
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
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                               'id'=>'addForm',
                              'url'=>$page_url
                              ])
                      !!}
                <div class="row">
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.common.code')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('code',Request::get('code'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.common.code'),
                                'autocomplete'=>'off',
                                 'required'
                                ])
                        !!}
                        {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.common.name_en')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name',
                                Request::get('name'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.common.name_en'),
                                'autocomplete'=>'off',
                                 'required'
                                ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('message.pages.common.name_np')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name_ne',
                                Request::get('name_ne'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.common.name_np'),
                                'autocomplete'=>'off',
                                 'required'
                                ])
                        !!}
                        {!! $errors->first('name_ne', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{trans('severityType.severityType.depth')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('depth',
                                Request::get('depth'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('severityType.severityType.depth'),
                                'autocomplete'=>'off',
                                 'required'
                                ])
                        !!}
                        {!! $errors->first('depth', '<small class="text text-danger">:message</small>') !!}
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