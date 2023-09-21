<div class="modal fade" id="editModal{{$key}}" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.edit')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::model($data,['method'=>'PUT',
                'route'=>['appointmentStatus.update',$data->id],
                'enctype'=>'multipart/form-data',
                'autocomplete'=>'off'])
                !!}
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="inputName" class="{{setFont()}}">
                            {{trans('message.pages.mst_department.code')}}
                        </label>
                        <span class="text text-danger">
                            *
                        </span>
                        {!! Form::text('code',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('message.pages.mst_department.code'),
                        'autocomplete'=>'off',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6  {{setFont()}}">
                        <label for="inputName">
                            {{ trans('appointmentStatus.name_en')}}
                        </label>
                        <span class="text text-danger">
                            *
                        </span>
                        {!!getLan() =='en' ?
                        Form::text('name_en',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('appointmentStatus.name_en'),
                        'autocomplete'=>'off',
                        'required'
                        ]) :
                        Form::text('name_en',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('appointmentStatus.name_en'),
                        'autocomplete'=>'off',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6  {{setFont()}}">
                        <label for="inputName">
                            {{trans('appointmentStatus.name_np')}}
                        </label>
                        <span class="text text-danger">
                            *
                        </span>
                        {!!getLan() =='np' ?
                        Form::text('name_np',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('appointmentStatus.name_np'),
                        'autocomplete'=>'off',
                        'required'
                        ]) :
                        Form::text('name_np',null,
                        ['class'=>'form-control',
                        'placeholder'=>trans('appointmentStatus.name_np'),
                        'autocomplete'=>'off',
                        'required'
                        ])
                        !!}
                        {!! $errors->first('name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    @include('backend.components.commonEditStatus')
                </div>
                <div class="modal-footer justify-content-center {{setFont()}}">
                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>