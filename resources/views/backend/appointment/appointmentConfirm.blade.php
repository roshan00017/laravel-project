<?php $appointmentHelper = new \App\Helpers\AppointmentHelper();
?>
@extends('backend.layouts.app')
<link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.css') }}">
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button
                                                class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{ setFont() }}"
                                                style="margin-bottom: 20px">
                                                <i class="fa fa-calendar-day"></i>
                                                {{ trans('appointment.visiting_details') }}
                                            </button>
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr class="detail-section {{ setFont() }}">
                                                        <td class="section-header" width="40%"
                                                            style="font-size: 1.15em;">
                                                            {{ trans('appointment.appointment_date') }}
                                                        </td>

                                                        <td width="60%">
                                                            @if (@$appointment->appointment_date_bs)
                                                                {{ getLan() == 'np' ? $appointment->appointment_date_bs : $appointment->appointment_date_ad }}
                                                                &nbsp;
                                                                <i class="fa fa-clock"></i>
                                                                {{ \Carbon\Carbon::parse(@$appointment->time)->format('g:i A') }}
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr class="detail-section {{ setFont() }}">
                                                        <td class="section-header" width="40%"
                                                            style="font-size: 1.15em;">
                                                            {{ trans('appointment.visiting_department') }}
                                                        </td>

                                                        <td width="60%">
                                                            @if (@$appointment->visiting_section)
                                                                {{ appointmentDepartment($appointment->visiting_section) }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if (@$appointment->employee_id)
                                                        <tr class="detail-section {{ setFont() }}">
                                                            <td class="section-header" width="20%"
                                                                style="font-size: 1.15em;">
                                                                {{ trans('appointment.employee') }}
                                                            </td>

                                                            <td width="60%">
                                                                {{ $appointmentHelper->getEmployee(@$appointment->employee_id) }}
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    @if (@$appointment->elected_person_id)
                                                        <tr class="detail-section {{ setFont() }}">
                                                            <td class="section-header" width="20%"
                                                                style="font-size: 1.15em;">
                                                                {{ trans('appointment.employee') }}
                                                            </td>

                                                            <td width="60%">
                                                                {{ $appointmentHelper->getElectedPerson(@$appointment->elected_person_id) }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if (@$appointment->visiting_purpose_id)
                                                        <tr class="detail-section {{ setFont() }}">
                                                            <td class="section-header" width="20%"
                                                                style="font-size: 1.15em;">
                                                                {{ trans('appointment.visiting_purpose') }}
                                                            </td>

                                                            <td width="60%">
                                                                {{ $appointmentHelper->getVisitingPurpose(@$appointment->visiting_purpose_id) }}
                                                            </td>
                                                        </tr>
                                                    @endif


                                                    @if (@$appointment->visiting_purpose_reason)
                                                        <tr class="detail-section {{ setFont() }}">
                                                            <td class="section-header" width="20%"
                                                                style="font-size: 1.15em;">
                                                                {{ trans('appointment.visiting_purpose') }}
                                                            </td>

                                                            <td width="60%">
                                                                {{ $appointment->visiting_purpose_reason }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            {!! Form::open([
                                                'method' => 'post',
                                                'url' => 'appointmentConfirm',
                                            ]) !!}
                                            <div class="row ml-2">
                                                <div class="form-group col-md-4 {{ setFont() }}">
                                                    <label for="status">
                                                        {{ trans('message.pages.users_management.send_email') }}
                                                    </label>
                                                    <br>
                                                    <input class="radio-button" type="radio" name="send_email"
                                                        value="1" style="margin-top: 2px">
                                                    {{ trans('message.button.yes') }} &nbsp; &nbsp;
                                                    <input class="radio-button" type="radio" name="send_email"
                                                        value="0" style="margin-top: 2px" checked>
                                                    {{ trans('message.button.no') }}
                                                </div>

                                                <div class="form-group col-md-4 {{ setFont() }}">
                                                    <label for="status">
                                                        {{ trans('SMS पठाउनुहोस्') }}
                                                    </label>
                                                    <br>
                                                    <input class="radio-button" type="radio" name="send_sms"
                                                        value="1" style="margin-top: 2px">
                                                    {{ trans('message.button.yes') }} &nbsp; &nbsp;
                                                    <input class="radio-button" type="radio" name="send_sms"
                                                        value="0" style="margin-top: 2px" checked>
                                                    {{ trans('message.button.no') }}
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-6">
                                            <button
                                                class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{ setFont() }}"
                                                style="margin-bottom: 20px">
                                                <i class="fa fa-user"></i>
                                                {{ trans('appointment.personal_details') }}
                                            </button>
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr class="detail-section {{ setFont() }}">
                                                        <td class="section-header" width="40%"
                                                            style="font-size: 1.15em;">
                                                            {{ trans('appointment.full_name') }}
                                                        </td>

                                                        <td width="80%">
                                                            @if (@$appointment->full_name)
                                                                {{ $appointment->full_name }}
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr class="detail-section {{ setFont() }}">
                                                        <td class="section-header" width="40%"
                                                            style="font-size: 1.15em;">
                                                            {{ trans('appointment.email') }}
                                                        </td>

                                                        <td width="80%">
                                                            @if (@$appointment->email)
                                                                {{ $appointment->email }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr class="detail-section {{ setFont() }}">
                                                        <td class="section-header" width="40%"
                                                            style="font-size: 1.15em;">
                                                            {{ trans('appointment.mobile_no') }}
                                                        </td>

                                                        <td width="80%">
                                                            @if (@$appointment->mobile_no)
                                                                {{ $appointment->mobile_no }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr class="detail-section {{ setFont() }}">
                                                        <td class="section-header" width="40%"
                                                            style="font-size: 1.15em;">
                                                            {{ trans('appointment.address') }}
                                                        </td>

                                                        <td width="80%">
                                                            @if (@$appointment->address)
                                                                {{ $appointment->address }}
                                                            @endif
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>


                                    </div>

                                    <a href="{{ route('appointment.personalInfo') }}"
                                        class="btn btn-info rounded-pill float-left {{ setFont() }}">
                                        <i class="fa fa-arrow-alt-circle-left"></i> {{ trans('appointment.previous') }}
                                    </a>
                                    &nbsp; &nbsp;


                                    <div class="modal-footer justify-content-center {{ setFont() }}">
                                        <button type="submit" class="btn btn-primary rounded-pill ">
                                            <i class="fa fa-save"></i>
                                            {{ trans('message.button.save') }}
                                        </button>
                                    </div>

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
