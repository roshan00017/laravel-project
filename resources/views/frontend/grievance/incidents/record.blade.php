@extends('frontend.layout.welcome')

<body onload="geoFindMe()">
    <link rel="stylesheet" href="{{ secure_asset('css/theme.css') }}" />
    @section('content')
    <div class="container-fluid shadow-sm">
        <div class="row">
            <div class="col-md-12">
                <section class="report-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-title">
                                    <h3>
                                        {{ trans('frontendSuggestion.incidents.submit_incident') }}
                                    </h3>
                                </div>
                                <div class="form-cotent">
                                    <!-- FORM -->
                                    <form method="POST" action="{{ route('incidentLocation.store') }}"
                                        enctype="multipart/form-data" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="form-group">
                                            <label for="name"> {{ trans('frontendSuggestion.incidents.name') }}:
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                            <div class="invalid-feedback">
                                                {{ trans('frontendSuggestion.incidents.name_compulsory') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="mobile">{{ trans('frontendSuggestion.incidents.mobile') }}:</label>
                                            <input type="text"
                                                class="form-control {{ trans('frontendSuggestion.incidents.engtext')}}"
                                                pattern="^9\d{9}$" id="mobile" name="mobile">
                                            <div class="invalid-feedback">
                                                {{ trans('frontendSuggestion.incidents.mobile_compulsory') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="email">{{ trans('frontendSuggestion.incidents.email') }}:</label>
                                            <input type="email" class="form-control eng_text" id="email" name="email">
                                            <div class="invalid-feedback">
                                                {{ trans('frontendSuggestion.incidents.email_compulsory') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">{{ trans('frontendSuggestion.incidents.title') }}:
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="title" name="title">
                                            <div class="invalid-feedback">
                                                {{ trans('frontendSuggestion.incidents.title_compulsory') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="description">{{ trans('frontendSuggestion.incidents.description') }}:
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="description" name="description" rows="5"
                                                required></textarea>
                                            <div class="invalid-feedback">
                                                {{ trans('frontendSuggestion.incidents.desc_compulsory') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="file">{{ trans('frontendSuggestion.incidents.file_upload') }}:</label>
                                            <input type="file" class="form-control" name="file" value="" />
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="longitude">{{ trans('frontendSuggestion.incidents.longitude') }}:</label>
                                            <input type="text"
                                                class="form-control {{ trans('frontendSuggestion.incidents.engtext')}}"
                                                id="longitude" name="longitude" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="latitude">{{ trans('frontendSuggestion.incidents.latitude') }}:</label>
                                            <input type="text"
                                                class="form-control {{ trans('frontendSuggestion.incidents.engtext')}}"
                                                id="latitude" name="latitude" readonly>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary formSubmitBtn">{{ trans('frontendSuggestion.incidents.submit') }}
                                            &nbsp;<i class="fa-solid fa-paper-plane"></i></button>

                                    </form>
                                    <!-- Maps -->

                                    <div class="mt-4">

                                        <h3>{{ trans('frontendSuggestion.incidents.location_map') }}</h3>
                                        <div id="mapImage"></div>
                                        <p id="status"></p>
                                        <a id="map-link" target="_blank"></a>
                                        <br>
                                        <a id="addr-link"
                                            target="_blank">{{ trans('frontendSuggestion.incidents.show_address_details') }}</a>

                                    </div> <!-- maps -->
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @endsection