<?php $appointmentHelper = new \App\Helpers\AppointmentHelper(); ?>
@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                            {{ $page_title }} {{ trans('message.pages.roles.details') }}
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
                                {{ trans('message.pages.roles.details') }}
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

            <!-- /.row -->


            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        @include('backend.components.buttons.returnBack')
                        @if ($appointment->appointment_status == 1)
                            <button class="btn btn-primary btn-sm float-left rounded-pill  boxButton {{ setFont() }}"
                                data-toggle="modal" data-target="#handoverModal" data-placement="top"
                                title="{{ trans('appointment.appointment_handover') }}">
                                <i class="fa fa-magnet"></i>
                                {{ trans('appointment.appointment_handover') }}
                            </button>
                        @endif

                    </div>
                    <div class="card-body">
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
                                            <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                {{ trans('appointment.appointment_no') }}
                                            </td>

                                            <td width="80%">
                                                {{ @$appointment->appointment_no }}
                                            </td>
                                        </tr>

                                        <tr class="detail-section {{ setFont() }}">
                                            <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                {{ trans('appointment.appointment_date') }}
                                            </td>

                                            <td width="80%">
                                                @if (@$appointment->appointment_date_bs)
                                                    {{ getLan() == 'np' ? $appointment->appointment_date_bs : $appointment->appointment_date_ad }}
                                                    &nbsp;
                                                    <i class="fa fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse(@$appointment->time)->format('g:i A') }}
                                                @endif
                                            </td>
                                        </tr>

                                        <tr class="detail-section {{ setFont() }}">
                                            <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                {{ trans('appointment.visiting_department') }}
                                            </td>

                                            <td width="80%">
                                                @if (@$appointment->visiting_section)
                                                    {{ appointmentDepartment($appointment->visiting_section) }}
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($appointment->visiting_section == 'km')
                                            <tr class="detail-section {{ setFont() }}">
                                                <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                    {{ trans('appointment.elected_person') }}
                                                </td>

                                                <td width="80%">
                                                    @if (@$appointment->visiting_to_person_id)
                                                        {{ $appointmentHelper->getElectedPerson(@$appointment->visiting_to_person_id) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                        @if ($appointment->visiting_section == 'om')
                                            <tr class="detail-section {{ setFont() }}">
                                                <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                    {{ trans('appointment.employee') }}
                                                </td>

                                                <td width="80%">
                                                    @if (@$appointment->visiting_to_person_id)
                                                        {{ $appointmentHelper->getEmployee(@$appointment->visiting_to_person_id) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                        @if (@$appointment->visiting_purpose_id)
                                            <tr class="detail-section {{ setFont() }}">
                                                <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                    {{ trans('appointment.visiting_purpose') }}
                                                </td>

                                                <td width="80%">
                                                    {{ $appointmentHelper->getVisitingPurpose(@$appointment->visiting_purpose_id) }}
                                                </td>
                                            </tr>
                                        @endif


                                        @if (@$appointment->visiting_purpose_reason)
                                            <tr class="detail-section {{ setFont() }}">
                                                <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                    {{ trans('appointment.other_reason') }}
                                                </td>

                                                <td width="80%">
                                                    {{ $appointment->visiting_purpose_reason }}
                                                </td>
                                            </tr>
                                        @endif

                                        <tr class="detail-section {{ setFont() }}">
                                            <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                {{ trans('message.commons.status') }}
                                            </td>

                                            <td width="80%">
                                                @if ($appointment->appointment_status == 1)
                                                    <?php
                                                    $key = $appointment->appointment_status;
                                                    $data = $appointment;
                                                    ?>
                                                    <button
                                                        class="btn btn-xs btn-secondary rounded-pill {{ setFont() }}"
                                                        data-toggle="modal" data-target="#statusModal{{ $key }}">
                                                        @if (isset($appointment->appointmentStatus))
                                                            {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                        @endif
                                                    </button>
                                                @elseif($appointment->appointment_status == 2)
                                                    <button
                                                        class="btn btn-xs btn-success rounded-pill {{ setFont() }}">
                                                        @if (isset($appointment->appointmentStatus))
                                                            {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                        @endif

                                                    </button>
                                                @elseif($appointment->appointment_status == 3)
                                                    <button class="btn btn-xs btn-info rounded-pill {{ setFont() }}">
                                                        @if (isset($appointment->appointmentStatus))
                                                            {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                        @endif

                                                    </button>
                                                @elseif($appointment->appointment_status == 4)
                                                    <button class="btn btn-xs btn-danger rounded-pill {{ setFont() }}">
                                                        @if (isset($appointment->appointmentStatus))
                                                            {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                        @endif

                                                    </button>
                                                @elseif($appointment->appointment_status == 5)
                                                    <button
                                                        class="btn btn-xs btn-primary rounded-pill {{ setFont() }}">
                                                        @if (isset($appointment->appointmentStatus))
                                                            {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                        @endif

                                                    </button>
                                                @endif
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>

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
                                            <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                {{ trans('appointment.full_name') }}
                                            </td>

                                            <td width="80%">
                                                @if (@$appointment->full_name)
                                                    {{ $appointment->full_name }}
                                                @endif
                                            </td>
                                        </tr>

                                        <tr class="detail-section {{ setFont() }}">
                                            <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                {{ trans('appointment.email') }}
                                            </td>

                                            <td width="80%">
                                                @if (@$appointment->email)
                                                    {{ $appointment->email }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="detail-section {{ setFont() }}">
                                            <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                {{ trans('appointment.mobile_no') }}
                                            </td>

                                            <td width="80%">
                                                @if (@$appointment->mobile_no)
                                                    {{ $appointment->mobile_no }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="detail-section {{ setFont() }}">
                                            <td class="section-header" width="40%" style="font-size: 1.15em;">
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

                                @if ($appComplaintInfo != null)
                                    <div class="col-md-12">
                                        <button
                                            class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{ setFont() }}"
                                            style="margin-bottom: 20px">
                                            <i class="fa fa-question"> </i>
                                            {{ trans('appointment.complaint_details') }}
                                        </button>
                                        <table class="table table-bordered table-striped">
                                            <tbody>

                                                <tr class="detail-section {{ setFont() }}">
                                                    <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                        {{ trans('complaints.ticket_no') }}
                                                    </td>

                                                    <td width="80%">
                                                        @if (isset($appComplaintInfo->complaint_no))
                                                            {{ $appComplaintInfo->complaint_no }}
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr class="detail-section {{ setFont() }}">
                                                    <td class="section-header" width="40%" style="font-size: 1.15em;">
                                                        {{ trans('message.commons.status') }}
                                                    </td>

                                                    <td width="80%">
                                                        @if ($appComplaintInfo->status)
                                                            {{ getLan() == 'np' ? $appComplaintInfo->complaintStatus->name_ne : $appComplaintInfo->complaintStatus->name }}
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size: 1.15em;" class="{{ setFont() }}">
                                                        {{ trans('complaints.related_works') }}
                                                    </td>
                                                    <td>
                                                        <div class="tracking-list {{ setFont() }}">
                                                            @foreach ($appComplaintProgress as $pg)
                                                                <div class="tracking-item">
                                                                    <div class="tracking-icon status-intransit">
                                                                        <svg class="svg-inline--fa fa-circle fa-w-16"
                                                                            aria-hidden="true" data-prefix="fas"
                                                                            data-icon="circle" role="img"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 512 512" data-fa-i2svg="">
                                                                            {{-- <path fill="currentColor"
                                                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                                        </path> --}}
                                                                        </svg>
                                                                        {{-- <i class="fas fa-circle"></i> --}}
                                                                    </div>
                                                                    <div class="tracking-date">
                                                                        <div>
                                                                            {{ getLan() == 'np' ? $dateHelper->eng_to_nep($pg->created_at, true) : date('l, jS F, Y', strtotime($pg->created_at)) }}
                                                                        </div>

                                                                    </div>
                                                                    <div class="tracking-content">
                                                                        <span
                                                                            class="h6 mb-0 ">{{ $pg->description }}</span>
                                                                        <span>
                                                                            {{ @$pg->responding_office }}</span>
                                                                        <span>-
                                                                            {{ getLan() == 'np' ? @$pg->userInfo->full_name_np : @$pg->userInfo->full_name }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                @endif


                            </div>



                            @if (sizeof($visitLogDetails) > 0)
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <button
                                            class="btn btn-secondary btn-sm float-left rounded-pill {{ setFont() }}">
                                            <i class="fa fa-list"></i>
                                            {{ trans('appointment.appointment_log_details') }}
                                        </button>

                                    </div>
                                    @include('backend.appointment.appointmentHistory')

                                </div>
                            @endif

                            @if (sizeof($handoverDetails) > 0)
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <button
                                            class="btn btn-secondary btn-sm float-left rounded-pill {{ setFont() }}">
                                            <i class="fa fa-list"></i>
                                            {{ trans('appointment.appointment_handover_details') }}
                                        </button>

                                    </div>
                                    @include('backend.appointment.appointmentHistory')

                                </div>
                            @endif
                        </div>
                        <div class="modal-footer justify-content-center {{ setFont() }}">
                            @if ($appointment->appointment_status == 2)
                                <button
                                    class="openFormButton {{ setFont() }} btn btn-primary float-left rounded-pill boxButton">
                                    <i class="fa fa-info-circle"></i>
                                    {{ getLan() == 'np' ? ' गुनासो प्रतिक्रिया/सूचना  पठाउने ? ' : 'Send Complaint Processing ?' }}
                                </button>
                            @endif
                            <a href="{{ url(@$index_page_url) }}"
                                class="btn btn-danger  rounded-pill {{ setFont() }}"
                                title="{{ trans('message.button.close') }}">
                                <i class="fa fa-times-circle"></i>
                                {{ trans('message.button.close') }}
                            </a>
                        </div>
                        <div class="container-fluid myForm" style="display: none;">
                            {!! Form::open([
                                'method' => 'post',
                                'enctype' => 'multipart/form-data',
                                'id' => 'addMore',
                                'route' => 'appointment.progress',
                            ]) !!}
                            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row" style="margin: 10px">
                                        <div class="col-md-12">
                                            <h4 class="{{ setFont() }}">
                                                {{ trans('complaints.new_work') }}
                                            </h4>
                                            <hr>

                                        </div>

                                        <div class="form-group col-md-4 {{ setFont() }}">
                                            <label for="inputName">
                                                {{ trans('complaints.grievance_status') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <br>
                                            {{ Form::select('complaint_status', $complaintStatuses->pluck('name', 'id'), Request::get('complaint_status'), [
                                                'class' => 'form-control select2 countrySelector complaint_status',
                                            
                                                'style' => 'width: 100%',
                                                'placeholder' => trans('complaints.select_status'),
                                            ]) }}
                                        </div>

                                        <div class="form-group col-md-12 detailsBlock" style="display: none">
                                            <label for="inputName" class="{{ setFont() }}">
                                                {{ trans('complaints.progress_information') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            {!! Form::textarea('description', null, [
                                                'class' => 'form-control details',
                                                'autocomplete' => 'off',
                                                'rows' => '4',
                                            ]) !!}
                                            {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                                        </div>

                                        <div class="form-group col-md-12 officeBlock" style="display: none">
                                            <label for="inputName" class="{{ setFont() }}">
                                                {{ trans('complaints.responding_office') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            {!! Form::text('responding_office', null, [
                                                'class' => 'form-control office',
                                                'autocomplete' => 'off',
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center {{ setFont() }}">
                                        <button type="submit" class="btn btn-primary float-left rounded-pill"
                                            id="btn-add">
                                            <i class="fa fa-save"></i>
                                            {{ trans('message.button.save') }}
                                        </button>
                                        &nbsp;&nbsp;
                                        <button type="button" class="btn btn-danger closeButton rounded-pill"
                                            data-dismiss="modal">
                                            <i class="fa fa-times-circle"></i>
                                            {{ trans('message.button.close') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    @include('backend.appointment.handoverModal')
    @include('backend.appointment.visitUpdateModal')

    <script>
        $(document).ready(function() {

            $('.openFormButton').click(function() {
                $('.myForm').toggle();
            });
        });
    </script>
    <script>
        document.querySelector('.closeButton').addEventListener('click', function() {

            document.querySelector('.myForm').style.display = 'none';
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.confirmButton').click(function() {
                $('.confirmModal').modal('show');
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.openFormButton').click(function() {
                $('.myForm').toggle();
            });

            $(".complaint_status").change(function() {
                if (this.value == "3") {
                    $(".detailsBlock").show();
                    $(".officeBlock").show();
                    $('.details').prop('required', true);
                    $('.office').prop('required', true);
                } else {
                    $(".detailsBlock").hide();
                    $(".officeBlock").hide();
                    $('.details').prop('required', false);
                    $('.office').prop('required', false);
                }
            });
        });
    </script>
@endsection
