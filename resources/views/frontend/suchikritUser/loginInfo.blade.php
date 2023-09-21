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
                    {{ trans('suchikritFrontEnd.login_information') }}
                </h2>
                @include('frontend.suchikritUser.suchikritUserHeader')
                {!! Form::open([
                   'method' => 'POST',
                   'route' => 'newPasswordUpdate',

                   'autocomplete' => 'off',
               ]) !!}
                <div class="input__grid">

                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="email">
                            {{ trans('suchikritFrontEnd.password') }}
                        </label>
                        {!! Form::password('password',  Request::get('password'), [
                        'autocomplete' => 'off',
                        'id' => 'password',
                         'required',
                       ]) !!}
                        @if ($errors->has('password'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('password') }}
                                </span>
                        @endif
                    </div>

                    <div class="input">
                        <label class=" required {{setFont()}}"
                               for="email">
                            {{ trans('suchikritFrontEnd.confirm_password') }}
                        </label>
                        {!! Form::password('password_confirmation',  Request::get('password_confirmation'), [
                        'autocomplete' => 'off',
                        'id' => 'confirm_password',
                         'required',
                       ]) !!}
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('password_confirmation') }}
                                </span>
                        @endif
                    </div>
                    @if ($errors->has('password') == null)
                        <p style="color: #d22a16; font-size: 14px;" class="{{setFont()}}">
                            {{trans('passwords.password_validation_message')}}
                        </p>
                        <br>
                        &nbsp;<p
                                style="font-size: 15px; color: #0b58a2; font-weight: 600" class="{{setFont()}}">
                            {{ getLan() =='np' ? 'उदाहरण' : 'Example' }} : Ab1$b3wG
                        </p>
                    @endif


                    <div class="button__group span2">
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
    @include('frontend.component.successModal')
    @include('frontend.component.checkDataModal')
@endsection