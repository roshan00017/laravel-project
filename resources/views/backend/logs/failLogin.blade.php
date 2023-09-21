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
                                {{$page_title}}
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
                            <div class="card-header"
                                 style="text-align:center"
                            >
                                <a href="{{url($page_url)}}"
                                   class="btn btn-secondary btn-sm rounded-pill float-left  boxButton {{setFont()}}"
                                   data-toggle="tooltip"
                                   title="List"
                                >
                                    <i class="fa fa-list"></i>
                                    {{trans('message.pages.logs_management.login_failed_logs.page_title')}}
                                    {{trans('message.button.list')}}
                                </a>

                                <a href="" class="btn btn-info rounded-pill btn-sm float-right {{setFont()}}"
                                   data-toggle="modal"
                                   data-target="#searchModal"
                                   title="Filter"
                                >
                                    <i class="fas fa-filter"></i>
                                    {{trans('message.button.filter')}}
                                </a>
                                @if( $request->from_date !=null || $request->to_date !=null)
                                    <strong>  {{trans('message.pages.logs_management.login_failed_logs.total_login_failed')}} </strong>
                                    <strong
                                            style="font-size: 16px; color: #FF0000;">{{$totalLogs}}</strong>
                                    <a href="{{url($page_url)}}"
                                       class="btn btn-secondary btn-sm rounded-pill float-right boxButton {{setFont()}}">
                                        <i class="fas  fa-undo"></i> {{trans('message.button.reload')}}
                                    </a>
                                @endif

                            </div>
                            <!-- /.col -->
                        </div>

                    </div>
                    <!-- /.card-header -->
                    @if(sizeof($results) > 0 )
                        <div class="card">
                            <div class="card-body">
                                <table id="example2"
                                       class="table table-bordered table-striped dataTable dtr-inline"
                                >
                                    <thead class="th-header">
                                    <tr class="{{setFont()}}">
                                        <th width="20px;">
                                            {{trans('message.commons.s_n')}}
                                        </th>
                                        <th width="200px;">
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
                                        <th width="120px">    {{ trans('message.pages.users_management.block_status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $key=>$data)
                                        <tr>
                                            <th scope="row {{setFont()}}">
                                                {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                            </th>
                                            <td>
                                                @if(\Illuminate\Support\Facades\Auth::user()->id == $data->user_id)
                                                    <strong class="badge badge-secondary {{setFont()}}">{{getLan() == 'np' ? 'तपाई' : 'You'}}</strong>
                                                @elseif($data->user_id !=null)
                                                    {{$data->user_name}}
                                                @else
                                                    {{$data->user_name}}   <strong class="badge badge-info"> Unknown
                                                        User</strong>
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
                                                    {{$data->log_fails_date_np}}
                                                @else
                                                    {{$data->log_fails_date}}
                                                @endif

                                                &nbsp; &nbsp; <span class="badge badge-secondary"> <i
                                                            class="far fa-clock"> </i> {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($data->login_fail_count == systemSetting()->login_attempt_limit)
                                                    <button type="button" class="btn btn-danger rounded-pill btn-xs {{setFont()}}"
                                                            data-toggle="modal"
                                                            data-target="#blockStatusModal{{$key}}"
                                                            title="Click here update  status">
                                                        {{trans('message.button.yes')}}
                                                    </button>

                                                @else

                                                    <strong
                                                            class="btn btn-secondary rounded-pill btn-xs {{setFont()}}"
                                                    >
                                                        {{trans('message.button.no')}}
                                                    </strong>
                                                @endif
                                            </td>
                                            <!-- block status  modal start -->
                                            <div class="modal fade"
                                                 id="blockStatusModal{{$key}}"
                                                 aria-hidden="true"
                                                 data-keyboard="false"
                                                 data-backdrop="static"
                                            >
                                                <div class="modal-dialog {{getLan() =='np' ? 'modal-dialog-centered': 'modal-sm modal-dialog-centered'}}">
                                                    <div class="modal-content text-center modal-content-radius">
                                                        <div class="modal-header btn-primary rounded-pill">
                                                            <h4 class="modal-title {{setFont()}}">
                                                                @if(systemSetting())
                                                                    {{getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
                                                                @else
                                                                    {{trans('message.pages.common.app_short_name')}}
                                                                @endif
                                                            </h4>
                                                            <button type="button"
                                                                    class="close"
                                                                    data-dismiss="modal"
                                                                    aria-label="Close"
                                                            >
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        @if($data->user_id !=null)
                                                            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>['users/block_status/'.$data->user_id]]) !!}
                                                        @else
                                                            {!! Form::open(['method' => 'POST', 'class'=>'inline', 'url'=>['logs/ip_block/'.$data->id]]) !!}
                                                        @endif
                                                        <div class="modal-body">
                                                            @if($data->user_id !=null)
                                                                <h5 class="{{setFont()}}">
                                                                    {{getLan() == 'np' ? 'छानिएको प्रयोगकर्तालाई अनब्लक  खोज्नु भएको हो ? ' : 'Are you looking to unblock selected users?' }}
                                                                </h5>
                                                            @else
                                                                <h5 class="{{setFont()}}">
                                                                    {{getLan() == 'np' ? 'छानिएको आईपी ​​ठेगानालाई अनब्लक  खोज्नु भएको हो ? ' : 'Are you sure you want to ip address unblock?' }}
                                                                </h5>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer justify-content-center {{setFont()}}"">
                                                            <button type="submit"
                                                                    class="btn btn-primary rounded-pill"
                                                            >
                                                                <i class="fa fa-check-circle"></i>
                                                                {{trans('message.button.yes')}}
                                                            </button> &nbsp; &nbsp;
                                                            <button type="button"
                                                                    class="btn btn-danger rounded-pill"
                                                                    data-dismiss="modal"
                                                            >
                                                                <i class="fa fa-times-circle"></i>
                                                                {{trans('message.button.no')}}
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="padding-top: 20px">
                                            <span class="fa-pull-left">
                                                Showing {{($results->currentpage()-1)*$results->perpage()+1}} to {{$results->currentpage()*$results->perpage()}}
                                        of  {{$results->total()}} entries
                                            </span>
                                    <span class="float-right"> {{ $results->appends(request()->except('page'))->links() }}
                                             </span>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <!-- /.card-body -->

                        </div>
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
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    @include('backend.logs.failed_login_search_modal')
    @include('backend.modal.check_data_modal')
    @include('backend.modal.technical-error-modal')

@endsection
