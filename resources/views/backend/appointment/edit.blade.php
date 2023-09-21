@extends('backend.layouts.app')
<?php $appointmentHelper = new \App\Helpers\AppointmentHelper();
?>
@section('content')
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                            {{ $page_title }}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right {{ setFont() }}">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    {{ trans('message.dashboard.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ url($page_url) }}">
                                    {{ $page_title }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{ trans('message.commons.edit') }}
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @include('backend.components.buttons.returnBack')
                                <h5 class="{{ setFont() }}">
                                    <strong> {{ trans('message.commons.edit') }}
                                    </strong>
                                    <span style="font-size: 14px; color: #ca4843">
                                        {{ trans('validation.pages.common.mandatory_field_message') }} </span>
                                </h5>

                            </div>
                            <div class="card-body">
                                {!! Form::model($value, [
                                    'method' => 'PUT',
                                    'route' => [$page_route . '.' . 'update', $value->id],
                                    'enctype' => 'multipart/form-data',
                                    'autocomplete' => 'off',
                                ]) !!}
                                <div class="row">
                                    <div class="form-group col-md-12 {{ setFont() }}">
                                        <button
                                            class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{ setFont() }}"
                                            style="margin-bottom: 20px">
                                            <i class="fa fa-calendar-day"></i>
                                            {{ trans('appointment.visiting_details') }}
                                        </button>
                                    </div>

                                    @if (getLan() == 'np')
                                        <div class="form-group col-md-4 {{ setFont() }}">
                                            <label for="inputName">
                                                {{ trans('appointment.visiting_date') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            {!! Form::text('appointment_date_bs', Request::get('appointment_date'), [
                                                'class' => 'form-control nepaliDatePicker',
                                                'placeholder' => trans('appointment.visiting_date_bs'),
                                                'autocomplete' => 'off',
                                                'id' => 'date_bs',
                                                'required',
                                            ]) !!}
                                        </div>
                                        <input type="hidden" name='appointment_date_ad' id="date_ad">
                                    @endif

                                    @if (getLan() == 'en')
                                        <div class="form-group col-md-4 {{ setFont() }}">
                                            <label for="inputName">
                                                {{ trans('appointment.visiting_date') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            {!! Form::text('appointment_date_ad', Request::get('appointment_date_ad'), [
                                                'class' => 'form-control englishDatePicker',
                                                'placeholder' => trans('appointment.visiting_date'),
                                                'autocomplete' => 'off',
                                                'id' => 'date_ad',
                                                'required',
                                            ]) !!}

                                            {!! $errors->first('date_en', '<small class="text text-danger">:message</small>') !!}
                                        </div>
                                        <input type="hidden" name='appointment_date_bs' id="date_bs">
                                    @endif

                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('appointment.visiting_time') }}

                                        </label>
                                        {{ Form::time('time', Request::get('time'), [
                                            'class' => 'form-control startTime',
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('meeting.meeting.time'),
                                        ]) }}
                                    </div>

                                    @if (userInfo()->user_module != 'app')
                                        <div class="form-group col-md-4 {{ setFont() }}">
                                            <label for="inputName">
                                                {{ trans('appointment.visiting_department') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            {!! Form::select('visiting_section', appointmentDepartment(), @$data->visiting_section, [
                                                'class' => 'form-control',
                                                'style' => 'width: 100%;',
                                                'id' => 'department',
                                                'placeholder' => trans('appointment.select_visiting_department'),
                                            ]) !!}
                                        </div>
                                    @endif

                                    {{-- OFFICE_PERSON---HR-DESIGNATION --}}
                                    <div class="form-group col-md-4 {{ setFont() }}"
                                        style="@if ($value->visiting_section == 'om' && userInfo()->user_module != 'app') display: block @else display: none @endif"
                                        id="postBlock_office">
                                        <label for="inputName">
                                            {{ trans('appointment.post') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::select(
                                            'visiting_to_emp_designation',
                                            $hrDesignationList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                                            @$value->visiting_to_designation_id,
                                            [
                                                'class' => 'form-control select2',
                                                'style' => 'width: 100%;',
                                                'id' => 'employee_designation',
                                                'placeholder' => trans('appointment.select_post'),
                                            ],
                                        ) !!}
                                    </div>

                                    {{-- ELECTED_PERSON --MEMBER_TYPE --}}
                                    <div class="form-group col-md-4 {{ setFont() }}"
                                        style="@if ($value->visiting_section == 'km' && userInfo()->user_module != 'app') display: block @else display: none @endif"
                                        id="postBlock_elected">
                                        <label for="inputName">
                                            {{ trans('appointment.post') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::select(
                                            'visiting_to_elected_designation',
                                            $memberTypeList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                                            $value->visiting_to_designation_id,
                                            [
                                                'class' => 'form-control select2 post',
                                                'id' => 'elected_designation',
                                                'style' => 'width: 100%;',
                                                'placeholder' => trans('appointment.select_post'),
                                            ],
                                        ) !!}
                                    </div>


                                    {{-- EMPLOYEE_LIST --}}
                                    <div class="form-group col-md-4 {{ setFont() }}" id="employeeBlock"
                                        style="@if ($value->visiting_section == 'om' && userInfo()->user_module != 'app') display :block @else display:none @endif">
                                        <label for="inputName">
                                            {{ trans('appointment.employee') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::select(
                                            'employee_id',
                                             $employeeList->pluck(getLan() == 'np' ? 'full_name_np' : 'full_name_en', 'id'),
                                            $value->visiting_to_person_id,
                                            [
                                                'class' => 'form-control select2',
                                                'style' => 'width: 100%;',
                                                'id' => 'employee_id',
                                                'placeholder' => trans('appointment.select_employee'),
                                            ],
                                        ) !!}
                                    </div>

                                    {{-- ELECTED_PERSON_LIST --}}
                                    <div class="form-group col-md-4 {{ setFont() }}" id="electedPersonBlock"
                                        style="@if ($value->visiting_section == 'km' && userInfo()->user_module != 'app') display :block @else display:none @endif">
                                        <label for="inputName">
                                            {{ trans('appointment.elected_person') }}

                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::select(
                                            'elected_person_id',
                                            $electedPersonList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                                            $value->visiting_to_person_id,
                                            [
                                                'class' => 'form-control select2',
                                                'style' => 'width: 100%;',
                                                'id' => 'elected_person_id',
                                                'placeholder' => trans('appointment.select_elected_person'),
                                            ],
                                        ) !!}
                                    </div>

                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('appointment.visiting_purpose') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::select(
                                            'visiting_purpose_id',
                                            $visitingPurposeList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                                            Request::get('visiting_purpose_id'),
                                            [
                                                'class' => 'form-control select2',
                                                'style' => 'width: 100%;',
                                                'placeholder' => trans('appointment.select_visiting_purpose'),
                                            ],
                                        ) !!}
                                    </div>
                                    <div class="form-group col-md-12  {{ setFont() }}">
                                        <label for="inputFeedback">
                                            {{ trans('appointment.visiting_purpose') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::textarea('visiting_purpose_reason', Request::get('visiting_purpose_reason'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('meeting.meeting_agenda_list.description'),
                                            'rows' => '4',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                        {!! $errors->first(
                                            'description',
                                            '<small
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        class="text text-danger">:message</small>',
                                        ) !!}
                                    </div>
                                    <div class="form-group col-md-12 {{ setFont() }}">
                                        <button
                                            class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{ setFont() }}"
                                            style="margin-bottom: 20px">
                                            <i class="fa fa-user"></i>
                                            {{ trans('appointment.personal_details') }}
                                        </button>
                                    </div>
                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('appointment.full_name') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('full_name', Request::get('full_name'), [
                                            'class' => 'form-control',
                                            'required',
                                            'placeholder' => trans('appointment.full_name'),
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('appointment.email') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::email('email', Request::get('email'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('appointment.email'),
                                            'autocomplete' => 'off',
                                        ]) !!}
                                        {!! $errors->first('email', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('appointment.mobile_no') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('mobile_no', Request::get('mobile_no'), [
                                            'class' => 'form-control mobileNo',
                                            'placeholder' => trans('appointment.mobile_no'),
                                            'autocomplete' => 'off',
                                        ]) !!}
                                        {!! $errors->first('mobile_no', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('appointment.address') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('address', Request::get('address'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('appointment.address'),
                                            'autocomplete' => 'off',
                                        ]) !!}
                                        {!! $errors->first('address', '<small class="text text-danger">:message</small>') !!}
                                    </div>


                                </div>
                                <div class="modal-footer justify-content-center {{ setFont() }}">
                                    @include('backend.components.buttons.updateAction')
                                </div>
                                {!! Form::close() !!}


                            </div>


                        </div>

                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
@endsection
