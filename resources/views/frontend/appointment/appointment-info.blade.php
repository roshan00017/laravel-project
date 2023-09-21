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
                    {{ trans('appointment.visiting_details') }}
                </h2>

                @include('frontend.appointment.appointment-header')
                {!! Form::open(['route' => 'appointmentInfo', 'method' => 'POST']) !!}
                <div class="input__grid formActive">
                    @if (getLan() == 'np')
                        <div class="input">
                            <label class="required {{ setFont() }}" for="type">
                                {{ trans('appointment.appointment_date') }}
                            </label>
                            @if (isset($request->date_np))
                                {!! Form::text('date_bs', $request->date_np, [
                                    'placeholder' => trans('appointment.visiting_date_bs'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'readonly',
                                ]) !!}
                            @else
                                {!! Form::text('date_bs', @$aptInfo->date_bs, [
                                    'placeholder' => trans('appointment.visiting_date_bs'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'readonly',
                                ]) !!}
                            @endif
                        </div>
                    @else
                        <div class="input">
                            <label class="required {{ setFont() }}" for="type">
                                {{ trans('appointment.appointment_date') }}
                            </label>
                            @if (isset($request->date_en))
                                {!! Form::text('date_ad', $request->date_en, [
                                    'placeholder' => trans('appointment.visiting_date_ad'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'readonly' => true,
                                ]) !!}
                            @else
                                {!! Form::text('date_ad', @$aptInfo->date_ad, [
                                    'placeholder' => trans('appointment.visiting_date_ad'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'readonly' => true,
                                ]) !!}
                            @endif
                        </div>
                    @endif

                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.visiting_time') }}
                        </label>
                        {{ Form::time('appointment_time', @$aptInfo->appointment_time, [
                            'style' => 'width: 100%',
                            'required',
                            'placeholder' => trans('meeting.meeting.time'),
                        ]) }}
                        @if ($errors->has('appointment_time'))
                        <div class="alert alert-danger">
                            {{ $errors->first('appointment_time') }}
                        </div>
                        @endif 
                    </div>

                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.visiting_department') }}
                        </label>
                        {!! Form::select('appointment_section', appointmentDepartment(), @$aptInfo->appointment_section, [
                            'class' => 'form-control select2',
                            'id' => 'department',
                            'placeholder' => trans('appointment.select_visiting_department'),
                        ]) !!}
                         @if ($errors->has('appointment_section'))
                         <div class="alert alert-danger">
                             {{ $errors->first('appointment_section') }}
                         </div>
                         @endif 
                    </div>
                    {{-- OFFICE_PERSON---HR-DESIGNATION --}}
                    <div class="input" style="@if (@$aptInfo->visiting_to_emp_designation != null && @$aptInfo->appointment_section == 'om') display: block @else display: none @endif"
                        id="postBlock_office">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.post') }}
                        </label>
                        {!! Form::select(
                            'appointment_to_emp_designation',
                            $hrDesignationList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                            @$aptInfo->appointment_to_emp_designation,
                            [
                                'class' => 'form-control select2',
                                'id' => 'employee_designation',
                                'style' => 'width:100%',
                                'placeholder' => trans('appointment.select_post'),
                            ],
                        ) !!}
                        @if ($errors->has('appointment_to_emp_designation'))
                        <div class="alert alert-danger">
                            {{ $errors->first('appointment_to_emp_designation') }}
                        </div>
                        @endif
                    </div>

                    {{-- ELECTED_PERSON --MEMBER_TYPE --}}
                    <div class="input" style="@if (@$aptInfo->appointment_to_elected_designation != null && @$aptInfo->appointment_section == 'km') display: block @else display: none @endif"
                        id="postBlock_elected">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.post') }}
                        </label>
                        {!! Form::select(
                            'appointment_to_elected_designation',
                            $memberTypeList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                            @$aptInfo->appointment_to_elected_designation,
                            [
                                'class' => 'form-control select2',
                                'id' => 'elected_designation',
                                'style' => 'width:100%',
                                'placeholder' => trans('appointment.select_post'),
                            ],
                        ) !!}
                         @if ($errors->has('appointment_to_elected_designation'))
                         <div class="alert alert-danger">
                             {{ $errors->first('appointment_to_elected_designation') }}
                         </div>
                         @endif
                    </div>

                    {{-- EMPLOYEE_LIST --}}
                    <div class="input" id="employeeBlock"
                        style="@if (@$aptInfo->appointment_section == 'om' && @$aptInfo->employee_id != null) display :block @else display:none @endif">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.employee') }}
                        </label>
                        @if (@$aptInfo->emp_id != null)
                            {!! Form::select(
                                'emp_id',
                                $aptInfoHelper->getEmployeeByDesId(@$aptInfo->appointment_to_emp_designation),
                                @$aptInfo->emp_id,
                                [
                                    'class' => 'form-control select2',
                                    'id' => 'employee_id',
                                    'placeholder' => trans('appointment.select_employee'),
                                    'style' => 'width:100%',
                                ],
                            ) !!}
                        @else
                            <select class='form-control select2' name='emp_id' id='employee_id' style="width: 100%">
                                <option class='form control' value=''>
                                    {{ trans('appointment.select_employee') }}
                                </option>
                            </select>
                        @endif
                    </div>

                    {{-- ELECTED_PERSON_LIST --}}
                    <div class="input" id="electedPersonBlock"
                        style="@if (@$aptInfo->appointment_section == 'km' && @$aptInfo->elected_person_id != null) display :block @else display:none @endif">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.elected_person') }}
                        </label>
                        @if (@$aptInfo->ep_id != null)
                            {!! Form::select(
                                'ep_id',
                                $aptInfoHelper->getElectedPersonByDesId(@$aptInfo->appointment_to_elected_designation),
                                @$aptInfo->ep_id,
                                [
                                    'class' => 'form-control select2',
                                    'id' => 'elected_person_id',
                                    'style' => 'width:100%',
                                    'placeholder' => trans('appointment.select_elected_person'),
                                ],
                            ) !!}
                        @else
                            <select class='form-control select2' name='ep_id' id='elected_person_id' style="width: 100%">
                                <option value=''>
                                    {{ trans('appointment.select_elected_person') }}
                                </option>
                            </select>
                        @endif
                    </div>

                    <div class="input">
                        <label class="required {{ setFont() }}" for="type">
                            {{ trans('appointment.visiting_purpose') }}
                        </label>
                        {!! Form::select(
                            'appointment_purpose_id',
                            $visitingPurposeList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                            @$aptInfo->appointment_purpose_id,
                            [
                                'class' => 'form-control select2',
                                'placeholder' => trans('appointment.select_visiting_purpose'),
                            ],
                        ) !!}
                    </div>
                    <div class="input span2">
                        <label class=" {{ setFont() }}" for="type">
                            {{ trans('appointment.other_reason') }}
                        </label>
                        {!! Form::textarea('appointment_purpose_reason', @$aptInfo->appointment_purpose_reason, [
                            'rows' => '4',
                            'autocomplete' => 'off',
                        ]) !!}
                    </div>


                    <div class="button__group span2">
                        <a href="{{ route('appointment-schedule') }}" class="submit__btn form-prev">
                            <span class="{{ setFont() }}">
                                <i class="fa-solid fa-chevron-left"></i>
                                {{ trans('appointment.previous') }}
                            </span>
                        </a>
                        <button type="submit" class="submit__btn form-next">
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
@endsection
