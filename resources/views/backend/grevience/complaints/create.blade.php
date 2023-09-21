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
            <div class="container-fluid">

                {!! Form::open([
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                    'id' => 'addForm',
                    'route' => $page_route . '.' . 'store',
                ]) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="{{ setFont() }}"><strong>{{ trans('complaints.detail') }}</strong>
                                </h5>
                                <hr style="width: 100%">
                                <label for="inputName" class=" pl-3 {{ setFont() }}" style="margin-top: 10px">
                                    {{ trans('complaints.mention_type') }}
                                </label> &nbsp;
                                <input name="disclose_complainer_info" class="radio-button" type="checkbox"
                                    id="checkbox1" />
                            </div>


                            <div class=" form-group row autoUpdate p-3 {{ setFont() }}">

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
                                <div class="form-group col-md-4 {{ setFont() }}" style="display: none"
                                    id="provinceBlock">
                                    <label for="inputName">
                                        {{ trans('message.pages.common.province_name') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {{ Form::select('province_code', provinceList()->pluck('name', 'id'), Request::get('province_code'), [
                                        'class' => 'form-control select2',
                                        'id' => 'province_code',
                                        'required',
                                        'style' => 'width: 100%; border-radius:1rem',
                                        'placeholder' => trans('message.pages.common.select_province_name'),
                                    ]) }}
                                </div>


                                <div class="form-group col-md-4 {{ setFont() }}" style="display: none"
                                    id="districtBlock">
                                    <label for="inputName">
                                        {{ trans('message.pages.common.district_name') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select class='form-control select2 selected' name='district_code' id='district_code'
                                        required style="width: 100%" disabled>
                                        <option class='form control' value=''>
                                            {{ trans('message.pages.common.district_name') }}
                                        </option>
                                    </select>
                                </div>


                                <div class="form-group col-md-4 {{ setFont() }}" style="display: none"
                                    id="localBodyBlock">
                                    <label for="inputName">
                                        {{ trans('message.pages.common.local_body_name') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select class='form-control select2 selected' name='local_government_code'
                                        id='local_body_code' style="width: 100%" disabled required>
                                        <option class='form control' value=''>
                                            {{ trans('message.pages.common.local_body_name') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3" style="display: none" id="wardBlock">
                                    <label>
                                        {{ trans('complaints.ward') }}
                                    </label>

                                    <label class="text text-danger">
                                        *
                                    </label>
                                    <select class='form-control select2 selected' name='ward' id='wardList'
                                        style="width: 100%" disabled required>
                                        <option class='form control' value=''>
                                            {{ trans('complaints.ward') }}
                                        </option>
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
                                            <input type="checkbox" class="radio-button" name="solved_by_call_center">
                                            {{ trans('complaints.resolved_by_call_center') }}

                                        </label>
                                    </div>


                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            <label for="inputName" style="margin-top: 30px; margin-left: 10px">
                                                <input type="checkbox" class="radio-button" name="office_unknown"
                                                    id="office_unknown">
                                                {{ trans('complaints.dont_know_assigning_office') }}

                                            </label>

                                        </label>
                                    </div>


                                    <div class="form-group col-md-4 {{ setFont() }} officeInfo">
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
                                            <input name="require_follow_up" class="radio-button" type="checkbox"
                                                id="checkbox2" />

                                            {{ trans('complaints.need_to_follow_up') }}
                                        </label>
                                    </div>


                                    <div class="followUp col-md-4 {{ setFont() }}" style="display: none">
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
                                <div>

                                    {!! Form::close() !!}
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>


        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection
