@extends('frontend.layouts.welcome')


@section('content')

<section class="notice__section lightBgColor">
    <div class="custom-container">
        <div class="notice__content">
            <h1 class="notice__title {{setFont()}}">
                {{ __('frontend.notice') }}
            </h1>

            <marquee behavior="infinte" direction="left" onmouseover="this.stop()" onmouseout="this.start()">
                <ul class="marquee__slider">
                    @foreach($notices as $key=>$notice)
                    <li class="slider__item">
                        <a href="" target="_blank">

                            <p class="{{setFont()}}">
                                {{ $notice->title }}
                            </p>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </marquee>
        </div>
    </div>
</section>

<section class="domain__section">
    <div class="custom-container">
        <div class="domain__section-grid">
            <div class="grid__card">
                <div class="grid__icon">
                    <a href="{{url('office-automation-info')}}">
                        <img src="{{asset('assets/images/icon1.png')}}" alt="">
                </div>

                <div class="grid__details">
                    <h2 class="grid__title {{setFont()}}">
                        {{ __('frontEndDashboard.Office_Automation') }}
                    </h2>
                    </a>
                </div>
            </div>

            <div class="grid__card">
                <div class="grid__icon">
                    <a href="{{url('complaint-suggestion-info')}}">
                        <img src="{{asset('assets/images/icon2.png')}}" alt="">
                </div>

                <div class="grid__details">
                    <h2 class="grid__title {{setFont()}}">
                        {{ __('frontEndDashboard.Grievance_management') }}
                    </h2>
                    </a>
                </div>
            </div>

            <div class="grid__card">
                <div class="grid__icon">
                    <a href="{{url('digital-citizenship-charter-info')}}">
                        <img style=" width:60px;height:60px;" src="{{asset('assets/images/icon10.png')}}" alt="">
                </div>

                <div class="grid__details">
                    <h2 class="grid__title {{setFont()}}">
                        {{ __('frontEndDashboard.Electronic_Citizen_Charter') }}
                    </h2>
                    </a>
                </div>
            </div>

            <div class="grid__card">
                <div class="grid__icon">
                    <a href="{{url('meeting-management-info')}}">
                        <img src="{{asset('assets/images/icon4.png')}}" alt="">
                </div>

                <div class="grid__details">
                    <h2 class="grid__title {{setFont()}}">
                        {{ __('frontEndDashboard.Meeting_management') }}
                    </h2>
                    </a>
                </div>
            </div>

            <div class="grid__card1">
                <p class="other-service">
                    <b class="font_white {{setFont()}}">
                        {{ trans('frontEndDashboard.other_services') }}
                    </b>
                </p>
                <div class="grid-list">

                    <ul>
                        <li>
                            <a href="{{url('suchikrit-info')}}">
                                <p class="{{setFont()}}">
                                    <i class="fa-brands fa-wpforms"></i>
                                    {{ trans('frontEndDashboard.do_suchikrit') }}
                                </p>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('appointment-schedule')}}">
                                <p class="{{setFont()}}">
                                    <i class="fa-solid fa-handshake"></i>
                                    {{ trans('frontEndDashboard.meetup') }}
                                </p>
                            </a>
                        </li>

                        <li>
                            {{--                            <a href="{{url('complaint-info')}}">--}}
                            {{--                                <p class="{{setFont()}}">--}}
                            {{--                                    <i class="fa-solid fa-clipboard-check"></i>--}}
                            {{--                                    {{ trans('frontEndDashboard.complaint_suggestion_register') }}--}}
                            {{--                                </p>--}}
                            {{--                            </a>--}}
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#registerModal"
                                title="{{ trans('frontEndDashboard.complaint_suggestion_register') }}">
                                <p class="{{setFont()}}">
                                    <i class="fa-solid fa-clipboard-check"></i>
                                    {{ trans('frontEndDashboard.complaint_suggestion_register') }}
                                </p>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('incidents')}}">
                                <p class="{{setFont()}}">
                                    <i class="fa-solid fa-person-falling-burst"></i>
                                    {{ trans('frontEndDashboard.incident_register') }}
                                </p>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#statusModal"
                                title="{{ trans('frontEndDashboard.know_status') }}">
                                <p class="{{setFont()}}">
                                    <i class="fa-solid fa-question"></i>
                                    {{ trans('frontEndDashboard.know_status') }}
                                </p>
                            </a>
                        </li>
                        @include('frontend.component.statusCheckModal')


                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta__section">
    <div class="custom-container">
        <div class="row">
            <div class="col-lg-2">

                <h2 class="section__title {{setFont()}}">
                    {{trans('frontEndDashboard.speech')}}
                </h2>
                <div style="margin-top: 50px;">
                    <div class="action__group">
                        <div class="action__button btn-emergency">
                            <a href="tel:{{@$emergencyContactInfo->number}}">
                                <p>
                                    <img src="{{asset('assets/images/icon5.png')}}" alt="">
                                    <span class="{{setFont()}}">
                                        {{ trans('frontEndDashboard.emer_contact') }}
                                    </span>
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="action__group">
                        <div class="action__button">
                            <a href="{{url('https://mail.nepal.gov.np/')}}" target="_blank">
                                <p class="{{setFont()}}">
                                    <span class="icon">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    {{ trans('frontEndDashboard.emailFacility') }}
                                </p>
                            </a>
                        </div>
                    </div>

                    <div class="action__group">
                        <div class="action__button">
                            <a href="https://newsms.doit.gov.np/" target="_blank">
                                <p class="{{setFont()}}">
                                    <span class="icon">
                                        <i class="fa-solid fa-comment-dots"></i>
                                    </span>
                                    {{ trans('frontEndDashboard.smsFacility') }}
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="videos__section-grid row">
                    <div class="col-lg-6">
                        <div class="video__content">
                            <h2 class="section__title {{setFont()}}">
                                {{trans('frontEndDashboard.speech')}}
                            </h2>

                            <div class="video__content-wrapper">
                                @if(isset($jitsiLiveMeetingStream))

                                <div class="video__slider">
                                    <div class="slider__items">
                                        <div class="live__status">
                                            <span>
                                                <i class="fa-solid fa-video"></i>
                                                LIVE
                                            </span>
                                        </div>

                                        <div class="embed-responsive embed-responsive-16by9">
                                            {!! $jitsiLiveMeetingStream->meeting_iframe !!}

                                        </div>
                                    </div>
                                </div>
                                @else

                                <div class="video__slider">
{{--                                    <div class="slider__items">--}}
{{--                                        <div class="live__status">--}}
{{--                                            <span>--}}
{{--                                                <i class="fa-solid fa-video"></i>--}}
{{--                                                LIVE--}}
{{--                                            </span>--}}
{{--                                        </div>--}}

