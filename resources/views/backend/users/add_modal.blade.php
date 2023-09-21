<?php $appointmentHelper = new \App\Helpers\AppointmentHelper();
?>
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
                    'url' => 'users',
                    'enctype' => 'multipart/form-data',
                    // 'id' => 'addUerForm',
                    'autocomplete' => 'off',
                ]) !!}
                <div class="row">
                    @if (systemAdmin() == true)
                        <div class="form-group col-md-4 {{ setFont() }}">

                            <label for="inputName">
                                {{ trans('common.local_body') }}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::select('client_id', appClientList()->pluck('name', 'id'), Request::get('client_id'), [
                                'class' => 'form-control select2 clientInfo',
                                'style' => 'width: 100%;',
                                'placeholder' => trans('common.select_local_body'),
                            ]) !!}
                        </div>
                    @endif
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('common.user_module') }}
                            <span class="text text-danger">*</span>
                        </label>
                        {!! Form::select(
                            'user_module',
                            userInfo()->role_id === 4 ? ['edmis' => 'EDMIS'] : userModule(),
                            Request::get('user_module'),
                            [
                                'class' => 'form-control select2 clientInfo',
                                'style' => 'width: 100%;',
                                'placeholder' => trans('common.select_user_module'),
                                'onchange' => 'toggleOptions(this.value)',
                            ],
                        ) !!}
                    </div>

                    <div class="form-group col-md-4 wardNoField" style="display: none;">
                        <label for="inputName">
                            {{ trans('message.pages.users_management.ward_no') }}
                            <span class="text text-danger">*</span>
                        </label>
                        {!! Form::text('ward_no', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.users_management.ward_no'),
                            'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('full_name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4 branchIdField" style="display: none;">
                        <label for="inputName">
                            {{ trans('message.pages.users_management.branch_id') }}
                            <span class="text text-danger">*</span>
                        </label>
                        {!! Form::text('branch_id', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.users_management.branch_id'),
                            'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('full_name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4 employeeIdField" style="display: none;">
                        <label for="inputName">
                            {{ trans('message.pages.users_management.employee_id') }}
                            <span class="text text-danger">*</span>
                        </label>
                        {!! Form::text('employee_id', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.users_management.employee_id'),
                            'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('full_name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4 departmentField  {{ setFont() }}" style="display: none;">
                        <label for="inputName">
                            {{ trans('appointment.department') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::select('visiting_section', appointmentDepartment(), @$appointment->visiting_section, [
                            'class' => 'form-control department',
                            'style' => 'width: 100%;',
                            'placeholder' => trans('appointment.select_department'),
                        ]) !!}
                    </div>

                    {{-- OFFICE_PERSON---HR-DESIGNATION --}}
                    <div class="form-group col-md-4 postBlock_office {{ setFont() }}"
                        style="@if (@$appointment->visiting_to_emp_designation != null && @$appointment->visiting_section == 'om') display: block @else display: none @endif">
                        <label for="inputName">
                            {{ trans('appointment.post') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::select(
                            'visiting_to_emp_designation',
                            $hrDesignationList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                            @$appointment->visiting_to_emp_designation,
                            [
                                'class' => 'form-control select2 employee_designation',
                                'style' => 'width: 100%;',
                                'placeholder' => trans('appointment.select_post'),
                            ],
                        ) !!}
                    </div>

                    {{-- ELECTED_PERSON --MEMBER_TYPE --}}
                    <div class="form-group col-md-4 postBlock_elected {{ setFont() }}"
                        style="@if (@$appointment->visiting_to_elected_designation != null && @$appointment->visiting_section == 'km') display: block @else display: none @endif">
                        <label for="inputName">
                            {{ trans('appointment.post') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::select(
                            'visiting_to_elected_designation',
                            $memberTypeList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                            @$appointment->visiting_to_elected_designation,
                            [
                                'class' => 'form-control select2 post elected_designation',
                                'style' => 'width: 100%;',
                                'placeholder' => trans('appointment.select_post'),
                            ],
                        ) !!}
                    </div>


                    {{-- EMPLOYEE_LIST --}}
                    <div class="form-group col-md-4 employeeBlock {{ setFont() }}"
                        style="@if (@$appointment->visiting_section == 'om' && @$appointment->employee_id != null) display :block @else display:none @endif">
                        <label for="inputName">
                            {{ trans('appointment.employee') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        @if (@$appointment->employee_id != null)
                            {!! Form::select(
                                'employee_id',
                                $appointmentHelper->getEmployeeByDesId(@$appointment->visiting_to_emp_designation),
                                @$appointment->employee_id,
                                [
                                    'class' => 'form-control select2 employee_id',
                                    'style' => 'width: 100%;',
                                    'placeholder' => trans('appointment.select_employee'),
                                ],
                            ) !!}
                        @else
                            <select class='form-control select2 selected employee_id' name='employee_id'
                                style="width: 100%">
                                <option class='form control' value=''>
                                    {{ trans('appointment.select_employee') }}
                                </option>
                            </select>
                        @endif
                    </div>

                    {{-- ELECTED_PERSON_LIST --}}
                    <div class="form-group col-md-4 electedPersonBlock {{ setFont() }}"
                        style="@if (@$appointment->visiting_section == 'km' && @$appointment->elected_person_id != null) display :block @else display:none @endif">
                        <label for="inputName">
                            {{ trans('appointment.elected_person') }}

                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        @if (@$appointment->elected_person_id != null)
                            {!! Form::select(
                                'elected_person_id',
                                $appointmentHelper->getElectedPersonByDesId(@$appointment->visiting_to_elected_designation),
                                @$appointment->elected_person_id,
                                [
                                    'class' => 'form-control select2 elected_person_id',
                                    'style' => 'width: 100%;',
                                    'placeholder' => trans('appointment.select_elected_person'),
                                ],
                            ) !!}
                        @else
                            <select class='form-control select2 selected elected_person_id' name='elected_person_id'
                                style="width: 100%">
                                <option class='form control'
                                    value='  {{ $appointmentHelper->getElectedPerson(@$appointment->elected_person_id) }}'>
                                    {{ trans('appointment.select_elected_person') }}
                                </option>
                            </select>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.users_management.user_type') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::select('role_id', $roleList->pluck('name', 'id'), Request::get('role_id'), [
                            'class' => 'form-control select2',
                            'required',
                            'style' => 'width: 100%',
                            'placeholder' => trans('message.pages.role_access.select_user_type'),
                        ]) }}
                    </div>


                    <div class="form-group col-md-4 fullNameEnBlock">
                        <label for="inputName">
                            {{ trans('message.pages.users_management.full_name') }} {{ trans('[ In English ]') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('full_name', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.common.name_en'),
                            'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('full_name', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-4 fullNameNpBlock">
                        <label for="inputName">
                            {{ trans('message.pages.users_management.full_name') }} {{ trans('[ नेपालीमा ]') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('full_name_np', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.common.name_np'),
                            'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('full_name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label>
                            {{ trans('message.pages.users_management.login_user_name') }}
                        </label>

                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('login_user_name', null, [
                            'class' => 'form-control',
                            'id' => 'login_user_name',
                            'placeholder' => trans('message.pages.users_management.login_user_name'),
                            'required',
                        ]) !!}
                        {!! $errors->first('login_user_name', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label>
                            {{ trans('message.pages.users_management.login_email_address') }}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::email('email', null, [
                            'class' => 'form-control',
                            'id' => 'email',
                            'required',
                            'placeholder' => trans('message.pages.users_management.login_email_address'),
                        ]) !!}
                        {!! $errors->first('email', '<span class="text text-danger">:message</span>') !!}
                    </div>

                    @include('backend.components.commonAddStatus')

                    <div class="form-group col-md-4">
                        <label for="status">
                            {{ trans('message.pages.users_management.random_password') }}
                        </label>
                        <br>
                        <input class="radio-button" type="radio" name="rand_password" checked=""
                            onclick="passwordYes();" value="1" style="margin-top: 2px">
                        {{ trans('message.button.yes') }}
                        &nbsp; &nbsp;
                        <input class="radio-button" type="radio" name="rand_password" onclick="passwordNo()"
                            value="0" style="margin-top: 2px">
                        {{ trans('message.button.no') }}
                    </div>

                    <div class="form-group col-md-4" id="passwordBlock" style="display: none">
                        <label>
                            {{ trans('message.pages.users_management.password') }}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}

                        {!! $errors->first('password', '<span class="text text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-4" id="confirmPasswordBlock" style="display: none">
                        <label>
                            {{ trans('message.pages.users_management.confirm_password') }}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::password('confirm_password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}

                        {!! $errors->first('confirm_password', '<span class="text text-danger">:message</span>') !!}
                    </div>


                    <div class="form-group col-md-4">
                        <label for="status">
                            {{ trans('message.pages.users_management.send_email') }}
                        </label>
                        <br>
                        <input class="radio-button" type="radio" name="send_email" value="1"
                            style="margin-top: 2px">
                        {{ trans('message.button.yes') }} &nbsp; &nbsp;
                        <input class="radio-button" type="radio" name="send_email" value="0"
                            style="margin-top: 2px" checked>
                        {{ trans('message.button.no') }}
                    </div>

                    <div class="form-group col-md-4">

                        <label for="image">
                            {{ trans('message.pages.users_management.user_image') }}
                        </label>
                        <input type="file" class="form-control-file profile-img"
                            accept=".jpg, .jpeg, .png, .JPG, .JPEG, .PNG" name="image">
                        {!! $errors->first('image', '<span class="text text-danger">:message</span>') !!}

                        @if ($errors->has('image') == null)
                            <span class="text text-danger" style="font-size: 11px;color: #ff042c">
                                {{ trans('message.pages.users_management.file_upload_message') }}
                            </span>
                        @endif
                    </div>

                </div>


                <div class="modal-footer justify-content-center {{ setFont() }}">

                    @include('backend.components.buttons.addAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
            <script>
                function toggleOptions(selectedValue) {
                    var wardNoField = document.querySelector('.wardNoField');
                    var branchIdField = document.querySelector('.branchIdField');
                    var employeeIdField = document.querySelector('.employeeIdField');
                    var departmentField = document.querySelector('.departmentField');
                    var fullNameNpBlock = document.querySelector('.fullNameNpBlock');
                    var fullNameEnBlock = document.querySelector('.fullNameEnBlock');


                    if (selectedValue === 'edmis') {
                        wardNoField.style.display = 'block';
                        branchIdField.style.display = 'block';
                        employeeIdField.style.display = 'block';
                        fullNameEnBlock.style.display = 'block';
                        fullNameNpBlock.style.display = 'block';
                        departmentField.style.display = 'none';
                    } else if (selectedValue === 'app') {
                        wardNoField.style.display = 'none';
                        branchIdField.style.display = 'none';
                        employeeIdField.style.display = 'none';
                        fullNameNpBlock.style.display = 'none';
                        fullNameEnBlock.style.display = 'none';
                        departmentField.style.display = 'block';
                    } else {
                        wardNoField.style.display = 'none';
                        branchIdField.style.display = 'none';
                        employeeIdField.style.display = 'none';
                        departmentField.style.display = 'none';
                        fullNameEnBlock.style.display = 'block';
                        fullNameNpBlock.style.display = 'block';
                    }
                }
            </script>

        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
