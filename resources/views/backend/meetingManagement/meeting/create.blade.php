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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {!! Form::open([
                        'method' => 'post',
                        'id' => 'addForm',
                        'route' => $page_route . '.' . 'store',
                        ]) !!}
                        <div class="card-header">
                            @include('backend.components.buttons.returnBack')

                            <h5 class="{{ setFont() }}">
                                <strong>
                                    {{ trans('message.commons.add') }}
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
                                                'id'=>'meeting_category',
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
                                    <input type="hidden" name='proposed_date_ad' id="date_from_ad">
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
                                <input type="hidden" name='proposed_date_bs' id="date_from_bs">
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
                                    'required',
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
                                    @if (isset($request->date_np))
                                    {!! Form::text('meeting_date_bs', $request->date_np, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('meeting.meeting.meeting_date_bs'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'readonly' => true,
                                    ]) !!}
                                    @else
                                    {!! Form::text('meeting_date_bs', null, [
                                    'class' => 'form-control nepaliDatePicker',
                                    'placeholder' => trans('meeting.meeting.meeting_date_bs'),
                                    'autocomplete' => 'off',
                                    'id' => 'date_bs',
                                    'required',
                                    ]) !!}
                                    @endif
                                    @if ($errors->has('meeting_date_bs'))
                                    <!-- Check if there is an error message for 'letter_date_bs' field -->
                                    <small class="text text-danger">{{ $errors->first('meeting_date_bs') }}</small>
                                    <!-- Display the error message -->
                                    @endif
                                    <input type="hidden" name='meeting_date_ad' id="date_to_ad">
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

                                    @if (isset($request->date_en))
                                    {!! Form::text('meeting_date_ad', $request->date_en, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('meeting.meeting.meeting_date_bs'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'readonly' => true,
                                    ]) !!}
                                    @else
                                    {!! Form::text('meeting_date_ad', null, [
                                    'class' => 'form-control englishDatePicker',
                                    'placeholder' => trans('meeting.meeting.meeting_date_ad'),
                                    'autocomplete' => 'off',
                                    'required',
                                    'id' => 'date_ad',
                                    ]) !!}
                                    @endif
                                    {!! $errors->first('meeting_date_ad', '<small
                                        class="text text-danger">:message</small>') !!}
                                    <input type="hidden" name='meeting_date_bs' id="date_to_bs">
                                </div>
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
                                                                                                                    ]) !!}
                                    {!! $errors->first('meeting_venue', '<small class="text text-danger">:message</small>') !!}
                                        </div> -->

                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputDescription">
                                        {{ trans('meeting.meeting.meeting_mode') }}
                                    </label>
                                    <br>
                                    <input class="radio-button" type="radio" checked="" name="meeting_mode"
                                        onclick="offline()" value="offline" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.offline') }}

                                    <input class="radio-button" type="radio" name="meeting_mode" onclick="online();"
                                        value="online" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.online') }}
                                </div>

                                <div class="form-group col-md-2 gnBtn {{ setFont() }}" style="display: none">

                                    <button type="button" class="btn btn-secondary btn-sm rounded-pill"
                                        style="margin-top: 40px">
                                        <i class="fa fa-link"></i> {{ trans('meeting.meeting.generate_meeting_link') }}
                                    </button>
                                </div>
                                <div class="form-group col-md-4  meetingMode" style="display: none">
                                    <label for="inputName" class="{{ setFont() }}">
                                        {{ trans('meeting.meeting.meeting_url') }}
                                    </label>
                                    {!! Form::text('meeting_url', null, [
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'id' => 'meetingUrl',
                                    'readonly',
                                    ]) !!}
                                </div>

                                <div class="form-group col-md-2 isPassword {{ setFont() }}" style="display: none">
                                    <label for="inputNotification">
                                        {{ trans('meeting.meeting.meeting_password_gen') }}
                                    </label>
                                    <br>
                                    <input class="radio-button" type="radio" name="meeting_password_available"
                                        onclick="" value="1" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.yes') }}
                                    &nbsp;
                                    <input class="radio-button" type="radio" checked=""
                                        name="meeting_password_available" onclick="" value="0" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.no') }}

                                </div>

                                <div class="form-group col-md-4  passwordGen {{ setFont() }}" style="display: none">
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
                                    <input class="radio-button" type="radio" name="is_public" onclick="" value="1"
                                        style="margin-top: 2px">
                                    {{ trans('meeting.meeting.yes') }}
                                    &nbsp;
                                    <input class="radio-button" type="radio" checked="" name="is_public" onclick=""
                                        value="0" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.no') }}

                                </div>

                                <div class="form-group col-md-4 {{ setFont() }}">
                                    <label for="inputNotification">
                                        {{ trans('meeting.meeting.notify') }}
                                    </label>
                                    <br>
                                    <input class="radio-button" type="radio" name="is_notify" onclick="" value="1"
                                        style="margin-top: 2px">
                                    {{ trans('meeting.meeting.yes') }}
                                    &nbsp;
                                    <input class="radio-button" type="radio" checked="" name="is_notify" onclick=""
                                        value="0" style="margin-top: 2px">
                                    {{ trans('meeting.meeting.no') }}
                                </div>
                                {{-- add agenda --}}
                                @include('backend.meetingManagement.meeting.agendaDetails.add')
                                {{--                                        add member list --}}
                                    <div id="memberAddBlock">
                                        @include('backend.meetingManagement.meeting.memberDetails.add')
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
        </div>

        <!-- /.row -->
    </section>
    <!-- /.container-fluid -->
    <!-- /.content -->
</div>
@endsection