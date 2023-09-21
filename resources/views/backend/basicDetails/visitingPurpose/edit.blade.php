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
                    <div class="form-group col-md-6 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.common.code') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('code', Request::get('code'), [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.common.code'),
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                    </div>


                    <div class="form-group col-md-6 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.common.name_en') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name_en', Request::get('name'), [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.common.name_en'),
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-6 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.common.name_np') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name_np', Request::get('name_ne'), [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.common.name_np'),
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('name_np', '<small class="text text-danger">:message</small>') !!}
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
