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
                        {{ @$page_title }}
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<section class="inner__title">
    <div class="custom-container">
        <div class="inner__title-content">
{{--            <h1 class="content__title {{ setFont() }}">--}}
{{--                {{ $page_title }}--}}
{{--            </h1>--}}

            <p class="content__desc {{ setFont() }}">
                {{ __('frontEndDashboard.Citizen_Charter_info') }}
            </p>

            <div>
                <button class="btn btn-primary float-md-right {{setFont()}} mt-2" style="color: white"
                    data-toggle="modal" data-target="#tokenStatusTrack"
                    title="{{trans('frontEndAppointment.appointment_statusw')}}">
                    <i class="fa fa-question"> </i> {{ trans('dccFrontEnd.dcc.status') }}

                </button>
            </div>
        </div>
    </div>
</section>

{{--    <section class="summary__section"> --}}
{{--        <div class="custom-container"> --}}
{{--            <h2 class="section__title {{setFont()}}"> --}}
{{--                {{ trans('frontEndDashboard.report') }} --}}
{{--            </h2> --}}

{{--            <div class="summary__section-grid two__column-grid"> --}}
{{--                <div class="grid__chart"> --}}
{{--                    <div id="service_token"> --}}

{{--                    </div> --}}
{{--                </div> --}}
{{--            </div> --}}
{{--        </div> --}}
{{--    </section> --}}
<div class="tables__section">
    <div class="custom-container">
        <div class="table__grid">
            <div class="table__responsive">
                <table class="left__table">
                    <thead>
                        <tr>
                            <th class="{{ setFont() }}">
                                {{ trans('dccFrontEnd.dcc.services') }}
                            </th>
                            <th class="{{ setFont() }}">
                                {{ trans('dccFrontEnd.dcc.documents') }}
                            </th>
                            <th class="{{ setFont() }}">
                                {{ trans('dccFrontEnd.dcc.service_rate') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $key => $data)
                        <tr>
                            <td class="{{ setFont() }}">
                                {{ getLan() == 'np' ? $data->name_np : $data->name_en }}
                            </td>
                            <?php
$results = $serviceDocumentRepo->getDocument(@$data->id);
?>
                            @if (sizeof($results) > 0)
                            @foreach ($results as $value)
                            <td class="{{ setFont() }}">
                                {{ getLan() == 'np' ? $value->document_detail_np : $value->document_detail_en }}
                            </td>

                            <td class="{{ setFont() }}">
                                {{ $value->service_rate }}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card shadow p-2 mb-4 bg-white rounded">
                <div id="service_token">

                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.component.dataNotFoundModal')
@include('frontend.chart.dccChart')
@include('frontend.innerPage.dccInfo-track-modal')
@include('frontend.innerPage.dccInfo-status-modal')

@endsection