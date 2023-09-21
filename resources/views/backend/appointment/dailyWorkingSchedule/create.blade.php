@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 {{setFont()}}">
                        {{$page_title}}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right {{setFont()}}">
                        <li class="breadcrumb-item">
                            <a href="{{url('dashboard')}}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                {{ trans('message.dashboard.page_title') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{url('dcDispatchBook')}}">
                                {{$page_title}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            {{trans('message.commons.add')}}
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
                        {!! Form::open(['method'=>'post',
                        'route'=>$page_route. '.'.'store',
                        ]) !!}
                        <div class="card-header">
                            @include('backend.components.buttons.returnBack')
                            <h5 class="{{setFont()}}"><strong> {{trans('message.commons.add')}}</strong>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="date_np" value="{{@$date_np}}">
                                <input type="hidden" name="date_en" value="{{@$date_en}}">
                                @if(userInfo()->user_module !='app')
                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('schedule.visiting_officer') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::select('schedule_type', appointmentDepartment(),
                                    Request::get('schedule_type'), [
                                    'class' => 'form-control select2',
                                    'style' => 'width: 100%;',
                                    'id' => 'department',
                                    'placeholder' => trans('schedule.visiting_officer'),
                                    ]) !!}
                                </div>
                                @endif

                                <div class="form-group col-md-3 {{ setFont() }}" style="display: none"
                                    id="postBlock_office">
                                    <label for="inputName">
                                        {{ trans('appointment.post') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::select(
                                    'schedule_to_emp_designation',
                                    $hrDesignationList->pluck('name', 'id'),
                                    Request::get('schedule_to_emp_designation'),
                                    [
                                    'class' => 'form-control select2',
                                    'style' => 'width: 100%;',
                                    'id' => 'employee_designation',
                                    'placeholder' => trans('appointment.select_post'),
                                    ],
                                    ) !!}
                                </div>
                                <div class="form-group col-md-3 {{ setFont() }}" style="display: none"
                                    id="postBlock_elected">
                                    <label for="inputName">
                                        {{ trans('appointment.post') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::select(
                                    'scheduling_to_elected_designation',
                                    $memberTypeList->pluck('name', 'id'),
                                    Request::get('scheduling_to_elected_designation'),
                                    [
                                    'class' => 'form-control select2 post',
                                    'id' => 'elected_designation',
                                    'style' => 'width: 100%;',
                                    'placeholder' => trans('appointment.select_post'),
                                    ],
                                    ) !!}
                                </div>

                                <div class="form-group col-md-3 {{ setFont() }}" id="employeeBlock"
                                    style="@if(@$appointment->visiting_section =='om' && @$appointment->employee_id !=null) display :block @else display:none @endif">
                                    <label for="inputName">
                                        {{ trans('appointment.employee') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select class='form-control select2 selected' name='employee_id' id='employee_id'
                                        style="width: 100%">
                                        <option class='form control' value=''>
                                            {{ trans('appointment.select_employee') }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3 {{ setFont() }}" id="electedPersonBlock"
                                    style="@if(@$appointment->visiting_section =='km' && @$appointment->elected_person_id !=null) display :block @else display:none @endif">
                                    <label for="inputName">
                                        {{ trans('appointment.elected_person') }}

                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select class='form-control select2 selected' name='elected_person_id'
                                        id='elected_person_id' style="width: 100%">
                                        <option class='form control' value=''>
                                            {{ trans('appointment.select_elected_person') }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('schedule.schedule_type') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::select('type_id', $scheduleTypes->pluck('name','id'),
                                    Request::get('type_id'), [
                                    'class' => 'form-control select2',
                                    'style' => 'width: 100%;',
                                    'placeholder' => trans('schedule.schedule_type'),
                                    ]) !!}
                                </div>

                                {{-- Radio Button  --}}
                                @if(is_null(@$date_np))
                                <div class="form-group col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p style="font-weight: bold;  display: block;" class="{{ setFont() }}">
                                                {{ trans('schedule.task_list') }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div style="clear: both;"></div>
                                                <div style="float: left; margin-right: 10px;">
                                                    <input class="radio-button" type="radio" name="status" checked
                                                        value="1" id="yes" style="margin-top: 2px">
                                                    <label class="{{ setFont() }}">{{ trans('schedule.yes') }}</label>
                                                </div>
                                                <div style="float: left; margin-right: 10px;">
                                                    <input class="radio-button" type="radio" name="status" value="0"
                                                        id="no" style="margin-top: 2px">
                                                    <label class="{{ setFont() }}">{{ trans('schedule.no') }}</label>
                                                </div>
                                                <div style="clear: both;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                {{-- Date fields to show or not --}}
                                <div id="dateFields" style="display: none;">
                                    <div class="row">
                                        @if(getLan() =='np')
                                        <div class="form-group col-md-6 {{setFont()}}">
                                            <label for="inputName">
                                                {{ trans('schedule.Date') }}
                                                <span class="text text-danger">*</span>
                                            </label>
                                            {!! Form::text('schedule_date_np', null, [
                                            'class' => 'form-control nepaliDatePicker',
                                            'placeholder' => trans('schedule.Date') ,
                                            'autocomplete' => 'off',
                                            'id' => 'date_from_bs',
                                            'required' => 'required', // Added 'required' attribute
                                            ]) !!}
                                            @if ($errors->has('schedule_date_np'))
                                            <small
                                                class="text text-danger">{{ $errors->first('schedule_date_np') }}</small>
                                            @endif
                                            <input type="hidden" name='schedule_date_en' id="date_from_ad">
                                        </div>
                                        @endif

                                        @if(getLan() =='en')
                                        <div class="form-group col-md-6 {{setFont()}}">
                                            <label for="inputName">
                                                {{ trans('schedule.Date') }}
                                                <span class="text text-danger">*</span>
                                            </label>
                                            {!! Form::text('schedule_date_en', null, [
                                            'class' => 'form-control englishDatePicker',
                                            'placeholder' => trans('schedule.Date') ,
                                            'autocomplete' => 'off',
                                            'id' => 'date_from_ad',
                                            'required' => 'required', // Added 'required' attribute
                                            ]) !!}
                                            @if ($errors->has('schedule_date_en'))
                                            <small
                                                class="text text-danger">{{ $errors->first('schedule_date_en') }}</small>
                                            @endif
                                            <input type="hidden" name='schedule_date_np' id="date_from_bs">
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                @include('backend.appointment.dailyWorkingSchedule.add')
                            </div>
                            <div class="modal-footer justify-content-center {{setFont()}}">
                                @include('backend.components.buttons.addAction')
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.container-fluid -->
    <!-- /.content -->
    @include('backend.basicDetails.mstOffice.add')
    @include('backend.modal.technical-error-modal')
    @include('backend.modal.check_data_modal')
</div>
@endsection
