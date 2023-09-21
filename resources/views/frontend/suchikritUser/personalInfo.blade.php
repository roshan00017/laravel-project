@extends('frontend.layouts.welcome')
<?php $aptInfoHelper = new \App\Helpers\AppointmentHelper();
?>
<style>
    .select2-selection__rendered {
        line-height: 48px !important;
    }

    .select2-search__field {
        height: 44px !important;
    }

    .select2-selection__arrow b {
        top: 84% !important;
    }
</style>
@section('content')
    <section class="breadcrumbs">
        <div class="custom-container">
            <nav class="breadcrumbs__nav">
                <ul class="breadcrumbs__nav-menu">
                    <li>
                        <a href="{{url('/')}}" class="breadcrumb__link {{ setFont() }}">
                            <i class="fa-solid fa-home"></i>
                            {{ trans('frontendSuggestion.suggestion.home_page') }}
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0)" class="breadcrumb__link {{ setFont() }}">
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
                <h2 class="section__title {{ setFont() }}">
                    {{ trans('suchikritFrontEnd.personal_information') }}
                </h2>

                @include('frontend.suchikritUser.suchikritUserHeader')
                {!! Form::open(['route' => 'suchikrit.store','method'=>'POST','class' => 'addFrom']) !!}
                <div class="input__grid formActive">


                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('suchikritFrontEnd.full_name_np') }}
                        </label>
                        {!! Form::text('full_name_np',  @$suchitkritUserInfo->full_name_np, [
                           'autocomplete' => 'off',
                           'required'
                        ]) !!}

                        @if ($errors->has('full_name_np'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('full_name_np') }}
                                </span>
                        @endif
                    </div>


                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('suchikritFrontEnd.full_name_en') }}
                        </label>
                        {!! Form::text('full_name_en',  @$suchitkritUserInfo->full_name_en, [
                           'autocomplete' => 'off',
                           'required'
                        ]) !!}

                        @if ($errors->has('full_name_en'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('full_name_en') }}
                                </span>
                        @endif
                    </div>

                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="mobile-number">
                            {{ trans('frontendSuggestion.suggestion.mobile_no') }}
                        </label>

                        {!! Form::text('mobile_no',  @$suchitkritUserInfo->mobile_no, [
                         'autocomplete' => 'off',
                         'id'=>'mobile',
                         'required',
                        ]) !!}
                        @if ($errors->has('mobile_no'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('mobile_no') }}
                                </span>
                        @endif
                    </div>

                    <div class="input">
                        <label class="{{setFont()}}"
                               for="email">
                            {{ trans('frontendSuggestion.suggestion.email') }}
                        </label>
                        {!! Form::email('email',  @$suchitkritUserInfo->email, [
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
                        <button
                                type="submit"
                                class="submit__btn form-next"
                        >
                                <span class="{{setFont()}}">
                                        {{ trans('appointment.next') }}
                                   <i class="fa-solid fa-chevron-right"></i>
                                </span>
                        </button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
    @include('frontend.component.submitModal')
    @include('frontend.component.checkDataModal')
    @include('frontend.component.successModal')
@endsection
