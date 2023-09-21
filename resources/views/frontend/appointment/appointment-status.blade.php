@extends('frontend.layouts.welcome')
<?php $appointmentHelper = new \App\Helpers\AppointmentHelper(); ?>
@section('content')
    <style>
        @media print {

            /* Hide header */
            header {
                display: none;
            }

            /* Hide footer */
            footer {
                display: none;
            }

            /* Hide breadcrumbs */
            .breadcrumbs {
                display: none;
            }

            /* Hide print button */
            .print-button {
                display: none;
            }
        }
    </style>
    <section class="breadcrumbs">
        <div class="custom-container">
            <nav class="breadcrumbs__nav">
                <ul class="breadcrumbs__nav-menu">
                    <li>
                        <a href="{{ url('/') }}" class="breadcrumb__link {{ setFont() }}">
                            <i class="fa-solid fa-home"></i>
                            {{ trans('frontendSuggestion.suggestion.home_page') }}
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="breadcrumb__link {{ setFont() }}">
                            {{ $page_title }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <div class="form__section">
        <div class="custom-container">
            <div class="form__section-content">
                {!! Form::open(['route' => 'appointmentConfirm', 'method' => 'POST', 'class' => 'addFrom']) !!}
                <div class="input__grid">
                    <div>
                        <h5 class="{{ setFont() }}">
                            <i class="fa fa-calendar-day"></i>
                            {{ trans('appointment.visiting_details') }}
                        </h5>
                        <br>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="28%" class="{{ setFont() }}">
                                        {{ trans('complaints.ticket_no') }}
                                    </td>

                                    <td class="{{ setFont() }}">
                                        {{ @$appointment->appointment_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.appointment_date') }}
                                    </td>
                                    <td width="60%" class="{{ setFont() }}">
                                        @if (@$appointment->appointment_date_bs)
                                            {{ getLan() == 'np' ? $appointment->appointment_date_bs : $appointment->appointment_date_ad }}
                                            &nbsp;
                                            <i class="fa fa-clock"></i>
                                            {{ \Carbon\Carbon::parse(@$appointment->time)->format('g:i A') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.visiting_department') }}
                                    </td>
                                    <td width="60%" class="{{ setFont() }}">
                                        @if (@$appointment->visiting_section)
                                            {{ appointmentDepartment($appointment->visiting_section) }}
                                        @endif
                                    </td>
                                </tr>
                                @if ($appointment->visiting_section == 'km')
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.elected_person') }}
                                        </td>
                                        <td width="60%" class="{{ setFont() }}">
                                            @if (@$appointment->visiting_to_person_id)
                                                {{ $appointmentHelper->getElectedPerson(@$appointment->visiting_to_person_id) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @if ($appointment->visiting_section == 'om')
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.employee') }}
                                        </td>
                                        <td width="60%" class="{{ setFont() }}">
                                            @if (@$appointment->visiting_to_person_id)
                                                {{ $appointmentHelper->getEmployee(@$appointment->visiting_to_person_id) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @if (@$appointment->visiting_purpose_id)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.visiting_purpose') }}
                                        </td>
                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $appointmentHelper->getVisitingPurpose(@$appointment->visiting_purpose_id) }}
                                        </td>
                                    </tr>
                                @endif
                                @if (@$appointment->appointment_status)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('message.commons.status') }}
                                        </td>
                                        <td width="60%" class="{{ setFont() }}">
                                            @if (isset($appointment->appointmentStatus))
                                                {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @if (@$appointment->visiting_purpose_reason)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.other_reason') }}
                                        </td>
                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $appointment->visiting_purpose_reason }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h5 class="{{ setFont() }}">
                            <i class="fa fa-user"></i>
                            {{ trans('appointment.personal_details') }}
                        </h5>
                        <br>
                        <table class="table table-bordered">
                            <tbody>
                                @if (@$appointment->full_name)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.full_name') }}
                                        </td>
                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $appointment->full_name }}
                                        </td>
                                    </tr>
                                @endif
                                @if (@$appointment->address)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.address') }}
                                        </td>
                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $appointment->address }}
                                        </td>
                                    </tr>
                                @endif
                                @if (@$appointment->email)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.email') }}
                                        </td>
                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $appointment->email }}
                                        </td>
                                    </tr>
                                @endif
                                @if (@$appointment->mobile_no)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.mobile_no') }}
                                        </td>
                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $appointment->mobile_no }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        @if ($appComplaintInfo != null)
                            <div>
                                <h5 class="{{ setFont() }}">
                                    <i class="fa fa-question"> </i>
                                    {{ trans('appointment.complaint_details') }}
                                </h5>
                                <br>
                                <table class="table table-bordered">
                                    <tbody>
                                        @if ($appComplaintInfo->complaint_no)
                                            <tr>
                                                <td class="{{ setFont() }}">
                                                    {{ trans('complaints.ticket_no') }}
                                                </td>
                                                <td width="60%" class="{{ setFont() }}">
                                                    @if (isset($appComplaintInfo->complaint_no))
                                                        {{ $appComplaintInfo->complaint_no }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                        @if ($appComplaintInfo->complaintStatus->name_ne)
                                            <tr>
                                                <td class="{{ setFont() }}">
                                                    {{ trans('message.commons.status') }}
                                                </td>
                                                <td width="60%" class="{{ setFont() }}">
                                                    @if ($appComplaintInfo->status)
                                                        {{ getLan() == 'np' ? $appComplaintInfo->complaintStatus->name_ne : $appComplaintInfo->complaintStatus->name }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td class="{{ setFont() }}">
                                                {{ trans('complaints.related_works') }}
                                            </td>
                                            <td width="60%" class="{{ setFont() }}">
                                                <div class="tracking-list">
                                                    @foreach ($appComplaintProgress as $pg)
                                                        <div class="tracking-item">
                                                            <div class="tracking-icon status-intransit">
                                                                <svg class="svg-inline--fa fa-circle fa-w-16"
                                                                    aria-hidden="true" data-prefix="fas" data-icon="circle"
                                                                    role="img" xmlns="http://www.w3.org/2000/svg"
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
                                                                <span class="h6 mb-0 ">{{ $pg->description }}</span>
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
                    <div class="print-button" style="color: white; text-align: center;">
                        <a href="javascript:void(0)" onclick="window.print();" title="Print"
                            class="btn btn-primary {{ setFont() }}">
                            <i class="fa fa-print"></i>
                            {{ trans('complaintstatus.print') }}
                        </a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
