<div class="modal fade updateModal"
     id="editModal{{$key}}"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.edit')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
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
                {!! Form::model($data,['method'=>'PUT',
                'class'=>'submitData',
                'url'=>['callRoutingNumberManagement',$data->id],
                'autocomplete'=>'off'])
                 !!}
                <div class="row">
                    <input type="hidden" name="type" value="{{$data->type}}">

                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('callRouting.number')}}
                            <span class="text text-danger">
                                *
                                </span>
                        </label>
                        {!! Form::text('number',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('callRouting.number'),
                                'autocomplete'=>'off',
                                'required'
                                ])
                        !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>




                </div>

                <div class="modal-footer justify-content-center {{setFont()}}">

                    <button type="submit"
                            class="btn btn-success  rounded-pill"
                    >
                        <i class="fa fa-check-circle"></i>
                        {{trans('message.button.update')}}
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
