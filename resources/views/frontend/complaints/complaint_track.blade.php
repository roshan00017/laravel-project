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
                            {{trans('frontendSuggestion.track_complaint.title')}}
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
                    {{trans('frontendSuggestion.track_complaint.title')}}
                </h2>

                {!! Form::open([
                   'method' => 'POST',
                   'url' => 'complaint-status',
                   'autocomplete' => 'off',
               ]) !!}
                <div class="input__grid">
                    <div class="input span2">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{trans('frontendSuggestion.track_complaint.ticket_no')}}
                        </label>
                        {!! Form::text('complaint_no',  Request::get('complaint_no'), [
                           'autocomplete' => 'off',
                           'required'
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
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('frontend.component.dataNotFoundModal')
@endsection