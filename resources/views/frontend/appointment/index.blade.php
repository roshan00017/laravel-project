@extends('frontend.layouts.welcome')
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
            <div class="form__section-content ">
                <div>
                    <button class="btn btn-primary rounded-pill  {{ setFont() }}" style="color: white" data-toggle="modal"
                        data-target="#appointStatusTrack" title="{{ trans('frontEndAppointment.appointment_status') }}">
                        <i class="fa fa-question"> </i> {{ trans('frontEndAppointment.appointment_status') }}

                    </button>

                    <button class="btn btn-primary rounded-pill float-md-right {{ setFont() }}" style="color: white"
                        data-toggle="modal" data-target="#appointHistoryTrack"
                        title="{{ trans('appointment.visiting_details') }}">
                        <i class="fa fa-list"> </i> {{ trans('appointment.visiting_details') }}

                    </button>
                </div>
                <h2 class="section__title {{ setFont() }} ">
                    {{ trans('frontendSuggestion.appointment.appointment_request') }}
                </h2>

                @include('frontend.calendar.index')
                @include('frontend.component.dataNotFoundModal')
                @include('frontend.appointment.appointment-track-modal')
                @include('frontend.appointment.appointment-history-modal')
            </div>

        </div>
    </div>
@endsection
