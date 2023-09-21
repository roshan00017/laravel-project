@extends('frontend.layouts.welcome')
<?php $appointmentHelper = new \App\Helpers\AppointmentHelper();
?>
<style>
    .radio-button {
        display: inline-block;
        vertical-align: middle;
        margin-top: 0;
        padding: 0;
        width: 25px;
        height: 25px;
        background: rgb(255, 255, 255);
        border: none;
        cursor: pointer;
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
                <h2 class="section__title {{ setFont() }}">
                    {{trans('frontendSuggestion.complaintinfo.grev_form')}}
                </h2>

                @include('frontend.grievance.complaintHeader')
                {!! Form::open(['route' => 'postComplainer',
                         'autocomplete' => 'off',
                        'method'=>'POST']) !!}
                <div class="input__grid formActive">

                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{trans('appointment.full_name')}}
                        </label>
                        {!! Form::text('name_ne',  @$complaint->name_ne, [
                         'required',
                        'autocomplete' => 'off',
                          'required'
                         ]) !!}
                        @if ($errors->has('name_ne'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('name_ne') }}
                                </span>
                        @endif
                    </div>

                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{trans('appointment.address')}}
                        </label>
                        {!! Form::text('tole',  @$complaint->tole, [
                         'required',
                        'autocomplete' => 'off',
                          'required'
                         ]) !!}
                          @if ($errors->has('tole'))
                          <span class="text-danger {{setFont()}}">
                                  {{ $errors->first('tole') }}
                              </span>
                      @endif 
                    </div>

                    <div class="input">
                        <label class=" {{ setFont() }}" for="type">
                            {{trans('appointment.email')}}
                        </label>
                        {!! Form::email('email',  @$complaint->email, [
                         '',
                        'autocomplete' => 'off',
                          ''
                         ]) !!}
                         @if ($errors->has('email'))
                         <span class="text-danger {{setFont()}}">
                                 {{ $errors->first('email') }}
                             </span>
                     @endif  
                    </div>

                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{trans('appointment.mobile_no')}}
                        </label>
                        {!! Form::text('mobile_no',  @$complaint->mobile_no, [
                         'required',
                        'class'=>'mobileNo',
                        'autocomplete' => 'off',
                          'required'
                         ]) !!}
                          @if ($errors->has('mobile_no'))
                          <span class="text-danger {{setFont()}}">
                                  {{ $errors->first('mobile_no') }}
                              </span>
                      @endif
                    </div>
                    <div class="input span2">
                        <h2 style="color: #333; font-size: 20px;" class="{{setFont()}}">
                            {{ trans('frontendSuggestion.complainer.person_detail_question') }}
                        </h2>
                    </div>
                    <div>
                        <p style="color: #666; font-size: 16px;" class="{{setFont()}}">
                            {{ trans('frontendSuggestion.complainer.help_text') }}
                        </p>
                    </div>
                    <div class="{{setFont()}}">
                        <input
                                class="radio-button"
                                type="radio"
                                name="show_personal_info"
                                value="1" id="show_personal_info"
                                @if(@$complaint->show_personal_info ==1)
                                checked
                                @endif
                        >
                        {{ trans('frontendSuggestion.complainer.show_personal_info') }}
                        &nbsp; &nbsp;
                        <input class="radio-button"
                               type="radio" name="show_personal_info"
                               value="0" id="hide_personal_info"
                               @if(@$complaint->show_personal_info !=null)
                               @if(@$complaint->show_personal_info ==0)
                               checked
                                @endif
                                @endif
                        >
                        {{ trans('frontendSuggestion.complainer.hide_personal_info') }}
                    </div>

                    <div class="button__group span2">
                        <a href="{{route('complaint-info')}}"
                           class="submit__btn form-prev">
                                        <span class="{{setFont()}}">
                                            <i class="fa-solid fa-chevron-left"></i>
                                          {{trans('appointment.previous')}}
                                        </span>
                        </a>
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
@endsection
