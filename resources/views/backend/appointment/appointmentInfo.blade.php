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
                                {{ trans('message.commons.add') }}
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">


            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body p-0">
                            <div class="bs-stepper">
                                @include('backend.appointment.appointmentHeader')
                                <div class="bs-stepper-content ">


                                    {!! Form::open([
                                        'method' => 'post',
                                        'id' => 'addForm',
                                        'route' => $page_route . '.' . 'store',
                                    ]) !!}
                                    <div class="row">

                                        @if (getLan() == 'np')
                                            <div class="form-group col-md-4 {{ setFont() }}">
                                                <label for="inputName">
                                                    {{ trans('appointment.visiting_date') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                @if (isset($request->date_np))
                                                    {!! Form::text('appointment_date_bs', $request->date_np, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('appointment.visiting_date'),
                                                        'autocomplete' => 'off',
                                                        'required',
                                                        'readonly' => true,
                                                    ]) !!}
                                                @else
                                                    {!! Form::text('appointment_date_bs', @$appointment->appointment_date_bs, [
                                                        'class' => 'form-control nepaliDatePicker',
                                                        'placeholder' => trans('appointment.visiting_date'),
                                                        'autocomplete' => 'off',
                                                        'id' => 'date_bs',
                                                        'required',
                                                    ]) !!}
                                                @endif
                                                <input type="hidden" name='appointment_date_ad' id="date_from_ad">
                                            </div>
                                        @endif

                                        @if (getLan() == 'en')
                                            <div class="form-group col-md-4 {{ setFont() }}">
                                                <label for="inputName">
                                                    {{ trans('appointment.visiting_date') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                @if (isset($request->date_en))
                                                    {!! Form::text('appointment_date_ad', $request->date_en, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('appointment.visiting_date'),
                                                        'autocomplete' => 'off',
                                                        'required',
                                                        'readonly' => true,
                                                    ]) !!}
                                                @else
                                                    {!! Form::text('appointment_date_ad', @$appointment->appointment_date_ad, [
                                                        'class' => 'form-control englishDatePicker',
                                                        'placeholder' => trans('appointment.visiting_date'),
                                                        'autocomplete' => 'off',
                                                        'id' => 'date_ad',
                                                        'required',
                                                    ]) !!}
                                                @endif
                                                {!! $errors->first('date_en', '<small class="text text-danger">:message</small>') !!}
                                                <input type="hidden" name='appointment_date_bs' id="date_bs">
                                            </div>
                                        @endif


                                        <div class="form-group col-md-4 {{ setFont() }}">
                                            <label for="inputName">
                                                {{ trans('appointment.visiting_time') }}

                                            </label>
                                            {{ Form::time('time', @$appointment->time, [
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
                                                {!! Form::select('visiting_section', appointmentDepartment(), @$appointment->visiting_section, [
                                                    'class' => 'form-control',
                                                    'style' => 'width: 100%;',
                                                    'id' => 'department',
                                                    'placeholder' => trans('appointment.select_visiting_department'),
                                                ]) !!}
                                            </div>
                                        @endif

                                        {{-- OFFICE_PERSON---HR-DESIGNATION --}}
                                        <div class="form-group col-md-4 {{ setFont() }}"
                                            style="@if (@$appointment->visiting_to_emp_designation != null && @$appointment->visiting_section == 'om') display: block @else display: none @endif"
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
                                                @$appointment->visiting_to_emp_designation,
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
                                            style="@if (@$appointment->visiting_to_elected_designation != null && @$appointment->visiting_section == 'km') display: block @else display: none @endif"
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
                                                @$appointment->visiting_to_elected_designation,
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
                                                        'class' => 'form-control select2',
                                                        'style' => 'width: 100%;',
                                                        'id' => 'employee_id',
                                                        'placeholder' => trans('appointment.select_employee'),
                                                    ],
                                                ) !!}
                                            @else
                                                <select class='form-control select2 selected' name='employee_id'
                                                    id='employee_id' style="width: 100%">
                                                    <option class='form control' value=''>
                                                        {{ trans('appointment.select_employee') }}
                                                    </option>
                                                </select>
                                            @endif
                                        </div>

                                        {{-- ELECTED_PERSON_LIST --}}
                                        <div class="form-group col-md-4 {{ setFont() }}" id="electedPersonBlock"
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
                                                        'class' => 'form-control select2',
                                                        'style' => 'width: 100%;',
                                                        'id' => 'elected_person_id',
                                                        'placeholder' => trans('appointment.select_elected_person'),
                                                    ],
                                                ) !!}
                                            @else
                                                <select class='form-control select2 selected' name='elected_person_id'
                                                    id='elected_person_id' style="width: 100%">
                                                    <option class='form control'
                                                        value='  {{ $appointmentHelper->getElectedPerson(@$appointment->elected_person_id) }}'>
                                                        {{ trans('appointment.select_elected_person') }}
                                                    </option>
                                                </select>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-4 {{ setFont() }}">

                                            <label for="inputName">
                                                {{ trans('appointment.visiting_purpose') }}
                                            </label>
                                            {!! Form::select(
                                                'visiting_purpose_id',
                                                $visitingPurposeList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                                                @$appointment->visiting_purpose_id,
                                                [
                                                    'class' => 'form-control select2',
                                                    'style' => 'width: 100%;',
                                                    'placeholder' => trans('appointment.select_visiting_purpose'),
                                                ],
                                            ) !!}
                                        </div>
                                        <div class="form-group col-md-12  {{ setFont() }}">
                                            <label for="inputFeedback">
                                                {{ trans('appointment.other_reason') }}
                                            </label>
                                            {!! Form::textarea('visiting_purpose_reason', @$appointment->visiting_purpose_reason, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('meeting.meeting_agenda_list.description'),
                                                'rows' => '4',
                                                'autocomplete' => 'off',
                                            ]) !!}
                                            {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                                        </div>


                                    </div>
                                    <div class="modal-footer justify-content-center {{ setFont() }}">
                                        <button type="submit"
                                            class="pull-right btn btn-primary rounded-pill {{ setFont() }}">
                                            {{ trans('appointment.next') }}
                                            <i class="fa fa-arrow-alt-circle-right"></i>
                                        </button>
                                    </div>
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
@endsection
