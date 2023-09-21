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
                                {{trans('message.pages.roles.details')}}
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

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if(sizeof($agendaList) > 0)
                                    {{-- agenda list  start --}}
                                    @include('backend.meetingManagement.meeting.agendaDetails.index')
                                    @endif
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
