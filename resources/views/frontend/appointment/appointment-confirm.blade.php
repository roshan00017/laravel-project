@extends('frontend.layouts.welcome')
<?php $appointmentHelper = new \App\Helpers\AppointmentHelper();
?>
<style>
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
        <div class="custom-container">
            <div class="form__section-content">
                <h2 class="section__title {{ setFont() }}">
                    {{ trans('appointment.detail_confirm') }}
                </h2>

                @include('frontend.appointment.appointment-header')
                {!! Form::open(['route' => 'appointmentConfirm', 'method' => 'POST', 'class' => 'addFrom']) !!}
                <div class="input__grid">

                    <div>
                        <h5 class="{{ setFont() }}">
                            <i class="fa fa-calendar-day"></i>
                            {{ trans('appointment.visiting_details') }}
                        </h5>
                        <br>
                        <table class="table  table-bordered">
                            <tbody>

                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.appointment_date') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        @if (@$aptInfo->date_bs)
                                            {{ getLan() == 'np' ? $aptInfo->date_bs : $aptInfo->date_ad }}
                                            &nbsp;
                                            <i class="fa fa-clock"></i>
                                            {{ \Carbon\Carbon::parse(@$aptInfo->appointment_time)->format('g:i A') }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.visiting_department') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        @if (@$aptInfo->appointment_section)
                                            {{ appointmentDepartment($aptInfo->appointment_section) }}
                                        @endif
                                    </td>
                                </tr>
                                @if ($aptInfo->appointment_section == 'km')
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.elected_person') }}
                                        </td>

                                        <td width="60%" class="{{ setFont() }}">
                                            @if (@$aptInfo->ep_id)
                                                {{ $appointmentHelper->getElectedPerson(@$aptInfo->ep_id) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                @if ($aptInfo->appointment_section == 'om')
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.employee') }}
                                        </td>

                                        <td width="60%" class="{{ setFont() }}">
                                            @if (@$aptInfo->emp_id)
                                                {{ $appointmentHelper->getEmployee(@$aptInfo->emp_id) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                @if (@$aptInfo->appointment_purpose_id)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.visiting_purpose') }}
                                        </td>

                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $appointmentHelper->getVisitingPurpose(@$aptInfo->appointment_purpose_id) }}
                                        </td>
                                    </tr>
                                @endif

                                @if (@$aptInfo->appointment_purpose_reason)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.other_reason') }}
                                        </td>

                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $aptInfo->appointment_purpose_reason }}
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
                        <table class="table  table-bordered">
                            <tbody>

                                @if (@$aptInfo->name)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.full_name') }}
                                        </td>

                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $aptInfo->name }}
                                        </td>
                                    </tr>
                                @endif
                                @if (@$aptInfo->address_info)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.address') }}
                                        </td>

                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $aptInfo->address_info }}
                                        </td>
                                    </tr>
                                @endif
                                @if (@$aptInfo->email_address)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.email') }}
                                        </td>

                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $aptInfo->email_address }}
                                        </td>
                                    </tr>
                                @endif
                                @if (@$aptInfo->mobile)
                                    <tr>
                                        <td class="{{ setFont() }}">
                                            {{ trans('appointment.mobile_no') }}
                                        </td>

                                        <td width="60%" class="{{ setFont() }}">
                                            {{ $aptInfo->mobile }}
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>


                    <div class="button__group span2">
                        <a href="{{ route('personalInfo') }}" class="submit__btn form-prev">
                            <span class="{{ setFont() }}">
                                <i class="fa-solid fa-chevron-left"></i>
                                {{ trans('appointment.previous') }}
                            </span>
                        </a>

                        <button type="submit" class="submit__btn form-next {{ setFont() }}">
                            <span class="{{ setFont() }}">
                                {{ trans('frontendSuggestion.suggestion.sent_file') }}
                                <i class="fa-solid fa-paper-plane"></i>
                            </span>
                        </button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
    @include('frontend.component.submitModal')
@endsection
