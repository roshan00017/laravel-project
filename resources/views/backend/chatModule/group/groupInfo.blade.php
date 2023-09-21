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


            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body p-0">
                            <div class="bs-stepper">
                                @include('backend.chatModule.group.groupHeader')
                                <div class="bs-stepper-content ">

                                    {!! Form::open([
                                        'method' => 'post',
                                        'id' => 'addForm',
                                        'route' => $page_route . '.' . 'store',
                                    ]) !!}
                                    <div class="row">
                                        <div class="form-group col-md-12 {{ setFont() }}">
                                            <label for="inputName">
                                                {{ trans('chat.name') }}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            {!! Form::text('name', @$group->name, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('chat.group_name'),
                                                'required',
                                                'autocomplete' => 'off',
                                            ]) !!}
                                        </div>
                                        <div class="form-group col-md-12  {{ setFont() }}">
                                            <label for="inputFeedback">
                                                {{ trans('chat.group_details') }}
                                            </label>
                                            {!! Form::textarea('details', @$group->details, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('meeting.meeting_agenda_list.description'),
                                                'rows' => '4',
                                                'autocomplete' => 'off',
                                            ]) !!}
                                            {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                                        </div>


                                    </div>
                                    <br>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ url('group') }}" class="btn btn-info rounded-pill {{ setFont() }}">
                                            <i class="fa fa-arrow-alt-circle-left"></i>
                                            {{ trans('chat.group_index') }}
                                        </a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn btn-primary rounded-pill {{ setFont() }}">
                                            {{ trans('appointment.next') }}
                                            <i class="fa fa-arrow-alt-circle-right"></i>
                                        </button>
                                    </div>
                                </div>

                                      
                              
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
@endsection
