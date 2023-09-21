@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 {{setFont()}}">
                        {{$page_title}}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right {{setFont()}}">
                        <li class="breadcrumb-item">
                            <a href="{{url('dashboard')}}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                {{ trans('message.dashboard.page_title') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{url('dcDispatchBook')}}">
                                {{$page_title}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            {{trans('message.commons.add')}}
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
                        {!! Form::open(['method'=>'post',
                        'enctype'=>'multipart/form-data',
                        'id'=>'addStudent',
                        'route'=>$page_route. '.'.'store',
                        ]) !!}
                        <div class="card-header">
                            @include('backend.components.buttons.returnBack')
                            <h5 class="{{setFont()}}"><strong> {{trans('message.commons.add')}}</strong>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-2 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.regd_no') }}
                                        <span class="text text-danger"></span>
                                    </label>
                                    {!! Form::select('regd_no', ['a'=>'a'], null, [
                                    'class' => 'form-control select2',
                                    'placeholder' => trans('dispatch.dispatch_data.regd_no'),
                                    'autocomplete' => 'off',
                                    ]) !!}
                                    {!! $errors->first('regd_no', '<small class="text text-danger">:message</small>')
                                    !!}
                                </div>


                                <!-- <div class="form-group col-md-6 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.dispatch_no') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="d-flex">
                                        <div class="mr-3">
                                            {!! Form::text('dispatch_no', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('dispatch.dispatch_data.dispatch_no'),
                                            'autocomplete' => 'off',
                                            'required'
                                            ]) !!}
                                            {!! $errors->first('dispatch_no', '<small
                                                class="text text-danger">:message</small>') !!}
                                        </div>
                                        <div class="mr-3">
                                            {!! Form::text('dispatch_no', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('dispatch.dispatch_data.dispatch_no'),
                                            'autocomplete' => 'off',
                                            'required'
                                            ]) !!}
                                            {!! $errors->first('dispatch_no', '<small
                                                class="text text-danger">:message</small>') !!}
                                        </div>
                                    </div>
                                </div> -->

                                <div class="form-group col-md-2 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.dispatch_no') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>

                                    <input type="text" class="form-control" name="dispatch_no" id="dispatch_no" placeholder="" value="{{ @$autoCodeGen['codeFormat'] }}" width="50%" readonly>
                                </div>

                                <div class="form-group col-md-2 {{ setFont() }}">
                                    <label for="inputName">
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" name="dispatch_no" id="dispatch_no" placeholder="" value="{{ @$autoCodeGen['autoCode'] }}" width="50%" {{@$codGenMode}}>

                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                @if(getLan() =='np')
                                <div class="form-group col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.dispatch_date_bs') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::text('dispatch_date_bs', null, [
                                    'class' => 'form-control nepaliDatePicker',
                                    'placeholder' => trans('dispatch.dispatch_data.dispatch_date_bs'),
                                    'autocomplete' => 'off',
                                    'id' => 'date_from_bs',
                                    'required' => 'required', // Added 'required' attribute
                                    ]) !!}
                                    @if ($errors->has('dispatch_date_bs'))
                                    <!-- Check if there is an error message for 'dispatch_date_bs' field -->
                                    <small class="text text-danger">{{ $errors->first('dispatch_date_bs') }}</small>
                                    <!-- Display the error message -->
                                    @endif
                                    <input type="hidden" name='dispatch_date_ad' id="date_from_ad">
                                </div>
                                @endif

                                @if(getLan() =='en')
                                <div class="form-group col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.dispatch_date_ad') }}

                                    </label>
                                    {!! Form::text('dispatch_date_ad', null, [
                                    'class' => 'form-control englishDatePicker',
                                    'placeholder' => trans('dispatch.dispatch_data.dispatch_date_ad'),
                                    'autocomplete' => 'off',
                                    'id'=>'date_from_ad',
                                    ]) !!}
                                    {!! $errors->first('dispatch_date_ad', '<small class="text text-danger">:message</small>') !!}
                                </div>
                                <input type="hidden" name='dispatch_date_bs' id="date_from_bs">
                                @endif

                                <div class="form-group col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.letter_no') }}
                                        <span class="text text-danger"></span>
                                    </label>
                                    {!! Form::text('letter_no', currentFy()->code, [
                                    'class' => 'form-control ',
                                    'placeholder' => trans('dispatch.dispatch_data.letter_no'),
                                    'autocomplete' => 'off',
                                    'readonly'
                                    ]) !!}
                                    {!! $errors->first('letter_no', '<small class="text text-danger">:message</small>')
                                    !!}
                                </div>

                                <div class="form-group col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.sent_medium') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {{ Form::select('sent_medium_id',
                                            $letterSendingMediumList->pluck('name','id'),
                                            Request::get('meeting_category_id'),
                                            [
                                                'class' => 'form-control select2',
                                                'style' => 'width: 100%',
                                                'placeholder' => trans('dispatch.dispatch_data.sent_medium'),
                                                'required' => 'required', // Added 'required' attribute
                                            ])
                                        }}
                                    @if ($errors->has('sent_medium_id'))
                                    <!-- Check if there is an error message for 'sent_medium_id' field -->
                                    <small class="text text-danger">{{ $errors->first('sent_medium_id') }}</small>
                                    <!-- Display the error message -->
                                    @endif
                                </div>

                                @if(getLan() =='np')
                                <div class="form-group col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.letter_date_bs') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::text('letter_date_bs', null, [
                                    'class' => 'form-control nepaliDatePicker',
                                    'placeholder' => trans('dispatch.dispatch_data.letter_date_bs'),
                                    'autocomplete' => 'off',
                                    'required' => 'required',
                                    'id' => 'date_to_bs',
                                    ]) !!}
                                    @if ($errors->has('letter_date_bs'))
                                    <!-- Check if there is an error message for 'letter_date_bs' field -->
                                    <small class="text text-danger">{{ $errors->first('letter_date_bs') }}</small>
                                    <!-- Display the error message -->
                                    @endif
                                    <input type="hidden" name='letter_date_ad' id="date_to_ad">
                                </div>
                                @endif

                                @if(getLan() =='en')
                                <div class="form-group col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.letter_date_ad') }}
                                    </label>
                                    {!! Form::text('letter_date_ad', null, [
                                    'class' => 'form-control englishDatePicker',
                                    'placeholder' => trans('dispatch.dispatch_data.letter_date_ad'),
                                    'autocomplete' => 'off',
                                    'required' => 'required',
                                    'id'=>'date_to_ad',
                                    ]) !!}

                                    {!! $errors->first('letter_date_ad', '<small class="text text-danger">:message</small>') !!}
                                    <input type="hidden" name='letter_date_bs' id="date_to_bs">
                                </div>
                                @endif
                                <div class="form-group col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.letter_status') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {{ Form::select('letter_status',
                                            $statusList->pluck('name','id'),
                                            Request::get('letter_status'),
                                            [
                                                'class' => 'form-control select2',
                                                'style' => 'width: 100%',
                                                'placeholder' => trans('dispatch.dispatch_data.letter_status'),
                                                'required' => 'required', // Added 'required' attribute
                                            ])
                                        }}
                                    @if ($errors->has('letter_status'))
                                    <!-- Check if there is an error message for 'letter_status' field -->
                                    <small class="text text-danger">{{ $errors->first('letter_status') }}</small>
                                    <!-- Display the error message -->
                                    @endif
                                </div>
                                <div class="form-group col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.letter_sub') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::textarea('letter_sub', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('dispatch.dispatch_data.letter_sub'),
                                    'autocomplete' => 'off',
                                    'rows' => 1,
                                    'required' => 'required',
                                    ]) !!}
                                    @if ($errors->has('letter_sub'))
                                    <!-- Check if there is an error message for 'letter_sub' field -->
                                    <small class="text text-danger">{{ $errors->first('letter_sub') }}</small>
                                    <!-- Display the error message -->
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.letter_upload') }}
                                    </label>
                                    <br>
                                    {!! Form::file('letter_upload', [
                                    'autocomplete' => 'off',
                                    'accept' => 'image/jpeg,image/png,application/pdf',
                                    ]) !!}
                                    {!! $errors->first('letter_upload', '<small class="text text-danger">:message</small>')
                                    !!}
                                    <br>
                                    @if($errors->has('letter_upload') == null)
                                    <span class="text text-danger {{setFont()}}" style="font-size: 14px; color: #ff042c">
                                        {{ trans('dartaKitab.dc_register_book.file_upload_message') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.file_type') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {{ Form::select('file_type',
                                                $documentTypes->pluck('name','id'),
                                                Request::get('file_type'),
                                                [
                                                    'class' => 'form-control select2',
                                                    'style' => 'width: 100%',
                                                    'placeholder' => trans('dispatch.dispatch_data.file_type'),
                                                    'required' => 'required', // Added 'required' attribute
                                                ]) }}
                                    @if ($errors->has('file_type'))
                                    <!-- Check if there is an error message for 'file_type' field -->
                                    <small class="text text-danger">{{ $errors->first('file_type') }}</small>
                                    <!-- Display the error message -->
                                    @endif
                                </div>
                                <div class="form-group col-md-4  {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.from_branch_id') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {{Form::select('from_branch_id',
                                                $department->pluck('name','id'),
                                                Request::get('from_branch_id'),
                                                ['class'=>'form-control select2',
                                                'style'=>'width: 100%',
                                                'placeholder'=> trans('dispatch.dispatch_data.from_branch_id'),
                                                'required',
                                            ]) }}
                                    {!! $errors->first('from_branch_id', '<small class="text text-danger">:message</small>')
                                    !!}
                                </div>
                            </div>


                            {{-- GanjaGol wala --}}
                            <div class="form-group col-md-12 ">
                                <br>
                                <label>
                                    <span class="{{ setFont() }}">
                                        {{ trans('dartaKitab.dc_register_book.letter_sending_department_Person') }}
                                    </span>
                                </label>
                                <hr style="width: 100%;">
                            </div>
                            <div class="form-group col-md-12">
                                <div style="clear: both;"></div>
                                <div style="float: left; margin-right: 10px;">
                                    {{ Form::radio('status', '1', false, ['class' => 'radio-button', 'style' => 'margin-top: 2px', 'id' => 'person-radio']) }}
                                    {{ Form::label('status', trans('dispatch.dispatch_data.person')) }}
                                </div>
                                <div style="clear: left;"></div>
                                <div style="float: left;">
                                    {{ Form::radio('status', '0', false, ['class' => 'radio-button', 'style' => 'margin-top: 2px', 'id' => 'office-radio']) }}
                                    {{ Form::label('status', trans('dispatch.dispatch_data.office')) }}
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                            {{-- Person Details --}}
                            <div class="row col-md-12" id="person-details">
                                <div class="col-md-4 {{setFont()}}">
                                    <label for="inputName" class="{{setFont()}}">
                                        {{ trans('dispatch.dispatch_data.person_name') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::text('contact_person', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('dispatch.dispatch_data.person_name'),
                                    'autocomplete' => 'off',
                                    'requried',
                                    ]) !!}
                                    {!! $errors->first('person_name', '<small class="text text-danger">:message</small>') !!}
                                </div>
                                <div class="col-md-4 {{setFont()}}">
                                    <label for="inputName" class="{{setFont()}}">
                                        {{ trans('dispatch.dispatch_data.address') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::text('contact_address', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('dispatch.dispatch_data.address'),
                                    'autocomplete' => 'off',
                                    'requried',
                                    ]) !!}
                                    {!! $errors->first('contact_address', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="col-md-4 {{setFont()}}">
                                    <label for="inputName" class="{{setFont()}}">
                                        {{ trans('dispatch.dispatch_data.contact') }}
                                    </label>
                                    {!! Form::text('contact_no', null, [
                                    'class' => 'form-control',
                                    'id'=>'contact_no',
                                    'placeholder' => trans('dispatch.dispatch_data.contact'),
                                    'autocomplete' => 'off',
                                    ]) !!}
                                    {!! $errors->first('contact_no', '<small class="text text-danger">:message</small>')
                                    !!}
                                </div>

                            </div>
                            {{-- Office Person Details --}}

                            <div class="row col-md-12" id="office-details">
                                <div id="office-select" data-toggle="modal" data-target="#addModal" class="form-group col-md-12" style="display: none;">
                                    {{ Form::button(trans('dispatch.dispatch_data.new_office'), ['type' => 'button', 'class' => 'btn btn-primary rounded-pill my-auto']) }}
                                </div>


                                <div class="col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.to_office_name') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::select('to_office_id',
                                    $office->pluck('name','id'),
                                    Request::get('to_office_id'),
                                    [
                                    'class' => 'form-control ',
                                    'placeholder' => trans('dispatch.dispatch_data.to_office_name'),
                                    'autocomplete' => 'off',
                                    'requried',
                                    ]) !!}
                                    {!! $errors->first('to_office_id', '<small class="text text-danger">:message</small>')
                                    !!}
                                </div>

                                <div class="col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.office_contact_person') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::text('to_office_name', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('dispatch.dispatch_data.office_contact_person'),
                                    'autocomplete' => 'off',
                                    'requried',
                                    ]) !!}
                                    {!! $errors->first('to_office_name', '<small class="text text-danger">:message</small>')
                                    !!}
                                </div>
                                <div class="col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.office_address') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::text('to_office_address', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('dispatch.dispatch_data.office_address'),
                                    'autocomplete' => 'off',
                                    'requried',
                                    ]) !!}
                                    {!! $errors->first('to_office_address', '<small class="text text-danger">:message</small>') !!}
                                </div>
                                <div class="col-md-3 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.office_contact') }}

                                    </label>
                                    {!! Form::text('to_office_contact', null, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('dispatch.dispatch_data.office_contact'),
                                    'autocomplete' => 'off',
                                    'id'=>'to_office_contact',
                                    ]) !!}
                                    {!! $errors->first('to_office_contact', '<small class="text text-danger">:message</small>') !!}
                                </div>
                            </div>

                            <div class="form-group col-md-12 ">
                                <br>
                                {{-- <label>
                                    <span class="{{ setFont() }}">
                                {{ trans('dartaKitab.dc_register_book.letter_sending_department_Person') }}
                                </span>
                                </label> --}}
                                <hr style="width: 100%;">
                            </div>
                            {{-- Send Abroad --}}
                            <div class="form-group col-md-12 {{ setFont() }}">
                                <p style="font-weight: bold; font-size: 17px; display: block;">
                                    {{ trans('dispatch.dispatch_data.send_abroad') }}
                                    <span class="text text-danger">*</span>
                                </p>
                                <div style="display: inline-block ; " class="col-md-6">
                                    {{ Form::radio('send_abroad', '1', false, ['class' => 'radio-button', 'style' => 'margin-top: 2px', 'id' => 'status-thik']) }}
                                    {{ Form::label('status-thik', trans('dispatch.dispatch_data.yes')) }}
                                </div>
                                <div style="display: inline-block ; " class="col-md-6">
                                    {{ Form::radio('send_abroad', '0', true, ['class' => 'radio-button', 'style' => 'margin-top: 2px', 'id' => 'status-xaina']) }}
                                    {{ Form::label('status-xaina', trans('dispatch.dispatch_data.no')) }}
                                </div>

                                <div class="form-group col-md-3 {{ setFont() }}" id="country-id-wrapper" style="display: none;">
                                    <label for="inputName">
                                        {{ trans('dispatch.dispatch_data.country_id') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::select('country_id',
                                    $country->pluck('name','id'),
                                    Request::get('country_id'),
                                    ['class' => 'form-control',
                                    'placeholder' => trans('dispatch.dispatch_data.country_id'),
                                    'autocomplete' => 'off',
                                    ]) !!}
                                    {!! $errors->first('country_id', '<small class="text text-danger">:message</small>')
                                    !!}
                                </div>
                            </div>

                            {{-- Ganjol 2 ended --}}

                            <div class="form-group col-md-12 p-2 {{setFont()}}">
                                <label for="inputName">
                                    {{ trans('dispatch.dispatch_data.bodartha') }}

                                </label>
                                {!! Form::text('bcc_id', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('dispatch.dispatch_data.bodartha'),
                                'autocomplete' => 'off',

                                ]) !!}
                                {!! $errors->first('bcc_id', '<small class="text text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group col-md-12 {{setFont()}}">
                                <label for="inputName">
                                    {{ trans('dispatch.dispatch_data.comment') }}

                                </label>
                                {!! Form::textarea('notes', null, [
                                'class' => 'form-control',
                                'rows' => '4',
                                'placeholder' => trans('dispatch.dispatch_data.comment'),
                                'autocomplete' => 'off',

                                ]) !!}
                                {!! $errors->first('notes', '<small class="text text-danger">:message</small>') !!}
                            </div>
                            <div class="modal-footer justify-content-center {{setFont()}}">
                                @include('backend.components.buttons.addAction')
                            </div>
                        </div>
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
@include('backend.basicDetails.mstOffice.add')
@include('backend.modal.technical-error-modal')
@include('backend.modal.check_data_modal')
</div>
@endsection