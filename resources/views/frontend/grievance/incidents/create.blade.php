@extends('frontend.layouts.welcome')


<body onload="geoFindMe()">
<link rel="stylesheet" href="{{ secure_asset('css/theme.css') }}"/>

@section('content')
    <section class="breadcrumbs">
        <div class="custom-container">
            <nav class="breadcrumbs__nav">
                <ul class="breadcrumbs__nav-menu">
                    <li>
                        <a href="{{url('/')}}"
                           class="breadcrumb__link {{setFont()}}">
                            <i class="fa-solid fa-home"></i>
                            {{ trans('frontendSuggestion.suggestion.home_page') }}
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0)"
                           class="breadcrumb__link {{setFont()}}">
                            {{ trans('frontendSuggestion.incidents.incident_register') }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <div class="form__section">
        <div class="custom-container">
            <div class="form__section-content">
                <h2 class="section__title {{setFont()}}">
                    {{ trans('frontendSuggestion.incidents.submit_incident') }}
                </h2>

                {!! Form::open([
                   'method' => 'POST',
                   'route' => 'incidentLocation.store',
                   'enctype' => 'multipart/form-data',
                   'autocomplete' => 'off',
               ]) !!}
                <div class="input__grid">
                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('frontendSuggestion.suggestion.name') }}
                        </label>
                        {!! Form::text('name',  Request::get('name'), [
                           'autocomplete' => 'off',
                           'required'
                        ]) !!}

                        @if ($errors->has('name'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('name') }}
                                </span>
                        @endif
                    </div>

                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="mobile-number">
                            {{ trans('frontendSuggestion.suggestion.mobile_no') }}
                        </label>


                        {!! Form::text('mobile',  Request::get('mobile'), [
                         'autocomplete' => 'off',
                         'required',
                         'id'=>'mobile',
                        ]) !!}
                        @if ($errors->has('mobile'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('mobile') }}
                                </span>
                        @endif 
                    </div>

                    <div class="input">
                        <label class="{{setFont()}}"
                               for="email">
                            {{ trans('frontendSuggestion.suggestion.email') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
            
                        {!! Form::email('email',  Request::get('email'), [
                        'autocomplete' => 'off',
                       ]) !!}
                        @if ($errors->has('email'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('email') }}
                                </span>
                        @endif
                    </div>

                    <div class="input">
                        <label class=" required {{setFont()}}"
                               for="email">
                            {{ trans('frontendSuggestion.incidents.title') }}
                        </label>
                        {!! Form::text('title',  Request::get('title'), [
                        'autocomplete' => 'off',
                        'required'
                       ]) !!}
                        @if ($errors->has('title'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('title') }}
                                </span>
                        @endif
                    </div>


                    <div class="input span2">
                        <label class="required {{setFont()}}"
                               for="description">
                            {{trans('frontendSuggestion.suggestion.document')}}
                        </label>
                        {!! Form::textarea('description', Request::get('description'), [
                         'rows' => '4',
                         'autocomplete' => 'off',
                     ]) !!}
                        @if ($errors->has('description'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('description') }}
                                </span>
                        @endif
                    </div>

                    <div class="input span2">
                        <label class="{{setFont()}}"
                               for="phone-upload">
                            {{trans('frontendSuggestion.suggestion.file_upload')}}
                        </label>
                        <div class="photo__uploader">
                            <input type="file" 
                            id="imageUploadInput"
                            class="File"
                             name="file" 
                             onchange="previewFile()"
                             accept=".JPG, .PNG, .JPEG, .PDF, .jpg, .png, .jpeg"  
                             value="{{{ @$incident->files ?? '' }}}"
                             onchange="previewFile(this)"
                             />
                            <button id="uploadToggler" type="button">
                                <span class="{{setFont()}}">
                                    <i class="fa-solid fa-photo-film"></i>
                                </span>
                            </button>
                            <span class="requirements {{setFont()}}">
                            </span>
                            <img id="imagePreview" src="#" alt="Uploaded File"
                                 style="display: none; max-width: 27%; max-height: 100px;"/>
                            <span id="pdfFileName" style="display: none;"></span>
                            @if ($errors->has('suggestion_file'))
    <div class="alert alert-danger">
        {{ $errors->first('suggestion_file') }}
    </div>
@endif
             
                        </div>
                        
                    </div>


                    <div class="input" style="display: none;">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('frontendSuggestion.incidents.longitude') }}
                        </label>
                        {!! Form::text('longitude',  Request::get('longitude'), [
                           'autocomplete' => 'off',
                           'readonly',
                           'required',
                           'id'=>'longitude',
                           'name'=>'longitude'
                        ]) !!}
                    
                        @if ($errors->has('name'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('name') }}
                                </span>
                        @endif
                    </div>
                    <div class="input" style="display: none;">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('frontendSuggestion.incidents.latitude') }}
                        </label>
                        {!! Form::text('latitude',  Request::get('latitude'), [
                            'autocomplete' => 'off',
                            'readonly',
                            'required',
                            'id'=>'latitude',
                            'name'=>'latitude'
                         ]) !!}

                        @if ($errors->has('name'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('name') }}
                                </span>
                        @endif
                    </div>

                    <div class="button__group span2">
                        <button type="submit"
                                class="submit__btn">
                                    <span class="{{setFont()}}">
                                    {{ trans('frontendSuggestion.suggestion.sent_file') }}
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </span>
                        </button>
                    </div>

                    <div class="input span2">
                        <label class="{{setFont()}}"
                               for="description"
                        >
                            {{ trans('frontendSuggestion.incidents.location_map') }}
                        </label>
                        <div id="mapImage" style="width: 100%;height: 450px">

                        </div>
                        <p id="status"></p>
                        <a id="map-link" target="_blank"></a>
                        <br>
                        <a id="addr-link"
                           target="_blank"
                           class="{{setFont()}}">{{ trans('frontendSuggestion.incidents.show_address_details') }}</a>

                    </div>


                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('frontend.component.checkDataModal')
@endsection