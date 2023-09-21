@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 {{setFont()}}">
                        {{ $page_title}}
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
                            <a href="{{url($page_url)}}" >
                                {{$page_title}}
                            </a>
                        </li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="card-body card">
            
       
        <ul class="nav nav-tabs {{setFont()}}"  role="tablist">
        <li class="nav-item">
        <a class="nav-link active"  data-toggle="pill" href="#details" role="tab" aria-controls="custom-content-above-home" aria-selected="true">{{ trans('chat.details') }}</a>
        </li>
        <li class="nav-item">
        <a class="nav-link"  data-toggle="pill" href="#member" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">{{ trans('chat.members') }}</a>
        </li>

        </ul>
      
        <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
        @include('backend.appointment.chat.details')

        </div>
        <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
        @include('backend.appointment.chat.member')
        </div>

        </div>
</div>
</div>
@endsection