{{--                                        <div class="embed-responsive embed-responsive-16by9 jitsi-video">--}}

{{--                                            <iframe width="1268" height="713"--}}
{{--                                                src="https://www.youtube.com/embed/cUQo63w0nEs"--}}
{{--                                                title="Outsiders  Nepal - Maila (Official Music Video)" frameborder="0"--}}
{{--                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"--}}
{{--                                                allowfullscreen></iframe>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="slider__item">
                                        <div class="embed-responsive embed-responsive-16by9 jitsi-video">
                                            <iframe width="1268" height="713"
                                                src="https://www.youtube.com/embed/UYT2LkrATV4"
                                                title="Hami - Prajina x Regan (lyrics)" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>

                                <div class="slider__controls">
                                    <button class="arrow_vertical arrow_vertical-prev1">
                                        <span>
                                            <i class="fa-solid fa-chevron-left"></i>
                                        </span>
                                    </button>

                                    <button class="arrow_vertical arrow_vertical-next1">
                                        <span>
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </span>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="video__content">
                            <h2 class="section__title {{setFont()}}">
                                {{trans('frontEndDashboard.news_feed')}}
                            </h2>

                            <div class="news__feed">

                                {!! settingInfo('FPIA') !!}

                                {!! settingInfo('TPIA') !!}
                                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<h2 class="section__title {{setFont()}}">
    {{ trans('frontEndDashboard.report') }}
</h2>
<div class="row" style="margin: 15px">
    <div class="col-md-3">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="appointment">
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="complaint">

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="service_token">

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="meeting">

            </div>
        </div>
    </div>
</div>

<section class="feedback__section lightBlueColor">
    <div class="custom-container">
        <h2 class="section__title {{setFont()}}">
            {{ trans('frontEndDashboard.suggestion_status') }}
        </h2>

        <div class="feedback__section-grid">
            <div class="grid__card">
                <div class="grid__icon">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>

                <div class="grid__details">
                    <h3 class="grid__label {{setFont()}}">
                        <span class="{{setFont()}}">
                            {{@$totalSuggestion}}
                        </span>
                        {{ trans('frontEndDashboard.latest_suggestion_status') }}
                    </h3>
                </div>
            </div>

            <div class="grid__card">
                <div class="grid__icon">
                    <i class="fa-solid fa-person-falling-burst"></i>
                </div>

                <div class="grid__details">
                    <h3 class="grid__label {{setFont()}}">
                        <span class="{{setFont()}}">
                            {{@$totalIncident}}
                        </span>
                        {{ trans('frontEndDashboard.latest_incident_status') }}
                    </h3>
                </div>
            </div>

            <div class="grid__card">
                <div class="grid__icon">
                    <i class="fa-solid fa-comment-dots"></i>
                </div>

                <div class="grid__details">
                    <h3 class="grid__label {{setFont()}}">
                        <span {{setFont()}}>
                            {{@$totalComplaint}}
                        </span>
                        {{ trans('frontEndDashboard.latest_complaint_status') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.chart.dashboardChart')
@include('frontend.component.successModal')
@include('frontend.component.technicalErrorModal')
@include('frontend.component.statusCheckModal')
@include('frontend.component.dataNotFoundModal')
@include('frontend.component.checkRegisterModal')
@endsection