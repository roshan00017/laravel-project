@extends('frontend.layouts.welcome')
<?php $appointmentHelper = new \App\Helpers\AppointmentHelper();
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
                        <a href="{{ url('/') }}" class="breadcrumb__link {{ setFont() }}">
                            <i class="fa-solid fa-home"></i>
                            {{ trans('frontendSuggestion.suggestion.home_page') }}
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0)" class="breadcrumb__link {{ setFont() }}">
                            {{ $page_title }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <div class="form__section">
        <div class="custom-container">
            <div class="form__section-content">
                <h2 class="section__title {{ setFont() }}">
                    {{ trans('appointment.personal_details') }}
                </h2>

                @include('frontend.appointment.appointment-header')
                {!! Form::open(['route' => 'personalInfo', 'method' => 'POST']) !!}
                <div class="input__grid formActive">
                    @include('frontend.appointment.personal-info-search')
                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.full_name') }}
                        </label>
                        {!! Form::text('name', @$aptInfo->name, ['required', 'autocomplete' => 'off', 'id' => 'name', 'required']) !!}
                        @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            {{ $errors->first('name') }}
                        </div>
                        @endif
                    </div>


                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.address') }}
                        </label>
                        {!! Form::text('address_info', @$aptInfo->address_info, [
                            'autocomplete' => 'off',
                            'id' => 'address',
                            'required',
                        ]) !!}
                         @if ($errors->has('address_info'))
                         <div class="alert alert-danger">
                             {{ $errors->first('address_info') }}
                         </div>
                         @endif
                    </div>

                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.email') }}
                        </label>
                        {!! Form::email('email_address', @$aptInfo->email_address, [
                            'autocomplete' => 'off',
                            'id' => 'email',
                            'required',
                        ]) !!}
                         @if ($errors->has('email_address'))
                         <div class="alert alert-danger">
                             {{ $errors->first('email_address') }}
                         </div>
                         @endif
                    </div>

                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.mobile_no') }}
                        </label>
                        {!! Form::text('mobile', @$aptInfo->mobile, [
                            'class' => 'mobileNo',
                            'autocomplete' => 'off',
                            'id' => 'mobile',
                            'required',
                        ]) !!}
                         @if ($errors->has('mobile'))
                         <div class="alert alert-danger">
                             {{ $errors->first('mobile') }}
                         </div>
                         @endif
                    </div>


                    <div class="button__group span2">
                        <a href="{{ route('appointment-info') }}" class="submit__btn form-prev">
                            <span class="{{ setFont() }}">
                                <i class="fa-solid fa-chevron-left"></i>
                                {{ trans('appointment.previous') }}
                            </span>
                        </a>

                        <button type="submit" class="submit__btn form-next {{ setFont() }}">
                            <span class="{{ setFont() }}">
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
    @include('frontend.component.checkDataModal')
@endsection
