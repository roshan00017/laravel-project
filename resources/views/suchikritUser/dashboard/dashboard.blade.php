@extends('suchikritUser.layouts.app')
@section('content')
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


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div style="background-color:orange; color:white" class="small-box {{setFont()}}">
                        <div class="inner">
                            <h3>{{$total_dispatch}}</h3>
                            <h5> {{ trans('dashboard.msgdashboard.total_dispatch') }}</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="{{ url('dcDispatchBook') }}" class="small-box-footer">{{ trans('common.more_info') }}
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div style="background-color:#fcec03; color:white" class="small-box {{ setFont() }}">
                        <div class="inner">
                            <h3>{{$today_dispatch}}</h3>
                            <h5> {{ trans('suchikritDashboard.today_dispatch') }}</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="{{ url('dcDispatchBook') }}" class="small-box-footer">{{ trans('common.more_info') }}
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- total meeting count block end --}}

                <div class="col-lg-3 col-xs-6">
                    <div style="background-color:green; color:white" class="small-box {{ setFont() }}">
                        <div class="inner">
                            <h3>{{$total_register}}</h3>
                            <h5>{{ trans('dashboard.msgdashboard.total_register') }}</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-address-book"></i>
                        </div>
                        <a href="{{ url('dcRegisterBook') }}" class="small-box-footer">{{ trans('common.more_info') }}
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div style="background-color:#45de12; color:white" class="small-box {{setFont()}}">
                        <div class="inner">
                            <h3>{{$today_register}}</h3>
                            <h5> {{ trans('suchikritDashboard.today_register') }}</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-address-book"></i>
                        </div>
                        <a href="{{ url('dcRegisterBook') }}" class="small-box-footer">{{ trans('common.more_info') }}
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-primary {{setFont()}}">
                        <div class="inner">
                            <h3>{{$total_document}}</h3>
                            <h5> {{ trans('dashboard.msgdashboard.total_document') }}</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="{{ url('dcDocument') }}" class="small-box-footer">{{ trans('common.more_info') }} <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div style="background-color:blue; color:white" class="small-box {{ setFont() }}">
                        <div class="inner">
                            <h3>{{$total_document}}</h3>
                            <h5> {{ trans('suchikritDashboard.today_document') }}</h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="{{ url('dcDocument') }}" class="small-box-footer">{{ trans('common.more_info') }} <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div style="background-color:#59156e; color:white" class="small-box   {{ setFont() }}">
                        <div class="inner">
                            <h3>{{$total_appointment}}</h3>
                            <h5> {{ trans('suchikritDashboard.appointment') }}</h5>
                        </div>
                        <div class="icon">
                            <i class="far fa-handshake"></i>
                        </div>
                        <a href="{{ url('appointments') }}" class="small-box-footer">{{ trans('common.more_info') }} <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box  bg-purple  {{ setFont() }}">
                        <div class="inner">
                            <h3>{{$today_appointment}}</h3>
                            <h5> {{ trans('suchikritDashboard.today_appointment') }}</h5>
                        </div>
                        <div class="icon">
                            <i class="far fa-handshake"></i>
                        </div>
                        <a href="{{ url('appointments') }}" class="small-box-footer">{{ trans('common.more_info') }} <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
