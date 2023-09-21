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
{{--            <h4 class="content__title {{setFont()}}">--}}
{{--                {{$page_title}}--}}
{{--            </h4>--}}

            <p class="content__desc {{setFont()}}">
                {{ __('frontEndDashboard.msg') }}
            </p>
        </div>
    </div>
</section>
<hr>

<h2 class="section__title {{setFont()}}">
    {{ trans('frontEndDashboard.report') }}
</h2>

<div class="row" style="margin: 15px; ">
    <div class="col-md-6">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="dispatch">
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="register">

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            <div id="appointment">

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-2 mb-4 bg-white rounded">
            @include('frontend.calendar.index')
        </div>
    </div>
</div>

@include('frontend.chart.officeAutomationChart')
@endsection
