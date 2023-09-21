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

                {!! Form::model($data, [
                    'method' => 'PUT',
                    'route' => ['users.update', $data->id],
                    'enctype' => 'multipart/form-data',
                    'autocomplete' => 'off',
                ]) !!}
                <div class="row">
                    @if (systemAdmin() == true)
                        <div class="form-group col-md-6 {{ setFont() }}">
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

                    <div class="form-group col-md-6 {{ setFont() }}">
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
                                'onchange' => 'toggleFields(this.value, ' . $key . ')',
                            ],
                        ) !!}
                    </div>

                    @if (userInfo()->user_module != 'app')
                        <div class="form-group col-md-6 {{ setFont() }}" style="display: none;"
                            id="visitingDepartmentContainer{{ $key }}">
                            <label for="inputName">
                                {{ trans('appointment.department') }}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::select('visiting_section', appointmentDepartment(), @$data->visiting_section, [
                                'class' => 'form-control department',
                                'style' => 'width: 100%;',
                                'placeholder' => trans('appointment.select_department'),
                            ]) !!}
                        </div>

                        {{-- OFFICE_PERSON---HR-DESIGNATION --}}
                        <div class="form-group col-md-6 postBlock_office {{ setFont() }}"
                            style="@if ($data->visiting_section == 'om' && userInfo()->user_module != 'app') display: block @else display: none @endif">
                            <label for="inputName">
                                {{ trans('appointment.post') }}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::select(
                                'visiting_to_emp_designation',
                                $hrDesignationList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                                @$data->visiting_to_designation_id,
                                [
                                    'class' => 'form-control select2 employee_designation',
                                    'style' => 'width: 100%;',
                                    'placeholder' => trans('appointment.select_post'),
                                ],
                            ) !!}
                        </div>

                        {{-- ELECTED_PERSON --MEMBER_TYPE --}}
                        <div class="form-group col-md-6 postBlock_elected {{ setFont() }}"
                            style="@if ($data->visiting_section == 'km' && userInfo()->user_module != 'app') display: block @else display: none @endif">
                            <label for="inputName">
                                {{ trans('appointment.post') }}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::select(
                                'visiting_to_elected_designation',
                                $memberTypeList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                                $data->visiting_to_designation_id,
                                [
                                    'class' => 'form-control select2 elected_designation',
                                    'style' => 'width: 100%;',
                                    'placeholder' => trans('appointment.select_post'),
                                ],
                            ) !!}
                        </div>


                        {{-- EMPLOYEE_LIST --}}
                        <div class="form-group col-md-6 employeeBlock {{ setFont() }}"
                            style="@if ($data->visiting_section == 'om' && userInfo()->user_module != 'app') display :block @else display:none @endif">
                            <label for="inputName">
                                {{ trans('appointment.employee') }}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::select(
                                'employee',
                                $employeeList->pluck(getLan() == 'np' ? 'full_name_np' : 'full_name_en', 'id'),
                                $data->visiting_to_person_id,
                                [
                                    'class' => 'form-control select2 employee_id',
                                    'style' => 'width: 100%;',
                                    'placeholder' => trans('appointment.select_employee'),
                                ],
                            ) !!}
                        </div>

                        {{-- ELECTED_PERSON_LIST --}}
                        <div class="form-group col-md-6 electedPersonBlock {{ setFont() }}"
                            style="@if ($data->visiting_section == 'km' && userInfo()->user_module != 'app') display :block @else display:none @endif">
                            <label for="inputName">
                                {{ trans('appointment.elected_person') }}

                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::select(
                                'elected_person_id',
                                $electedPersonList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                                $data->visiting_to_person_id,
                                [
                                    'class' => 'form-control select2 elected_person_id',
                                    'style' => 'width: 100%;',
                                    'placeholder' => trans('appointment.select_elected_person'),
                                ],
                            ) !!}
                        </div>
                    @endif

                    <div class="form-group col-md-12 {{ setFont() }}" style="display: none;"
                        id="branchWardEmployeeFields{{ $key }}">
                        <div class="form-group col-md-4">
                            <label for="inputName" class="{{ setFont() }}">
                                {{ trans('message.pages.users_management.ward_no') }}
                                <span class="text text-danger">*</span>
                            </label>
                            {!! Form::text('ward_no', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('message.pages.users_management.ward_no'),
                                'autocomplete' => 'off',
                            ]) !!}
                            {!! $errors->first('ward_no', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputName" class="{{ setFont() }}">
                                {{ trans('message.pages.users_management.branch_id') }}
                                <span class="text text-danger">*</span>
                            </label>
                            {!! Form::text('branch_id', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('message.pages.users_management.branch_id'),
                                'autocomplete' => 'off',
                            ]) !!}
                            {!! $errors->first('branch_id', '<small class="text text-danger">:message</small>') !!}
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputName" class="{{ setFont() }}">
                                {{ trans('message.pages.users_management.employee_id') }}
                                <span class="text text-danger">*</span>
                            </label>
                            {!! Form::text('employee_id', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('message.pages.users_management.employee_id'),
                                'autocomplete' => 'off',
                            ]) !!}
                            {!! $errors->first('employee_id', '<small class="text text-danger">:message</small>') !!}
                        </div>
                    </div>


                    <div class="form-group col-md-6  {{ setFont() }}">
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
                    <div class="form-group col-md-6  {{ setFont() }}" id="fullNameEnBlock{{ $key }}">
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
                    <div class="form-group col-md-6  {{ setFont() }}" id="fullNameNpBlock{{ $key }}">
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
                    @if ($data->image != null)
                        <div class="form-group col-md-4 {{ setFont() }}">
                            <label for="">
                                {{ trans('message.pages.common.uploaded_photo') }}
                            </label>
                            <br>
                            <img src="{{ asset('/storage/' . $filePath . '/' . $data->image) }}" alt="Image"
                                class="rounded-pill" style="width: 60px; height: 60px">
                            <a href="{{ URL::to('/storage/' . $filePath . '/' . $data->image) }}" target="_blank"
                                class="btn btn-secondary btn-xs rounded-pill" data-placement="top"
                                title="{{ trans('message.pages.common.viewFile') }}" style="margin: 10px 0 0 10px;">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="javascript:void(0)" style="margin: 10px 0 0 10px;"
                                class="btn btn-danger btn-xs rounded-pill deleteFile" data-id="{{ $data->id }}"
                                data-widget="{{ $page_url }}"
                                title="{{ trans('message.pages.common.deleteFile') }}">
                                <i class="fa fa-trash">
                                </i>
                            </a>
                        </div>
                    @endif
                    <div class="form-group col-md-4  {{ setFont() }}">
                        <label for="image">
                            {{ trans('message.pages.users_management.user_image') }}
                        </label>
                        <input type="file" class="form-control-file profile-img" name="image"
                            accept=".jpg, .jpeg, .png, .JPG, .JPEG, .PNG">
                        {!! $errors->first('image', '<span class="text text-danger">:message</span>') !!}

                        @if ($errors->has('image') == null)
                            <span class="text text-danger" style="font-size: 12px;color: #ff042c">
                                {{ trans('message.pages.users_management.file_upload_message') }}
                            </span>
                        @endif
                    </div>


                </div>


                <div class="modal-footer justify-content-center {{ setFont() }}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
            <script>
                function toggleFields(selectedValue, key) {
                    var branchWardEmployeeFields = document.getElementById('branchWardEmployeeFields' + key);
                    var fullNameEnBlock = document.getElementById('fullNameEnBlock' + key);
                    var fullNameNpBlock = document.getElementById('fullNameNpBlock' + key);
                    var visitingDepartmentContainer = document.getElementById('visitingDepartmentContainer' + key);


                    if (selectedValue === 'edmis') {
                        branchWardEmployeeFields.style.display = 'flex';
                        fullNameEnBlock.style.display = 'block';
                        fullNameNpBlock.style.display = 'block';
                        visitingDepartmentContainer.style.display = 'none';


                    } else if (selectedValue === 'app') {
                        branchWardEmployeeFields.style.display = 'none';
                        fullNameEnBlock.style.display = 'none';
                        fullNameNpBlock.style.display = 'none';
                        visitingDepartmentContainer.style.display = 'block';


                    } else {
                        branchWardEmployeeFields.style.display = 'none';
                        fullNameEnBlock.style.display = 'block';
                        fullNameNpBlock.style.display = 'block';
                        visitingDepartmentContainer.style.display = 'none';

                    }
                }
            </script>


        </div>
    </div>
</div>
