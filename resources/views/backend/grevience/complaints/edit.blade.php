@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                            {{ trans('complaints.page_title') }}

                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right {{ setFont() }}">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    {{ trans('message.dashboard.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ url($page_url) }}">
                                    {{ $page_title }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{ trans('message.commons.add') }}
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')
            @php
                $data = $value;
            @endphp
            <div class="container-fluid">
                {!! Form::model($data, [
                    'method' => 'PUT',
                    'route' => [$page_route . '.' . 'update', $data->id],
                    'enctype' => 'multipart/form-data',
                    'autocomplete' => 'off',
                ]) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="{{ setFont() }}">
                                    <strong>{{ trans('complaints.detail') }}</strong>
                                </h5>
                                <hr style="width: 100%">
                                <label for="inputName" class=" pl-3 {{ setFont() }}" style="margin-top: 10px">
                                    {{ trans('complaints.mention_type') }}
                                </label> &nbsp;

                                @if ($value->disclose_complainer_info != null)
                                    <input name="disclose_complainer_info" class="radio-button" type="checkbox"
                                        id="checkbox1" value="true" checked />
                                @else
                                    <input name="disclose_complainer_info" class="radio-button" type="checkbox"
                                        id="checkbox1" value="false" />
                                @endif
                            </div>


                            <div class=" form-group row autoUpdate p-3 {{ setFont() }}"
                                style="@if ($value->disclose_complainer_info != null) display:none @endif ">

                                <div class="form-group col-md-4 ">
                                    <label for="inputName">
                                        {{ trans('message.pages.common.name_en') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('name_en', null, [
                                        'class' => 'form-control',
                                        'placeholder' => trans('message.pages.common.name_en'),
                                        'autocomplete' => 'off',
                                    ]) !!}
                                    {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputName">
                                        {{ trans('message.pages.common.name_np') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('name_ne', null, [
                                        'class' => 'form-control',
                                        'placeholder' => trans('message.pages.common.name_np'),
                                        'autocomplete' => 'off',
                                    ]) !!}
                                    {!! $errors->first('name_ne', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputName">
                                        {{ trans('complaints.mobile_no') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('mobile_no', null, [
                                        'class' => 'form-control',
                                        'placeholder' => trans('complaints.mobile_no'),
                                        'autocomplete' => 'off',
                                        'id' => 'mobile',
                                    ]) !!}
                                    {!! $errors->first('mobile_no', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-4">
                                    <label>
                                        {{ trans('complaints.email') }}
                                    </label>

                                    <label class="text text-danger">
                                        *
                                    </label>

                                    {!! Form::email('email', null, [
                                        'class' => 'form-control',
                                        'id' => 'login_user_name',
                                        'placeholder' => trans('complaints.email'),
                                    ]) !!}
                                    {!! $errors->first('email', '<span class="text text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('complaints.gender') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>


                                    {{ Form::select('gender_id', $genderList->pluck('name', 'id'), Request::get('gender_id'), [
                                        'class' => 'form-control select2',
                                        'style' => 'width: 100%',
                                        'placeholder' => trans('complaints.select_gender'),
                                    ]) }}

                                    {!! $errors->first('gender_id', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('complaints.country') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {{ Form::select('country_id', $countryList->pluck('name', 'id'), Request::get('country_id'), [
                                        'class' => 'form-control select2 countrySelector',
                                    
                                        'style' => 'width: 100%',
                                        'placeholder' => trans('complaints.country'),
                                    ]) }}

                                    {!! $errors->first('country_id', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('message.pages.common.province_name') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {{ Form::select('province_code', provinceList()->pluck('name', 'id'), Request::get('province_code'), [
                                        'class' => 'form-control select2 countrySelector',
                                        'required',
                                        'id' => 'province_code',
                                        'style' => 'width: 100%;',
                                        'placeholder' => trans('message.pages.common.select_province_name'),
                                    ]) }}
                                </div>


                                <div class="form-group col-md-4 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('message.pages.common.district_name') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select class='form-control select2 countrySelector selected' name='district_code'
                                        required id="district_code" style="width: 100%">
                                        <option class='form control' value=''>
                                            {{ trans('message.pages.common.district_name') }}
                                        </option>

                                        @foreach (districtListByCode($data->province_code) as $val)
                                            <option value='{{ $val->code }}'
                                                @if (isset($data->district_code)) @if ($val->code == $data->district_code) selected @endif
                                            @else {{ old('district_code') == $data->district_id ? 'selected' : '' }}
                                                @endif
                                                >
                                                {{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-4 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('message.pages.common.local_body_name') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select class='form-control select2 countrySelector selected'
                                        name='local_government_code' style="width: 100%" id="local_body_code" required>
                                        <option class='form control' value=''>
                                            {{ trans('message.pages.common.local_body_name') }}
                                        </option>
                                        @foreach (localBodyListByCode($data->district_code) as $val)
                                            <option value='{{ $val->code }}'
                                                @if (isset($data->local_government_code)) @if ($val->code == $data->local_government_code) selected @endif
                                            @else
                                                {{ old('local_government_code') == $data->local_government_code ? 'selected' : '' }}
                                                @endif
                                                >
                                                {{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-4 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('complaints.ward') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select class='form-control select2 countrySelector selected' name='ward' required
                                        id='wardList' style="width: 100%">
                                        <option class='form control' value=''>
                                            {{ trans('complaints.ward') }}
                                        </option>
                                        @foreach (getWardListByLocalBodyCode($data->local_government_code) as $val)
                                            <option value='{{ $val }}'
                                                @if (isset($data->ward)) @if ($val == $data->ward) selected @endif
                                                @endif
                                                >
                                                {{ $val }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputName">
                                        {{ trans('complaints.location') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>

                                    {!! Form::text('tole', null, [
                                        'class' => 'form-control',
                                        'placeholder' => trans('complaints.location'),
                                        'autocomplete' => 'off',
                                    ]) !!}
                                    {!! $errors->first('location', '<small class="text text-danger">:message</small>') !!}
                                </div>
                            </div>
                            <div class="card">
                                {{-- Bottom Modal --}}
                                <div class="modal-header col-md-12 bg-primary">
                                    <h4 class="modal-title {{ setFont() }}">
                                        {{ trans('complaints.detail') }}
                                    </h4>
                                </div>
                                <div class="row" style="margin: 10px">

                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('complaints.complaint_type') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{ Form::select('form_category_id', $complaintTypeList->pluck('name', 'id'), Request::get('form_category_id'), [
                                            'class' => 'form-control select2',
                                        
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('complaints.select_complaint_type'),
                                        ]) }}

                                        {!! $errors->first('form_category_id', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label for="inputName" class="{{ setFont() }}">
                                            {{ trans('complaints.brief_description') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::textarea('description', null, [
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                            'rows' => '1',
                                        ]) !!}
                                        {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName" class="{{ setFont() }}">
                                            {{ trans('complaints.feedback_suggestion_office') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::textarea('csd_response', null, [
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                            'rows' => '1',
                                        ]) !!}
                                        {!! $errors->first('csd_response', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputName" class="{{ setFont() }}">
                                            {{ trans('complaints.feedback_suggestion_public') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::textarea('csd_response_public', null, [
                                            'class' => 'form-control',
                                            'autocomplete' => 'off',
                                            'rows' => '1',
                                        ]) !!}
                                        {!! $errors->first('csd_response_public', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName" class="{{ setFont() }}">
                                            {{ trans('complaints.complaint_source') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{ Form::select(
                                            'complaint_source_id',
                                            $complaintSourceList->pluck('name', 'id'),
                                            Request::get('complaint_source_id'),
                                            [
                                                'class' => 'form-control select2',
                                                'style' => 'width: 100%',
                                                'placeholder' => trans('complaints.select_complaint_source'),
                                            ],
                                        ) }}

                                        {!! $errors->first('complaint_source_id', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('complaints.complaint_severity') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{ Form::select(
                                            'severity_type_id',
                                            $complaintSeverityList->pluck('name', 'id'),
                                            Request::get('severity_type_id'),
                                        
                                            [
                                                'class' => 'form-control select2',
                                                'style' => 'width: 100%',
                                                'placeholder' => trans('complaints.select_complaint_severity'),
                                            ],
                                        ) }}

                                        {!! $errors->first('severity_type_id', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName" style="margin-top: 30px; margin-left: 10px">
                                            @if ($value->solved_by_call_center != null)
                                                <input type="checkbox" class="radio-button" name="solved_by_call_center"
                                                    value="true" checked>
                                            @else
                                                <input type="checkbox" class="radio-button" name="solved_by_call_center"
                                                    value="false">
                                            @endif

                                            {{-- @if ($data->solved_by_call_center != null) checked @endif --}}
                                            {{ trans('complaints.resolved_by_call_center') }}

                                        </label>
                                    </div>


                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            <label for="inputName" style="margin-top: 30px; margin-left: 10px">
                                                @if ($value->office_unknown != null)
                                                    <input type="checkbox" class="radio-button" name="office_unknown"
                                                        value="true" checked>
                                                @else
                                                    <input type="checkbox" class="radio-button" name="office_unknown"
                                                        value="false">
                                                @endif

                                                {{-- @if ($data->office_unknown != null) checked @endif> --}}
                                                {{ trans('complaints.dont_know_assigning_office') }}

                                            </label>

                                        </label>
                                    </div>


                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('complaints.office') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{ Form::select('office_id', $office_id->pluck('name', 'id'), Request::get('office_id'), [
                                            'class' => 'form-control select2',
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('complaints.choose_office'),
                                        ]) }}

                                        {!! $errors->first('office_id', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div>
                                        <label for="inputName" class="{{ setFont() }}"
                                            style="margin-top: 30px; margin-left: 10px">
                                            @if ($value->require_follow_up != null)
                                                <input name="require_follow_up" class="radio-button" type="checkbox"
                                                    id="checkbox2" checked value="true">
                                            @else
                                                <input name="require_follow_up" class="radio-button" type="checkbox"
                                                    id="checkbox2" value="false">
                                            @endif

                                            {{-- @if ($data->require_follow_up != null) checked @endif id="checkbox2" /> --}}

                                            {{ trans('complaints.need_to_follow_up') }}
                                        </label>
                                    </div>
                                    <div class="followUp col-md-4 {{ setFont() }}"
                                        style=" @if ($value->require_follow_up == null) display:none @else display:inline-flex @endif ">
                                        @if (getLan() == 'np')
                                            <div class="form-group col-md-6 {{ setFont() }} ">

                                                <label for="inputName">
                                                    {{ trans('complaints.follow_up_date') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                {!! Form::text('follow_up_date_bs', null, [
                                                    'class' => 'form-control nepaliDatePicker',
                                                    'placeholder' => trans('complaints.follow_up_date'),
                                                    'autocomplete' => 'off',
                                                    'id' => 'date_bs',
                                                ]) !!}
                                                {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                                <input type="hidden" name='follow_up_date_ad' id="date_ad">
                                            </div>
                                        @endif
                                        @if (getLan() == 'en')

                                            <div class="form-group col-md-6 {{ setFont() }} ">

                                                <label for="inputName">
                                                    {{ trans('complaints.follow_up_date') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                {!! Form::text('follow_up_date_ad', null, [
                                                    'class' => 'form-control englishDatePicker',
                                                    'placeholder' => trans('complaints.follow_up_date'),
                                                    'autocomplete' => 'off',
                                                    'id' => 'date_ad',
                                                ]) !!}
                                                {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                                <input type="hidden" name='follow_up_date_bs' id="date_bs">
                                            </div>
                                        @endif
                                    </div>


                                </div>
                                <div class="modal-footer justify-content-center {{ setFont() }}">
                                    @include('backend.components.buttons.addAction')
                                </div>

                                {!! Form::close() !!}
                            </div>

                        </div>
                        <!-- /.col -->

                        <!-- /.row -->
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>

    <script>
        var checkbox1 = document.getElementById("checkbox1");
        var formContainer1 = document.querySelector(".autoUpdate");

        checkbox1.addEventListener("change", function() {
            if (checkbox1.checked) {
                formContainer1.style.display = "none";
            } else {
                formContainer1.style.display = "flex";
            }
        });


        var checkbox2 = document.getElementById("checkbox2");
        var formContainer2 = document.querySelector(".followUp");

        checkbox2.addEventListener("change", function() {
            if (checkbox2.checked) {
                formContainer2.style.display = "inline-flex  ";
            } else {
                formContainer2.style.display = "none";
            }
        });
    </script>


    <!-- /.content-wrapper -->
@endsection
