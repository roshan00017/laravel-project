<div class="modal fade" id="addModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.add') }}
                    <span style="font-size: 14px;"> {{ trans('validation.pages.common.mandatory_field_message') }}
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'post', 'id' => 'addForm', 'url' => $page_url]) !!}
                <div class="row">

                    <div class="form-group col-md-6 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.common.province_name') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::select('province_id', provinceList()->pluck('name', 'id'), Request::get('province_id'), [
                            'class' => 'form-control select2',
                            'id' => 'temp_province_code',
                            'required',
                            'style' => 'width: 100%; border-radius:1rem',
                            'placeholder' => trans('message.pages.common.select_province_name'),
                        ]) }}
                    </div>


                    <div class="form-group col-md-6 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.common.district_name') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        <select class='form-control select2 selected' name='district_id' id='temp_district_code'
                            required style="width: 100%" disabled>
                            <option class='form control' value=''>
                                {{ trans('message.pages.common.district_name') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 {{ setFont() }}" id="temp_local_body_code_block">
                        <label for="inputName">
                            {{ trans('message.pages.common.local_body_name') }}
                            <span class="required-field">
                                *
                            </span>
                        </label>
                        <select class='form-control select2 selected' name='local_body_mapping_id'
                            id='temp_local_body_code' style="width: 100%" disabled required>
                            <option class='form control' value=''>
                                {{ trans('message.pages.common.local_body_name') }}
                            </option>
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

                    @include('backend.components.buttons.addAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
