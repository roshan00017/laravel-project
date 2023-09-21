@extends('frontend.layouts.welcome')
<?php $appointmentHelper = new \App\Helpers\AppointmentHelper();
?>
<style>
    .tables__section .table__grid {
        display: block !important
    }
</style>
@section('content')
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
        <h2 class="section__title {{ setFont() }}">
            {{ trans('appointment.appointment_history_list') }}
        </h2>
        <div class="tables__section">
            <div class="custom-container">
                <div class="table__grid">
                    <div class="table__responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="{{ setFont() }}">
                                        {{ trans('message.commons.s_n') }}
                                    </th>
                                    <th class="{{ setFont() }}">
                                        {{ trans('appointment.appointment_no') }}
                                    </th>
                                    <th class="{{ setFont() }}">
                                        {{ trans('appointment.appointment_date') }}
                                    </th>
                                    <th class="{{ setFont() }}">
                                        {{ trans('appointment.full_name') }}
                                    </th>
                                    <th class="{{ setFont() }}">
                                        {{ trans('appointment.email') }}
                                    </th>
                                    <th class="{{ setFont() }}">
                                        {{ trans('appointment.mobile_no') }}
                                    </th>
                                    <th class="{{ setFont() }}">
                                        {{ trans('message.commons.status') }}
                                    </th>
                                    <th class="{{ setFont() }}">
                                        {{ trans('message.commons.action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $key => $appointment)
                                    <tr>
                                        <th scope="row {{ setFont() }}">
                                            {{ ++$key }}
                                        </th>

                                        <td>
                                            {{ $appointment->appointment_no }}
                                        </td>

                                        <td class="{{ setFont() }}">
                                            {{ getLan() == 'np' ? $appointment->appointment_date_bs : $appointment->appointment_date_ad }}
                                            &nbsp;
                                            <i class="fa fa-clock"></i>
                                            {{ \Carbon\Carbon::parse(@$appointment->time)->format('g:i A') }}
                                        </td>


                                        <td class="{{ setFont() }}">
                                            @if (isset($appointment->full_name))
                                                {{ $appointment->full_name }}
                                            @endif
                                        </td>

                                        <td>
                                            @if (isset($appointment->email))
                                                {{ $appointment->email }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($appointment->mobile_no))
                                                {{ $appointment->mobile_no }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($appointment->appointment_status == 1)
                                                <button class="btn btn-sm btn-secondary rounded-pill {{ setFont() }}"
                                                    appointment-toggle="modal"
                                                    data-target="#statusModal{{ $key }}">
                                                    @if (isset($appointment->appointmentStatus))
                                                        {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                    @endif
                                                </button>
                                            @elseif($appointment->appointment_status == 2)
                                                <button class="btn btn-sm btn-success rounded-pill {{ setFont() }}">
                                                    @if (isset($appointment->appointmentStatus))
                                                        {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                    @endif

                                                </button>
                                            @elseif($appointment->appointment_status == 3)
                                                <button class="btn btn-sm btn-info rounded-pill {{ setFont() }}">
                                                    @if (isset($appointment->appointmentStatus))
                                                        {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                    @endif

                                                </button>
                                            @elseif($appointment->appointment_status == 4)
                                                <button class="btn btn-sm btn-danger rounded-pill {{ setFont() }}">
                                                    @if (isset($appointment->appointmentStatus))
                                                        {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                    @endif

                                                </button>
                                            @elseif($appointment->appointment_status == 5)
                                                <button class="btn btn-sm btn-primary rounded-pill {{ setFont() }}">
                                                    @if (isset($appointment->appointmentStatus))
                                                        {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                                    @endif
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-secondary btn-sm rounded-pill {{ setFont() }}"
                                                data-toggle="modal" data-target="#showModal{{ $key }}"
                                                data-placement="top" title="{{ trans('message.button.show') }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @include('frontend.appointment.show-appointment-modal')

                                            @if (isset($appComplaintProgress) && !empty($appComplaintProgress))
                                                <button type="button"
                                                    class="btn btn-secondary btn-sm rounded-pill {{ setFont() }}"
                                                    data-toggle="modal"
                                                    data-target="#showComplaintModal{{ $key }}"
                                                    data-placement="top" title="{{ trans('message.button.show') }}">
                                                    {{ trans('appointment.complaint_details') }}
                                                </button>
                                                @include('frontend.appointment.show-complaint-details')
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table__responsive" style="margin-bottom: 20px">
                        <div id="service_token">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
