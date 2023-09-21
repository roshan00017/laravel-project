<div class="modal fade" id="addModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.add') }}
                    <span style="font-size: 14px;"> {{ trans('validation.pages.common.mandatory_field_message') }}
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open([
                'method' => 'post',
                'url' => 'employees',
                'enctype' => 'multipart/form-data',
                'id' => 'addUerForm',
                'autocomplete' => 'off',
                'files' => 'true',
                ]) !!}

                <div class="row {{ setFont() }}">
                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('message.pages.common.code') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('code', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.common.code'),
                            'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                    </div>


                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('employee.name') }} [{{ trans('employee.nepali') }}]
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('first_name_np', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('employee.name'),
                        'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('first_name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('employee.middle_name') }} [{{ trans('employee.nepali') }}]
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('middle_name_np', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('employee.middle_name'),
                        'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('middle_name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('employee.last_name') }} [{{ trans('employee.nepali') }}]
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('last_name_np', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('employee.last_name'),
                        'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('last_name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>


                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('employee.name') }} [{{ trans('employee.english') }}]
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('first_name_en', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('employee.name'),
                        'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('first_name_en', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('employee.middle_name') }}[{{ trans('employee.english') }}]
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('middle_name_en', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('employee.middle_name'),
                        'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('middle_name_en', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('employee.last_name') }}[{{ trans('employee.english') }}]
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('last_name_en', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('employee.last_name'),
                        'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('last_name_en', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    @if(getLan() =='np')
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('employee.date_of_birth_bs') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('dob_bs', null, [
                        'class' => 'form-control nepaliDatePicker',
                        'placeholder' => trans('employee.date_of_birth_bs'),
                        'autocomplete' => 'off',
                        'id' => 'dob_bs',
                        'required',
                        ]) !!}
                        {!! $errors->first('dob_bs', '<small class="text text-danger">:message</small>') !!}
                        <input type="hidden" name="dob_ad" id="dob_ad">
                    </div>
                    @endif

                    @if(getLan() == 'en')
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('employee.date_of_birth_ad') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('dob_ad', null, [
                        'class' => 'form-control englishDatePicker',
                        'placeholder' => trans('employee.date_of_birth_ad'),
                        'autocomplete' => 'off',
                        'required',
                        'id' => 'dob_ad',
                        ]) !!}
                        {!! $errors->first('dob_ad', '<small class="text text-danger">:message</small>') !!}
                        <input type="hidden" name="dob_bs" id="dob_bs">
                    </div>
                    @endif

                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('employee.phone') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('phone_number', null, [
                        'class' => 'form-control mobileNo',
                        'placeholder' => trans('employee.phone'),
                        'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('phone_number', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('employee.email') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('email', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('employee.email'),
                            'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('email', '<span class="text text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('employee.ward') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::text('ward_no', null, [
                            'class' => 'form-control',
                            'style' => 'width: 100%',
                            'placeholder' => trans('employee.ward'),
                        ]) }}

                        {!! $errors->first('ward_no', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('employee.current_branch') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::select(
                            'branch_id',
                            $departmentList->pluck(getLan() == 'np' ? 'name_np' : 'name_en'),
                            Request::get('gender'),
                            [
                                'class' => 'form-control select2',
                                'style' => 'width: 100%',
                                'placeholder' => trans('employee.select_current_branch'),
                            ],
                        ) }}

                        {!! $errors->first('branch_id', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    {{-- <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('employee.photo') }}
                    <span class="text text-danger">
                        *
                    </span>
                    </label>
                    {!! Form::file('file_name', null, [
                    'class' => 'form-control select2',
                    'placeholder' => trans('employee.photo'),
                    'autocomplete' => 'off',
                    ]) !!}

                    {!! $errors->first('photo', '<small class="text text-danger">:message</small>') !!}
                </div> --}}

            </div>

            <div class="modal-footer justify-content-center {{ setFont() }}">

                @include('backend.components.buttons.addAction')
            </div>

            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>