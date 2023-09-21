@extends('frontend.layouts.welcome')
@section('content')


<section class="breadcrumbs">
    <div class="custom-container">
        <nav class="breadcrumbs__nav">
            <ul class="breadcrumbs__nav-menu">
                <li>
                    <a href="{{url('/')}}" class="breadcrumb__link {{setFont()}}">
                        <i class="fa-solid fa-home"></i>
                        {{ trans('frontendSuggestion.suggestion.home_page') }}
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)" class="breadcrumb__link {{setFont()}}">
                        {{@$page_title}}
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<section class="inner__title">
    <div class="custom-container">
        <div class="inner__title-content">
{{--            <h1 class="content__title {{setFont()}}">--}}
{{--                {{$page_title}}--}}
{{--            </h1>--}}

            <p class="content__desc {{setFont()}}">
                {{ __('frontEndDashboard.complaints') }}
            </p>
        </div>
    </div>
</section>


<section class="domain__section">
    <div class="custom-container">
        <div class="row" style="margin-bottom: 60px">
            <div class="col-md-9" style="margin-bottom: 30px" >
                <h2 class="section__title {{setFont()}}" >
                    {{ trans('frontendSuggestion.complaintinfo.grevience_medium') }}
                </h2>

                <ul class="social__icons-menu" style="margin-top: 30px">
                    <li>
                        <a href="{{settingInfo('FB')}}" target="_blank" class="social__link">
                            <span class="icon facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{settingInfo('WU')}}" target="_blank" class="social__link">
                            <span class="icon online">
                                <i class="fa-solid fa-globe"></i>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{settingInfo('TW')}}" target="_blank" class="social__link">
                            <span class="icon twitter">
                                <i class="fa-brands fa-twitter"></i>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{settingInfo('PH')}}" target="_blank" class="social__link">
                            <span class="icon">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{settingInfo('WS')}}" target="_blank" class="social__link">
                            <span class="icon whatsapp">
                                <i class="fa-brands fa-whatsapp"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3 grid__card1">
                <div class="grid-list">
                    <p class="other-service">
                        <b class="font_white {{setFont()}}">
                            {{ trans('frontEndDashboard.other_services') }}
                        </b>
                    </p>
                    <ul>
                    <li>
                            <a
                                    href="javascript:void(0)"
                                    data-toggle="modal"
                                    data-target="#registerModal"
                                    title="{{ trans('frontEndDashboard.complaint_suggestion_register') }}"
                            >
                                <p class="{{setFont()}}">
                                    <i class="fa-solid fa-clipboard-check"></i>
                                    {{ trans('frontEndDashboard.complaint_suggestion_register') }}
                                </p>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('complaint-status')}}">
                                <p class="{{setFont()}}">
                                    <i class="fa-solid fa-question"></i>
                                    {{ trans('frontEndDashboard.complaint_status') }}
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<h2 class="section__title {{setFont()}}">
    {{ trans('frontEndDashboard.report') }}
</h2>

<div class="row" style="margin: 15px">
    <div class="col-md-6">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="complaint">
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="complaintBySource">

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="suggestion">

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="incident">

            </div>
        </div>
    </div>
</div>

{{--<section class="social__media">--}}
{{--    <div class="custom-container">--}}
{{--        <div class="social__media-grid">--}}
{{--            <h2 class="section__title {{setFont()}}">--}}
{{--                सम्पर्क--}}
{{--            </h2>--}}

{{--            <ul class="social__icons-menu">--}}
{{--                <li>--}}
{{--                    <a href="{{settingInfo('FB')}}" target="_blank" class="social__link">--}}
{{--                        <span class="icon facebook">--}}
{{--                            <i class="fa-brands fa-facebook-f"></i>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{settingInfo('WU')}}" target="_blank" class="social__link">--}}
{{--                        <span class="icon online">--}}
{{--                            <i class="fa-solid fa-globe"></i>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{settingInfo('TW')}}" target="_blank" class="social__link">--}}
{{--                        <span class="icon twitter">--}}
{{--                            <i class="fa-brands fa-twitter"></i>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{settingInfo('SK')}}" target="_blank" class="social__link">--}}
{{--                        <span class="icon skype">--}}
{{--                            <i class="fa-brands fa-skype"></i>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{settingInfo('PH')}}" target="_blank" class="social__link">--}}
{{--                        <span class="icon">--}}
{{--                            <i class="fa-solid fa-phone"></i>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{settingInfo('MS')}}" target="_blank" class="social__link">--}}
{{--                        <span class="icon message">--}}
{{--                            <i class="fa-solid fa-comment-dots"></i>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{settingInfo('WS')}}" target="_blank" class="social__link">--}}
{{--                        <span class="icon whatsapp">--}}
{{--                            <i class="fa-brands fa-whatsapp"></i>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{settingInfo('INS')}}" target="_blank" class="social__link">--}}
{{--                        <span class="icon instagram">--}}
{{--                            <i class="fa-brands fa-instagram"></i>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{settingInfo('TK')}}" target="_blank" class="social__link">--}}
{{--                        <span class="icon instagram">--}}
{{--                            <i class="fa-brands fa-tiktok"></i>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

@include('frontend.chart.complaintChart')
@include('frontend.component.checkRegisterModal')

@endsection
