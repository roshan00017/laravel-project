<div class="modal fade"
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
                <div class="row">
                    <div class="col-md-12">

                        {!! Form::model($data,
                               ['method'=>'PUT',
                               'route'=>[$page_route.'.'.'update',$data->id],
                               ])
                        !!}
                        <div class="form-group {{setFont()}}">
                            <label for="inputName">
                                {{trans('message.pages.system_setting.api_setting.app_name')}}
                            </label>
                            {!! Form::text('name',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('message.pages.system_setting.api_setting.app_name'),
                                    'autocomplete'=>'off',
                                    'id'=>'edit_app_name'
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
                                       id="readio1"
                                       name="status"
                                       value="1"
                                       @if($data->status=='1') checked @endif
                                >
                                <label for="readio1">
                                    {{trans('message.button.active')}}
                                </label>
                            </div>
                            &nbsp; &nbsp;
                            <div class="icheck-success d-inline">
                                <input type="radio"
                                       id="readio2"
                                       name="status"
                                       value="0"
                                       @if($data->status=='0') checked @endif
                                >
                                <label for="readio2">
                                    {{trans('message.button.inactive')}}
                                </label>
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
    </div>
</div>
