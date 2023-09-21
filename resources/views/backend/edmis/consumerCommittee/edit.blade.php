@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                            {{ $page_title }}
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
                                {{ trans('message.commons.edit') }}
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            {!! Form::model($value, [
                                'method' => 'PUT',
                                'route' => [$page_route . '.' . 'update', $value->id],
                                'enctype' => 'multipart/form-data',
                                'autocomplete' => 'off',
                            ]) !!}
                            <div class="card-header">
                                @include('backend.components.buttons.returnBack')

                                <h5 class="{{ setFont() }}">
                                    <strong>
                                        {{ trans('message.commons.edit') }}
                                    </strong>
                                    <span style="font-size: 14px; color: #ca4843">
                                        {{ trans('validation.pages.common.mandatory_field_message') }} </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-2  {{ setFont() }}">
                                        <label for="inputFeedback">
                                            {{ trans('message.pages.common.code') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('code', Request::get('code'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('message.pages.common.code'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-3 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.form_date_bs') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('form_date_bs', null, [
                                            'class' => 'form-control nepaliDatePicker',
                                            'placeholder' => trans('consumerCommittee.consumer.form_date_bs'),
                                            'autocomplete' => 'off',
                                            'id' => 'date_from_bs',
                                        ]) !!}
                                        {!! $errors->first('form_date_bs', '<small class="text text-danger">:message</small>') !!}
                                    </div>


                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.form_date_ad') }}

                                        </label>
                                        {!! Form::text('form_date_ad', null, [
                                            'class' => 'form-control englishDatePicker',
                                            'placeholder' => trans('consumerCommittee.consumer.form_date_ad'),
                                            'autocomplete' => 'off',
                                            'id' => 'date_from_ad',
                                        ]) !!}
                                        {!! $errors->first('form_date_ad', '<small class="text text-danger">:message</small>') !!}
                                    </div>


                                    <div class="form-group col-md-2  {{ setFont() }}">
                                        <label for="inputFeedback">
                                            {{ trans('consumerCommittee.consumer.ward_no') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('ward_no', Request::get('ward_no'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.ward_no'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('ward_no', '<small class="text text-danger">:message</small>') !!}
                                    </div>


                                    <div class="form-group col-md-2 {{ setFont() }}">
                                        <label>
                                            {{ trans('message.commons.status') }}
                                        </label>
                                        <br>
                                        <input class="radio-button" type="radio" name="status" checked value="1"
                                            style="margin-top: 2px">
                                        {{ trans('message.button.active') }}
                                        &nbsp; &nbsp;
                                        <input class="radio-button" type="radio" name="status" value="0"
                                            style="margin-top: 2px">
                                        {{ trans('message.button.inactive') }}
                                    </div>
                                    @if (systemAdmin() == true)
                                        <div class="form-group col-md-4 {{ setFont() }}">

                                            <label for="inputName">
                                                {{ trans('consumerCommittee.consumer.bank') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            {!! Form::select('bank', $bankList->pluck('name_en', 'code'), Request::get('bank'), [
                                                'class' => 'form-control select2 clientInfo',
                                                'style' => 'width: 100%;',
                                                'placeholder' => trans('consumerCommittee.consumer.bank'),
                                            ]) !!}
                                        </div>
                                    @endif
                                    <div class="form-group col-md-4 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.bank_acc_num') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('bank_acc_num', Request::get('bank_acc_num'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.bank_acc_num'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('bank_acc_num', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-4 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.bank_address') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('bank_address', Request::get('bank_address'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.bank_address'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('bank_address', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-4 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.present_number') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('present_number', Request::get('present_number'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.present_number'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('present_number', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-4 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.member_number') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('members_number', Request::get('members_number'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.member_number'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('members_number', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-4 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.witness_name') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('witness_name', Request::get('witness_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.witness_name'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('witness_name', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="card-header col-md-12">
                                        <h5 class="{{ setFont() }}">
                                            <strong>{{ trans('consumerCommittee.consumer.consumer_committee') }}</strong>
                                        </h5>
                                    </div>
                                    <div class="form-group col-md-8 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.full_name') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('full_name', Request::get('full_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.full_name'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('full_name', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-4 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.name') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('name', Request::get('name'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.name'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-3 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.consumer_committee_type') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('consumer_committee_type', Request::get('consumer_committee_type'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.consumer_committee_type'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('consumer_committee_type', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-3 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.regd_no') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('regd_no', Request::get('regd_no'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.regd_no'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('regd_no', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-3 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.regd_date_bs') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('regd_date_bs', null, [
                                            'class' => 'form-control nepaliDatePicker',
                                            'placeholder' => trans('consumerCommittee.consumer.regd_date_bs'),
                                            'autocomplete' => 'off',
                                            'id' => 'date_to_bs',
                                        ]) !!}
                                        {!! $errors->first('regd_date_bs', '<small class="text text-danger">:message</small>') !!}
                                    </div>


                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.regd_date_ad') }}

                                        </label>
                                        {!! Form::text('regd_date_ad', null, [
                                            'class' => 'form-control englishDatePicker',
                                            'placeholder' => trans('consumerCommittee.consumer.regd_date_ad'),
                                            'autocomplete' => 'off',
                                            'id' => 'date_to_ad',
                                        ]) !!}
                                        {!! $errors->first('regd_date_ad', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-4 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.office') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('office', Request::get('office'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.office'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('office', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-8 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.other_details') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('other_details', Request::get('other_details'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.other_details'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('other_details', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    {{-- permanent address --}}
                                    <div class="card-header col-md-12">
                                        <h5 class="{{ setFont() }}">
                                            <strong>{{ trans('consumerCommittee.consumer.perAddressDetail') }}</strong>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @php
                                                $name = setName();
                                            @endphp
                                            <div class="form-group col-md-4 {{ setFont() }}">
                                                <label for="inputName">
                                                    {{ trans('message.pages.common.province_name') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                {{ Form::select(
                                                    'per_province_code',
                                                    provinceList($value->per_province_code)->pluck('name', 'id'),
                                                    Request::get('per_province_code'),
                                                    [
                                                        'class' => 'form-control ',
                                                        'required',
                                                        'id' => 'per_province_code',
                                                        'style' => 'width: 100%;',
                                                        'placeholder' => trans('message.pages.common.select_province_name'),
                                                    ],
                                                ) }}
                                            </div>


                                            <div class="form-group col-md-4 {{ setFont() }}">
                                                <label for="inputName">
                                                    {{ trans('message.pages.common.district_name') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                <select class='form-control  selected' name='per_district_code' required
                                                    id="per_district_code" style="width: 100%">
                                                    <option class='form control' value=''>
                                                        {{ trans('message.pages.common.district_name') }}
                                                    </option>

                                                    @foreach (districtListByCode($value->per_province_code) as $val)
                                                        <option value='{{ $val->code }}'
                                                            @if (isset($value->per_district_code)) @if ($val->code == $value->per_district_code) selected @endif
                                                        @else
                                                            {{ old('district_code') == $value->per_district_code ? 'selected' : '' }}
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
                                                <select class='form-control  selected' name='per_local_body_code'
                                                    style="width: 100%" id="per_local_body_code" required>
                                                    <option class='form control' value=''>
                                                        {{ trans('message.pages.common.local_body_name') }}
                                                    </option>
                                                    @foreach (localBodyListByCode($value->per_district_code) as $val)
                                                        <option value='{{ $val->code }}'
                                                            @if (isset($value->local_body_code)) @if ($val->code == $value->local_body_code) selected @endif
                                                        @else
                                                            {{ old('local_body_code') == $value->local_body_code ? 'selected' : '' }}
                                                            @endif
                                                            >
                                                            {{ $val->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-md-4 {{ setFont() }}">
                                                <label for="inputName">
                                                    {{ trans('common.ward_no') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                <select class='form-control  selected' name='per_ward_no' required
                                                    id='per_ward_no' style="width: 100%">
                                                    <option class='form control' value=''>
                                                        {{ trans('common.ward_no') }}
                                                    </option>
                                                    @foreach (getWardListByLocalBodyCode($value->per_local_body_code) as $val)
                                                        <option value='{{ $val }}'
                                                            @if (isset($value->per_ward_no)) @if ($val == $value->per_ward_no) selected @endif
                                                            @endif
                                                            >
                                                            {{ $val }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4 {{ setFont() }}">
                                                <label>
                                                    {{ trans('common.street_name') }}
                                                </label>

                                                <label class="text text-danger">
                                                    *
                                                </label>

                                                {!! Form::text('per_street_name', null, [
                                                    'class' => 'form-control',
                                                    'id' => 'per_street_name',
                                                    'placeholder' => trans('common.street_name'),
                                                    'required',
                                                ]) !!}
                                            </div>

                                        </div>
                                    </div>


                                    {{-- temporary address --}}
                                    <div class="card-header col-md-12">
                                        <h5 class="{{ setFont() }}">
                                            <strong>{{ trans('consumerCommittee.consumer.tempAddressDetail') }}</strong>
                                        </h5>
                                        <input type="checkbox" class="radio-button" id="isSameAddress"
                                            name="is_same_address"> &nbsp;
                                        <label for="same_address"
                                            class="{{ setFont() }}">{{ trans('consumerCommittee.consumer.addressSameText') }}</label>
                                    </div>
                                    <div class="form-group col-md-4 {{ setFont() }}" id="temp_province_code_block">
                                        <label for="inputName">
                                            {{ trans('message.pages.common.province_name') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {{ Form::select(
                                            'temp_province_code',
                                            provinceList($value->temp_province_code)->pluck('name', 'id'),
                                            Request::get('per_province_code'),
                                            [
                                                'class' => 'form-control ',
                                                'required',
                                                'id' => 'temp_province_code',
                                                'style' => 'width: 100%;',
                                                'placeholder' => trans('message.pages.common.select_province_name'),
                                            ],
                                        ) }}
                                    </div>
                                    <div class="form-group col-md-4 {{ setFont() }}" id="is_copy_temp_province_block"
                                        style="display: none">
                                        <label for=""> {{ trans('message.pages.common.province_name') }}
                                        </label>
                                        <span class="required-field">
                                            *
                                        </span>
                                        <input type="hidden" name="is_temp_copy_province_code"
                                            id="is_copy_province_code">
                                        <input type="text" class="form-control" id="is_copy_province_name" readonly>
                                    </div>



                                    <div class="form-group col-md-4 {{ setFont() }}" id="temp_district_code_block">
                                        <label for="inputName">
                                            {{ trans('message.pages.common.district_name') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select class='form-control  selected' name='temp_district_code' required
                                            id="temp_district_code" style="width: 100%">
                                            <option class='form control' value=''>
                                                {{ trans('message.pages.common.district_name') }}
                                            </option>

                                            @foreach (districtListByCode($value->temp_province_code) as $val)
                                                <option value='{{ $val->code }}'
                                                    @if (isset($value->temp_district_code)) @if ($val->code == $value->temp_district_code) selected @endif
                                                @else
                                                    {{ old('district_code') == $value->temp_district_code ? 'selected' : '' }}
                                                    @endif
                                                    >
                                                    {{ $val->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 {{ setFont() }}" id="is_copy_temp_district_block"
                                        style="display: none">
                                        <label for="inputName">
                                            {{ trans('message.pages.common.district_name') }}
                                            <span class="required-field">
                                                *
                                            </span>
                                        </label>
                                        <input type="hidden" name="is_temp_copy_district_code"
                                            id="is_copy_district_code">
                                        <input type="text" class="form-control" id="is_copy_district_name" readonly>
                                    </div>



                                    <div class="form-group col-md-4 {{ setFont() }}" id="temp_local_body_code_block">
                                        <label for="inputName">
                                            {{ trans('message.pages.common.local_body_name') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select class='form-control selected' name='temp_local_body_code'
                                            style="width: 100%" id='temp_local_body_code' required>
                                            <option class='form control' value=''>
                                                {{ trans('message.pages.common.local_body_name') }}
                                            </option>
                                            @foreach (localBodyListByCode($value->temp_district_code) as $val)
                                                <option value='{{ $val->code }}'
                                                    @if (isset($value->temp_local_body_code)) @if ($val->code == $value->temp_local_body_code) selected @endif
                                                @else
                                                    {{ old('temp_local_body_code') == $value->temp_local_body_code ? 'selected' : '' }}
                                                    @endif
                                                    >
                                                    {{ $val->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4 {{ setFont() }}"
                                        id="is_copy_temp_local_body_block" style="display: none">
                                        <label for=""> {{ trans('message.pages.common.local_body_name') }}
                                        </label>
                                        <span class="required-field">
                                            *
                                        </span>
                                        <input type="hidden" name="is_temp_copy_local_body_code"
                                            id="is_copy_local_body_code">
                                        <input type="text" class="form-control" id="is_copy_local_body_name" readonly>
                                    </div>


                                    <div class="form-group col-md-4 {{ setFont() }}" id="temp_ward_no_block">
                                        <label for="inputName">
                                            {{ trans('common.ward_no') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        <select class='form-control  selected' name='temp_ward_no' id="temp_ward_no"
                                            required style="width: 100%">
                                            <option class='form control' value=''>
                                                {{ trans('common.ward_no') }}
                                            </option>
                                            @foreach (getWardListByLocalBodyCode($value->temp_local_body_code) as $val)
                                                <option value='{{ $val }}'
                                                    @if (isset($value->temp_ward_no)) @if ($val == $value->temp_ward_no) selected @endif
                                                    @endif
                                                    >
                                                    {{ $val }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4 {{ setFont() }}" id="is_copy_temp_ward_no_block"
                                        style="display: none">
                                        <label for="">
                                            {{ trans('ward.ward_no') }}
                                            <span class="required-field">
                                                *
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="is_copy_temp_ward_no"
                                            id="is_copy_temp_ward_no">
                                    </div>

                                    <div class="form-group col-md-4 {{ setFont() }}" id="temp_street_name_block">
                                        <label>
                                            {{ trans('common.street_name') }}
                                        </label>

                                        <label class="required-field">
                                            *
                                        </label>

                                        {!! Form::text('temp_street_name', null, [
                                            'class' => 'form-control',
                                            'id' => 'temp_street_name',
                                            'placeholder' => trans('common.street_name'),
                                            'required',
                                        ]) !!}
                                    </div>
                                    <div class="card-header col-md-12">
                                        <h5 class="{{ setFont() }}">
                                            <strong>
                                                {{ trans('consumerCommittee.consumer.contact_details') }}</strong>
                                        </h5>
                                    </div>

                                    <div class="form-group col-md-3 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.full_name') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('contact_person_full_name', Request::get('contact_person_full_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.full_name'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('contact_person_full_name', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-3 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.name') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('contact_person_name', Request::get('contact_person_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.name'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('contact_person_name', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.designation') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('contact_person_designation', Request::get('contact_person_designation'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.designation'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('contact_person_designation', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-3 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.phone') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('contact_person_phone', Request::get('contact_person_phone'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.phone'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('contact_person_phone', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-3 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.mobile') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('contact_person_mobile', Request::get('contact_person_mobile'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.mobile'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('contact_person_mobile', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                    <div class="form-group col-md-3 {{ setFont() }}">

                                        <label for="inputName">
                                            {{ trans('consumerCommittee.consumer.email') }}
                                            <span class="text text-danger">
                                                *
                                            </span>
                                        </label>
                                        {!! Form::text('email', Request::get('email'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('consumerCommittee.consumer.email'),
                                            'autocomplete' => 'off',
                                            'required',
                                        ]) !!}
                                        {!! $errors->first('email', '<small class="text text-danger">:message</small>') !!}
                                    </div>
                                </div>

                                <div class="modal-footer justify-content-center {{ setFont() }}">
                                    @include('backend.components.buttons.addAction')
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>

                    </div>
                    <!-- /.col -->
                </div>

                <!-- /.row -->
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
@endsection
