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
                            {{trans('message.pages.logs_management.action_logs.page_title')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right {{setFont()}}">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    {{trans('message.dashboard.page_title')}}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">
                                    {{trans('message.pages.logs_management.action_logs.page_title')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                {{trans('message.pages.logs_management.login_logs.page_title')}}
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
                            <div class="card-header" style="text-align:center">
                                <a href="{{url($page_url)}}"
                                   class="btn btn-secondary btn-sm rounded-pill float-left  boxButton {{setFont()}}"
                                   data-toggle="tooltip"
                                   title="List"
                                >
                                    <i class="fa fa-list"></i>
                                    {{trans('message.pages.logs_management.login_logs.page_title')}} {{trans('message.button.list')}}
                                </a>

                                <a href="" class="btn btn-info rounded-pill btn-sm float-right {{setFont()}}"
                                   data-toggle="modal"
                                   data-target="#searchModal"
                                   title="Filter"
                                >
                                    <i class="fas fa-filter"></i>
                                    {{trans('message.button.filter')}}
                                </a>
                                @if( $request->user_id != null || $request->from_date != null || $request->to_date != null )
                                    <strong class="{{setFont()}}">   {{trans('message.pages.logs_management.login_logs.total_login')}} </strong>
                                    <strong class="{{setFont()}}"
                                            style="font-size: 16px; color: #007bff;">{{$totalLogs}}</strong>
                                    <a href="{{url($page_url)}}"
                                       class="btn btn-secondary rounded-pill btn-sm float-right boxButton {{setFont()}}"
                                    >
                                        <i class="fas  fa-undo"></i> {{trans('message.button.reload')}}
                                    </a>
                                @endif

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            @if(sizeof($results) > 0)
                                <div class="card-body">
                                    <table id="example2"
                                           class="table table-bordered table-striped dataTable dtr-inline"
                                    >
                                        <thead class="th-header">
                                        <tr class="{{setFont()}}">
                                            <th width="10px;">
                                                {{trans('message.commons.s_n')}}
                                            </th>
                                            <th width="150px;">
                                                {{trans('message.pages.logs_management.login_logs.user_name')}}
                                                / {{trans('message.pages.logs_management.login_logs.user_email')}}
                                            </th>
                                            <th width="150px;">
                                                {{trans('message.pages.logs_management.action_logs.ip_address')}}
                                            </th>
                                            <th width="400px;">
                                                {{trans('message.pages.logs_management.action_logs.device_name')}}
                                            </th>
                                            <th width="150px">
                                                {{trans('message.pages.logs_management.action_logs.date')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th scope=row {{setFont()}}>{{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}</th>
                                                <td>
                                                    @if(isset($data->user->full_name))
                                                        @if(\Illuminate\Support\Facades\Auth::user()->id == $data->user_id)
                                                            <strong class="badge badge-secondary {{setFont()}}">{{getLan() == 'np' ? 'तपाई' : 'You'}}</strong>
                                                        @else
                                                            {{$data->user->full_name}}
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    {{$data->log_in_ip}}
                                                </td>

                                                <td>
                                                    {{$data->log_in_device}}
                                                </td>

                                                <td>
                                                    @if(getLan() =='np')
                                                        {{$data->log_in_date_np}}
                                                    @else
                                                        {{$data->log_in_date}}
                                                    @endif

                                                    &nbsp; &nbsp; <span class="badge badge-secondary"> <i
                                                                class="far fa-clock"> </i> {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div style="padding-top: 20px">
                                            <span class="fa-pull-left">
                                                Showing {{($results->currentpage()-1)*$results->perpage()+1}} to {{$results->currentpage()*$results->perpage()}}
                                        of  {{$results->total()}} entries
                                            </span>
                                        <span class="float-right {{setFont()}}">
                                                {{ $results->appends(request()->except('page'))->links() }}
                                             </span>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            @else
                                <div class="col-md-12 {{setFont()}}"
                                     style="padding-top: 10px"
                                >
                                    <label class="form-control badge badge-pill"
                                           style="text-align:  center; font-size: 18px;"
                                    >
                                        <i class="fas fa-ban" style="margin-top: 6px"></i>
                                        {{trans('message.commons.no_record_found')}}
                                    </label>
                                </div>

                            @endif
                        </div>

                        <!-- /.card -->
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    @include('backend.logs.login_log_search_modal')
    @include('backend.modal.check_data_modal')
    @include('backend.modal.technical-error-modal')
@endsection
