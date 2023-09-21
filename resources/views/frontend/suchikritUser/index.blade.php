@extends('frontend.layouts.welcome')
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
                            {{ trans('frontendSuggestion.suggestion.your_suggestion') }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <div class="form__section">
        <div class="custom-container">
            <div class="form__section-content">
            <div class="button__group span2">
                <a href="{{url('sulogin')}}" class="btn btn-primary float-right" style="color: white">
                    <span
                            class=" {{setFont()}}"
                            style="color: white;"
                    >
                        {{trans('frontendSuggestion.suggestion.button')}}
                    </span>
                </a>
            </div>

                <h2 class="section__title {{setFont()}}">
                    {{ trans('frontendSuggestion.suggestion.suchikirit') }}
                </h2>

                {!! Form::open([
                   'method' => 'POST',
                   'route' => 'suchikrit.store',
                  
                   'autocomplete' => 'off',
               ]) !!}
                <div class="input__grid">
                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('frontendSuggestion.suggestion.full_name_np') }}
                        </label>
                        {!! Form::text('full_name_np',  Request::get('full_name_np'), [
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
                               for="full-name">
                            {{ trans('frontendSuggestion.suggestion.full_name_en') }}
                        </label>
                        {!! Form::text('full_name_en',  Request::get('full_name_en'), [
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
                         'id'=>'mobile',
                         'required',
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
                        </label>
                        {!! Form::email('email',  Request::get('email'), [
                        'autocomplete' => 'off',
                        'id' => 'email',
                       ]) !!}
                        @if ($errors->has('email'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('email') }}
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
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('frontend.component.successModal')
    @include('frontend.component.checkDataModal')
@endsection