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
                                        <div class="form-group col-md-4 {{ setFont() }}">
                                            <label for="inputName">
                                                {{ trans('appointment.visiting_date_bs') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>


                                            @if (isset($request->date_np))
                                                {!! Form::text('appointment_date_bs', $request->date_np, [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('appointment.visiting_date_bs'),
                                                    'autocomplete' => 'off',
                                                    'required',
                                                    'readonly' => true,
                                                ]) !!}
                                            @else
                                                {!! Form::text('appointment_date_bs', @$appointment->appointment_date_bs, [
                                                    'class' => 'form-control nepaliDatePicker',
                                                    'placeholder' => trans('appointment.visiting_date_bs'),
                                                    'autocomplete' => 'off',
                                                    'id' => 'date_bs',
                                                    'required',
                                                ]) !!}
                                            @endif
                                        </div>

                                        <div class="form-group col-md-4 {{ setFont() }}">
                                            <label for="inputName">
                                                {{ trans('appointment.visiting_date_ad') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>

                                            @if (isset($request->date_en))
                                                {!! Form::text('appointment_date_ad', $request->date_en, [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('appointment.visiting_date_ad'),
                                                    'autocomplete' => 'off',
                                                    'required',
                                                    'readonly' => true,
                                                ]) !!}
                                            @else
                                                {!! Form::text('appointment_date_ad', @$appointment->appointment_date_ad, [
                                                    'class' => 'form-control englishDatePicker',
                                                    'placeholder' => trans('appointment.visiting_date_ad'),
                                                    'autocomplete' => 'off',
                                                    'id' => 'date_ad',
                                                    'required',
                                                ]) !!}
                                            @endif



                                            {!! $errors->first('date_en', '<small class="text text-danger">:message</small>') !!}
                                        </div>

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
                            

                                        {{-- OFFICE_PERSON---HR-DESIGNATION --}}
                                       
                                        {{-- ELECTED_PERSON --MEMBER_TYPE --}}
                                       


                                        {{-- EMPLOYEE_LIST --}}
                                       

                                        {{-- ELECTED_PERSON_LIST --}}
                                       

                                        
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
