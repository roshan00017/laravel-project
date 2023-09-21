@extends('backend.layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 {{setFont()}}">
                        {{ trans('message.dashboard.page_title') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item {{setFont()}}">
                            <a>
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                {{ trans('message.dashboard.page_title') }}
                            </a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(systemAdmin() == true || userInfo()->user_module =='client_admin')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="info-box">
                        @include('backend.components.calendar.calendar')
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="box box-plane">
            @include('backend.message.flash')
        </div>
        <div class="container-fluid">

           {{-- @include('backend.dashboard.chatDashboard') --}}


            @if(systemAdmin() == true || userInfo()->user_module =='client_admin' || userInfo()->user_module =='edmis')
            @include('backend.dashboard.edmisDashboard')
            <hr style="width: 100%">
            @endif

            @if(systemAdmin() == true || userInfo()->user_module =='client_admin' || userInfo()->user_module =='mms')
            @include('backend.dashboard.meetingDashboard')
            @endif

            @if(systemAdmin() == true || userInfo()->user_module =='client_admin' || userInfo()->user_module =='ghs')
            @include('backend.dashboard.grievenceDashboard')
            @endif

            @if(systemAdmin() == true || userInfo()->user_module =='client_admin' || userInfo()->user_module =='dcc')
            @include('backend.dashboard.dccDashboard')
            @endif

            @if( userInfo()->user_module =='app')
            @include('backend.dashboard.appointmentDashboard')
            @endif

        </div>

    </section>

</div>

@include('backend.modal.technical-error-modal')
@endsection
