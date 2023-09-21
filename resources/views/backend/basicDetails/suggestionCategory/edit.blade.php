@php
    $name = setName();
@endphp
<div class="modal fade" id="editModal{{ $key }}" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.edit') }}
                    <span style="font-size: 14px"> {{ trans('validation.pages.common.mandatory_field_message') }} </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($data, ['method' => 'PUT', 'route' => [$page_route . '.' . 'update', $data->id]]) !!}
                <div class="row">

                    <div class="form-group col-md-6">
                        <label class="{{setFont()}}">
                            {{ trans('message.pages.common.name_en') }}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                        {!! $errors->first('name', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label class="{{setFont()}}">
                            {{ trans('message.pages.common.name_np') }}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('name_ne', null, ['class' => 'form-control', 'required']) !!}
                        {!! $errors->first('name_ne', '<span class="text text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label class="{{setFont()}}">
                            {{ trans('message.pages.mst_document_type.code') }}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('code', null, ['class' => 'form-control', 'required']) !!}
                        {!! $errors->first('code', '<span class="text text-danger">:message</span>') !!}
                    </div>

                    @include('backend.components.commonEditStatus')

                </div>
                <div class="modal-footer justify-content-center {{ setFont() }}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
