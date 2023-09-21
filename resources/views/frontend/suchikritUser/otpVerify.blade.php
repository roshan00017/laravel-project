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
                            {{$page_title}}
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
                    {{ getLan() =='np' ? 'OTP प्रमाणिकरण ' : 'OTP Confirmation' }}

                </h2>
                @include('frontend.suchikritUser.suchikritUserHeader')
                {!! Form::open([
                    'method' => 'POST',
                    'url' => 'otpVerify', // Use the correct route name here
                    'autocomplete' => 'off',
                 ]) !!}
                <div class="input__grid">

                    <div class="input span2">
                        <label class="required {{setFont()}}"
                               for="mobile-number">
                            {{ trans('suchikritFrontEnd.otp_code') }}
                        </label>

                        {!! Form::number('otp_code',  Request::get('otp_code'), [
                         'autocomplete' => 'off',
                         'id'=>'otp_code',
                         'min'=>'1',
                         'required',
                        ]) !!}
                        @if ($errors->has('otp_code'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('otp_code') }}
                                </span>
                        @endif
                    </div>


                    <div class="button__group span2">
                        <button
                                type="submit"
                                class="submit__btn form-next {{ setFont() }}"
                                id="btn-add"
                        >
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
    @include('frontend.component.successModal')
    @include('frontend.component.checkDataModal')
    @include('frontend.component.technicalErrorModal')
@endsection