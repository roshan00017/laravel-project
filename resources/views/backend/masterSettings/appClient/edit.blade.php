<div class="modal fade" id="editModal{{ $key }}" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.edit') }}
                    <span style="font-size: 14px;"> {{ trans('validation.pages.common.mandatory_field_message') }}
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($data, ['method' => 'PUT', 'route' => [$page_route . '.' . 'update', $data->id]]) !!}
                <div class="row">

                    @php
                        $name = setName();
                    @endphp
                    <div class="form-group col-md-6 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.common.province_name') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::select(
                            'province_id',
                            provinceList($data->province_id)->pluck('name', 'id'),
                            Request::get('province_id'),
                            [
                                'class' => 'form-control ',
                                'required',
                                'id' => 'per_province_code',
                                'style' => 'width: 100%;',
                                'placeholder' => trans('message.pages.common.select_province_name'),
                            ],
                        ) }}
                    </div>


                    <div class="form-group col-md-6 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.common.district_name') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        <select class='form-control  selected' name='district_id' required id="per_district_code"
                            style="width: 100%">
                            <option class='form control' value=''>
                                {{ trans('message.pages.common.district_name') }}
                            </option>

                            @foreach (districtListByCode($data->province_id) as $val)
                                <option value='{{ $val->code }}'
                                    @if (isset($data->district_id)) @if ($val->code == $data->district_id) selected @endif
                                @else {{ old('district_id') == $data->district_id ? 'selected' : '' }}
                                    @endif
                                    >
                                    {{ $val->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.common.local_body_name') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        <select class='form-control select2 selected' name='local_body_mapping_id' style="width: 100%"
                            id="per_local_body_code" required>
                            <option class='form control' value=''>
                                {{ trans('message.pages.common.local_body_name') }}
                            </option>
                            @foreach (localBodyListByCode($data->district_id) as $val)
                                <option data='{{ $val->code }}'
                                    @if (isset($data->local_body_mapping_id)) @if ($val->code == $data->local_body_mapping_id) selected @endif
                                @else
                                    {{ old('local_body_code') == $data->local_body_mapping_id ? 'selected' : '' }}
                                    @endif
                                    >
                                    {{ $val->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6  {{ setFont() }}">
                        <label for="inputFeedback">
                            {{ trans('appClient.web_url') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('web_url', Request::get('web_url'), [
                            'class' => 'form-control',
                            'placeholder' => trans('appClient.web_url'),
                            'rows' => '4',
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('web_url', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    @include('backend.components.commonAddStatus')
                </div>

                <div class="modal-footer justify-content-center {{ setFont() }}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>
</div>
