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
                            <div class="card-header">
                                @include('backend.components.buttons.returnBack')
                                @php
                                    $data = $value;
                                    $key = $value->id;
                                @endphp
                                @if(allowAdd())
                                    <button
                                            class="btn btn-primary btn-sm float-right boxButton rounded-pill {{setFont()}}"
                                            data-toggle="modal"
                                            data-target="#addModal{{$key}}"
                                            title="{{trans('message.button.add_new')}}"
                                    >
                                        <i class="fa fa-plus-circle"></i>
                                        {{trans('message.button.add_new')}}
                                    </button>

                                @endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @include('backend.meetingManagement.meeting.agendaDetails.index')
                                </div>

                                {!! Form::open([
                                      'method' => 'POST',
                                       'class' => 'agendaUpdate',
                                      'url' => [$page_url . '/' . 'agendaStatusUpdate/' . $value->id],
                                ]) !!}
                                <div class="row">
                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="status">
                                            {{ trans('message.pages.users_management.send_email') }}
                                        </label>
                                        <br>
                                        <input class="radio-button" type="radio" name="send_email" value="1"
                                               style="margin-top: 2px">
                                        {{ trans('message.button.yes') }} &nbsp; &nbsp;
                                        <input class="radio-button" type="radio" name="send_email" value="0"
                                               style="margin-top: 2px" checked>
                                        {{ trans('message.button.no') }}
                                    </div>

                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="status">
                                            {{ trans('SMS पठाउनुहोस्') }}
                                        </label>
                                        <br>
                                        <input class="radio-button" type="radio" name="send_sms" value="1"
                                               style="margin-top: 2px">
                                        {{ trans('message.button.yes') }} &nbsp; &nbsp;
                                        <input class="radio-button" type="radio" name="send_sms" value="0"
                                               style="margin-top: 2px" checked>
                                        {{ trans('message.button.no') }}
                                    </div>
                                    <div class="form-group col-md-3 {{ setFont() }}">
                                        <label for="status">
                                            {{ getLan() =='np' ? 'अडियो रेकर्ड  गर्नुहोस् ': trans('Convert Audio') }}
                                        </label>
                                        <br>
                                        <input class="radio-button" type="radio" name="convert_voice" value="1"
                                               style="margin-top: 2px">
                                        {{ trans('message.button.yes') }} &nbsp; &nbsp;
                                        <input class="radio-button" type="radio" name="convert_voice" value="0"
                                               style="margin-top: 2px" checked>
                                        {{ trans('message.button.no') }}
                                    </div>
                                    <div class="form-group col-md-3  phoneSmsService {{ setFont() }}">
                                        <label for="status">
                                            {{ getLan() =='np' ? 'Phone / SMs पठाउनुहोस्  ': trans('Convert Audio') }}
                                        </label>
                                        <br>
                                        <input class="radio-button" type="radio" name="create_campaign" value="1"
                                               style="margin-top: 2px">
                                        {{ trans('message.button.yes') }} &nbsp; &nbsp;
                                        <input class="radio-button" type="radio" name="create_campaign" value="0"
                                               style="margin-top: 2px" checked>
                                        {{ trans('message.button.no') }}
                                    </div>
                                    <div class="form-group col-md-4 serviceList {{ setFont() }}" style="display: none">
                                        <label for="inputName">
                                            {{trans('voiceCallManagement.service')}}
                                            <span class="text text-danger">
                                *
                            </span>
                                        </label>
                                        {!!Form::select('services',   tingTingService(),
                                            Request::get('services'),
                                            ['class'=>'form-control service select2',
                                            'style'=>'width: 50%;','placeholder'=>
                                            trans('voiceCallManagement.service')])
                                        !!}
                                    </div>


                                </div>


                                <div class="modal-footer justify-content-center {{ setFont() }}">
                                    @include('backend.components.buttons.addAction')
                                </div>
                                {!! Form::close() !!}
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
    @include('backend.modal.data-submit-modal')

    @include('backend.meetingManagement.meeting.agendaDetails.addModal')
@endsection