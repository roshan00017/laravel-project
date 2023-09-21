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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body p-0">
                            <div class="bs-stepper">
                                @include('backend.appointment.appointmentHeader')
                                <div class="bs-stepper-content ">
                                    @include('backend.appointment.personalInfoSearch')
                                        {!! Form::open([
                                            'method' => 'post',
                                            'id' => 'addForm',
                                            'url' => 'personalInfo',
                                        ]) !!}
                                        <div class="row">
                                            <div class="form-group col-md-6 {{ setFont() }}">
                                                <label for="inputName">
                                                    {{ trans('appointment.full_name') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                {!! Form::text('full_name', @$appointment->full_name, [
                                                    'class' => 'form-control',
                                                    'required',
                                                    'id'=>'name',
                                                    'placeholder' => trans('appointment.full_name'),
                                                    'autocomplete' => 'off',
                                                ]) !!}
                                            </div>

                                            <div class="form-group col-md-6 {{ setFont() }}">
                                                <label for="inputName">
                                                    {{ trans('appointment.email') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                {!! Form::email('email', @$appointment->email, [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('appointment.email'),
                                                    'autocomplete' => 'off',
                                                    'id' => 'email',
                                                ]) !!}
                                                {!! $errors->first('email', '<small class="text text-danger">:message</small>') !!}
                                            </div>

                                            <div class="form-group col-md-6 {{ setFont() }}">
                                                <label for="inputName">
                                                    {{ trans('appointment.mobile_no') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                {!! Form::text('mobile_no', @$appointment->mobile_no, [
                                                    'class' => 'form-control mobileNo',
                                                    'placeholder' => trans('appointment.mobile_no'),
                                                    'autocomplete' => 'off',
                                                    'id' => 'mobile',
                                                ]) !!}
                                                {!! $errors->first('mobile_no', '<small class="text text-danger">:message</small>') !!}
                                            </div>

                                            <div class="form-group col-md-6 {{ setFont() }}">
                                                <label for="inputName">
                                                    {{ trans('appointment.address') }}
                                                    <span class="text text-danger">
                                                        *
                                                    </span>
                                                </label>
                                                {!! Form::text('address', @$appointment->address, [
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('appointment.address'),
                                                    'autocomplete' => 'off',
                                                    'id' => 'address',
                                                ]) !!}
                                                {!! $errors->first('address', '<small class="text text-danger">:message</small>') !!}
                                            </div>


                                        </div>

                                        <a href="{{ route('appointment.appointmentInfo') }}"
                                            class="btn btn-info rounded-pill float-left {{ setFont() }}">
                                            <i class="fa fa-arrow-alt-circle-left"></i> {{ trans('appointment.previous') }}
                                        </a>
                                        &nbsp; &nbsp;
                                        <button type="submit"
                                            class="btn btn-primary rounded-pill float-right {{ setFont() }} "
                                            id="btn-add">

                                            {{ trans('appointment.next') }}
                                            <i class="fa fa-arrow-alt-circle-right"></i>
                                        </button>
                                        {!! Form::close() !!}


                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    @include('backend.modal.check_data_modal')
@endsection
