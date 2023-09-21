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
                                <strong> {{ trans('message.commons.edit') }}
                                </strong>
                                <span style="font-size: 14px; color: #ca4843">
                                    {{ trans('validation.pages.common.mandatory_field_message') }} </span>
                            </h5>

                        </div>
                        <div class="card-body">
                            <div class="row">


                                @if (systemAdmin() == true)
                                <div class="form-group col-md-3 {{ setFont() }}">

                                    <label for="inputName">
                                        {{ trans('common.local_body') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::select('client_id', appClientList()->pluck('name', 'id'),
                                    Request::get('client_id'), [
                                    'class' => 'form-control select2 clientInfo',
                                    'style' => 'width: 100%;',
                                    'placeholder' => trans('common.select_local_body'),
                                    ]) !!}
                                </div>
                                @endif
                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.meeting_category') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {{ Form::select(
                                            'meeting_category_id',
                                            $meetingCategoryList->pluck('name', 'id'),
                                            Request::get('meeting_category_id'),
                                            [
                                                'class' => 'form-control select2',
                                                'style' => 'width: 100%',
                                                'required',
                                                'placeholder' => trans('meeting.meeting.select_meeting_type'),
                                            ],
                                        ) }}
                                </div>
                                @if(getLan() =='np')
                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.proposed_date_bs') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('proposed_date_bs', null, [
                                    'class' => 'form-control nepaliDatePicker',
                                    'placeholder' => trans('meeting.meeting.proposed_date_bs'),
                                    'autocomplete' => 'off',
                                    'id' => 'proposed_date_bs',
                                    'required',
                                    ]) !!}
                                    @if ($errors->has('proposed_date_bs'))
                                    <!-- Check if there is an error message for 'proposed_date_bs' field -->
                                    <small class="text text-danger">{{ $errors->first('proposed_date_bs') }}</small>
                                    <!-- Display the error message -->
                                    @endif
                                    <input type="hidden" name='proposed_date_ad' id="proposed_date_ad">
                                </div>
                                @endif
                                @if(getLan() =='en')
                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.proposed_date_ad') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('proposed_date_ad', null, [
                                    'class' => 'form-control englishDatePicker',
                                    'placeholder' => trans('meeting.meeting.proposed_date_ad'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'id' => 'proposed_date_ad',
                                    ]) !!}
                                    {!! $errors->first('proposed_date_ad', '<small
                                        class="text text-danger">:message</small>') !!}
                                </div>
                                <input type="hidden" name='proposed_date_bs' id="proposed_date_bs">
                                @endif
                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.time') }}

                                    </label>
                                    {{ Form::time('proposed_time', Request::get('proposed_time'), [
                                            'class' => 'form-control startTime',
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('meeting.meeting.time'),
                                        ]) }}
                                </div>


                                <!-- <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('meeting.meeting.room_no') }}
                                        </label>
                                        {!! Form::text('room_no', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('meeting.meeting.room_no'),
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    {!! $errors->first('room_no', '<small class="text text-danger">:message</small>') !!}
                                        </div> -->

                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.meeting_venue') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('meeting_venue', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('meeting.meeting.meeting_venue'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'id' => 'date_ad',
                                    ]) !!}
                                    {!! $errors->first('meeting_venue', '<small
                                        class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-6 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.title') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('title', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('meeting.meeting.title'),
                                    'autocomplete' => 'off',
                                    ]) !!}
                                    {!! $errors->first('title', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-12 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.description') }}
                                    </label>
                                    {!! Form::textarea('description', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('meeting.meeting.description'),
                                    'rows' => 3,
                                    'autocomplete' => 'off',
                                    ]) !!}
                                    {!! $errors->first('description', '<small
                                        class="text text-danger">:message</small>') !!}
                                </div>
                                @if(getLan() =='np')
                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.meeting_date_bs') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('meeting_date_bs', null, [
                                    'class' => 'form-control nepaliDatePicker',
                                    'placeholder' => trans('meeting.meeting.meeting_date_bs'),
                                    'autocomplete' => 'off',
                                    'id' => 'date_bs',
                                    'required',
                                    ]) !!}
                                    <input type="hidden" name='meeting_date_ad' id="meeting_date_ad">
                                </div>
                                @endif
                                @if(getLan() =='en')
                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.meeting_date_ad') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('meeting_date_ad', null, [
                                    'class' => 'form-control englishDatePicker',
                                    'placeholder' => trans('meeting.meeting.meeting_date_ad'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'id' => 'date_ad',
                                    ]) !!}
                                    {!! $errors->first('proposed_date_ad', '<small
                                        class="text text-danger">:message</small>') !!}
                                </div>
                                <input type="hidden" name='proposed_date_ad' id="proposed_date_ad">
                                @endif

                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('meeting.meeting.time') }}

                                    </label>
                                    {{ Form::time('meeting_time', Request::get('meeting_time'), [
                                            'class' => 'form-control startTime',
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('meeting.meeting.time'),
                                        ]) }}
                                </div>

                                <!-- <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('meeting.meeting.meeting_venue') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                        {!! Form::text('meeting_venue', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('meeting.meeting.meeting_venue'),
                                            'autocomplete' => 'off',
                                            'required',
                                            'id' => 'date_ad',
                                        ]) !!}
                                    {!! $errors->first('meeting_venue', '<small class="text text-danger">:message</small>') !!}
                                        </div> -->

                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputDescription">
                                        {{ trans('meeting.meeting.meeting_mode') }}
                                    </label>
                                    <br>
                                    <input class="radio-button" type="radio" checked="" name="meeting_mode"
                                        @if($value->meeting_mode == 'offline') checked
                                    @endif onclick="offline()"
                                    value="offline" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.offline') }}

                                    <input class="radio-button" type="radio" @if ($value->meeting_mode == 'online')
                                    checked @endif name="meeting_mode"
                                    onclick="online();" value="online" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.online') }}
                                </div>

                                <div class="form-group col-md-2 gnBtn {{ setFont() }}" style="display: none">

                                    <button type="button" class="btn btn-secondary btn-sm rounded-pill"
                                        style="margin-top: 40px">
                                        <i class="fa fa-link"></i> {{ trans('meeting.meeting.generate_meeting_link') }}
                                    </button>
                                </div>
                                <div class="form-group col-md-4  meetingMode"
                                    style="@if ($value->meeting_mode == 'online') style : block @else display : none @endif">
                                    <label for="inputName" class="{{ setFont() }}">
                                        {{ trans('meeting.meeting.meeting_url') }}
                                    </label>
                                    {!! Form::text('meeting_url', $value->meeting_url, [
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'id' => 'meetingUrl',
                                    'readonly',
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-2 isPassword {{ setFont() }}"
                                    style="@if ($value->meeting_mode == 'online') style : block @else display : none @endif">
                                    <label for="inputNotification">
                                        {{ trans('meeting.meeting.meeting_password_gen') }}
                                    </label>
                                    <br>
                                    <input class="radio-button" type="radio" name="meeting_password_available"
                                        @if($value->meeting_password_available == true) checked @endif
                                    value="1" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.yes') }}
                                    &nbsp;
                                    <input class="radio-button" type="radio" @if($value->meeting_password_available ==
                                    false) checked @endif
                                    name="meeting_password_available" value="0" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.no') }}

                                </div>

                                <div class="form-group col-md-4  passwordGen {{ setFont() }}"
                                    style="@if ($value->meeting_password_available == true) style : block @else display : none @endif">
                                    <label for="inputNotification">
                                        {{ trans('meeting.meeting.password') }}
                                    </label>
                                    {!! Form::text('meeting_password', null, [
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    ]) !!}

                                </div>


                                <div class="form-group col-md-4 {{ setFont() }}">
                                    <label for="inputNotification">
                                        {{ trans('meeting.meeting.meeting_public') }}
                                    </label>
                                    <br>
                                    <input class="radio-button" type="radio" name="is_public" @if($value->is_public ==
                                    true) checked @endif
                                    value="1" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.yes') }}
                                    &nbsp;
                                    <input class="radio-button" type="radio" name="is_public" @if($value->is_public ==
                                    false) checked @endif value="0"
                                    style="margin-top: 2px">
                                    {{ trans('meeting.meeting.no') }}

                                </div>
{{--                                @if($value->is_public == true)--}}
{{--                                <div class="form-group col-md-12 {{setFont()}}">--}}
{{--                                    <label for="inputDescription">--}}
{{--                                        {{trans('meeting.meeting.meeting_iframe')}}--}}
{{--                                    </label>--}}
{{--                                    {!! Form::textarea('meeting_iframe',null,--}}
{{--                                    ['class'=>'form-control',--}}
{{--                                    'rows'=>'4',--}}
{{--                                    'autocomplete'=>'off'--}}
{{--                                    ])--}}
{{--                                    !!}--}}
{{--                                    {!! $errors->first('details', '<span class="label label-danger">:message</span>')--}}
{{--                                    !!}--}}
{{--                                </div>--}}
{{--                                @endif--}}


                                <div class="form-group col-md-12 modal-footer justify-content-center {{ setFont() }}">
                                    <button type="submit" class="btn btn-success  rounded-pill">
                                        <i class="fa fa-check-circle"></i>
                                        {{ trans('message.button.update') }}
                                    </button>
                                </div>
                                {!! Form::close() !!}
                                {{-- agenda list  start --}}
                                @include('backend.meetingManagement.meeting.agendaDetails.index')
                                {{-- agenda list end --}}
                                <div class="form-group col-md-12 ">
                                    {!! Form::open([
                                    'method' => 'post',
                                    'id' => 'addForm',
                                    'route' => @$agendaUrl . '.' . 'store',
                                    ]) !!}
                                    <input type="hidden" value="{{ $value->id }}" name="meeting_id">
                                    <input type="hidden" value="true" name="fromMeeting">
                                    @include('backend.meetingManagement.meeting.agendaDetails.add')
                                    <div
                                        class="form-group col-md-12 modal-footer justify-content-center {{ setFont() }}">
                                        <button type="submit" class="btn btn-success  rounded-pill">
                                            <i class="fa fa-check-circle"></i>
                                            {{ trans('message.button.update') }}
                                        </button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                @include('backend.meetingManagement.meeting.memberDetails.index')
                                {!! Form::open([
                                'method' => 'post',
                                'id' => 'addForm',
                                'url' => 'addMeetingMembers',
                                ]) !!}
                                <input type="hidden" value="{{ $value->id }}" name="meeting_id">
                                <input type="hidden" value="true" name="fromMeeting">
                                @include('backend.meetingManagement.meeting.memberDetails.add')
                                <div class="form-group col-md-12 modal-footer justify-content-center {{ setFont() }}">
                                    <button type="submit" class="btn btn-success  rounded-pill">
                                        <i class="fa fa-check-circle"></i>
                                        {{ trans('message.button.update') }}
                                    </button>
                                    &nbsp; &nbsp;
                                    <a href="{{ url(@$index_page_url) }}"
                                        class="btn btn-danger  rounded-pill {{ setFont() }}"
                                        title="{{ trans('message.button.close') }}">
                                        <i class="fa fa-times-circle"></i>
                                        {{ trans('message.button.close') }}
                                    </a>
                                </div>
                                {!! Form::close() !!}

                            </div>

                        </div>


                    </div>

                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.container-fluid -->
    <!-- /.content -->
</div>
@endsection