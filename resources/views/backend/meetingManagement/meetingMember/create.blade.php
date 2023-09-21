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

                                    <div class="form-group col-md-3  {{setFont()}}">
                                        <label for="inputName">
                                            {{trans('meeting.common.meeting_code')}}
                                            <span class="text text-danger">
                                            *
                                        </span>
                                        </label>
                                        {{Form::select('meeting_id',
                                            $meetingList->pluck('code','id'),
                                            Request::get('meeting_id'),
                                            ['class'=>'form-control select2',
                                            'required',
                                            'id'=>'meeting_id',
                                            'style'=>'width: 100%',
                                            'placeholder'=> trans('meeting.common.select_code')
                                            ])
                                            }}
                                    </div>

                                    <div id="memberAddBlock">

                                        @include('backend.meetingManagement.meeting.memberDetails.add')
                                    </div>
                                    <div class="col-md-12 {{setFont()}}" id="memberMessageBlock" style="display: none">
                                            <h5 class="text text-info">
                                            {{ trans('meeting.karayapalikaMemberListMessage') }}
                                        </h5>
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
            </div>
        </section>

        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>



@endsection