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
                            {{trans('message.pages.system_setting.api_setting.page_title')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right {{setFont()}}">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}">
                                    {{trans('message.dashboard.page_title')}}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="#">
                                    {{trans('message.pages.system_setting.api_setting.page_title')}}
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
                                   class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
                                   data-toggle="tooltip"
                                   title="List"
                                >
                                    <i class="fa fa-list"></i>
                                    {{$page_title}} {{trans('message.button.list')}}
                                </a>

                                <a href="" class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}"
                                   data-toggle="modal"
                                   data-target="#searchModal"
                                   title="Filter"
                                >
                                    <i class="fas fa-filter"></i>
                                    {{trans('message.button.filter')}}
                                </a>

                                @if( $request->api_key_id != null || $request->from_date != null || $request->to_date != null )
                                    <strong>   {{trans('Total Logs : ')}} </strong>  <strong
                                            style="font-size: 16px; color: #007bff;">{{$totalLogs}}</strong>
                                    <a href="{{url($page_url)}}"
                                       class="btn btn-secondary rounded-pill btn-sm float-right boxButton {{setFont()}}"
                                    >
                                        <i class="fas  fa-undo"></i>  {{trans('message.button.reload')}}
                                    </a>
                                @endif
                            </div>

                        </div>
                        <!-- /.card-header -->
                            <div class="card">
                                @if(sizeof($results) > 0)
                                <div class="card-body">
                                    <table id="format2"
                                           class="table table-bordered"
                                    >
                                        <thead class="th-header">
                                        <tr class="{{setFont()}}">
                                            <th width="10px;">
                                                {{trans('message.commons.s_n')}}
                                            </th>
                                            <th width="150px;">
                                                {{trans('message.pages.system_setting.api_setting.app_name')}}
                                            </th>
                                            <th width="150px;">
                                                {{trans('message.pages.logs_management.action_logs.ip_address')}}
                                            </th>
                                            <th width="150px;">
                                                {{trans('Url ')}}
                                            </th>
                                            <th width="150px;">
                                                {{trans('message.pages.logs_management.action_logs.date')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th scope=row {{setFont()}}>
                                                    {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                                </th>
                                                <td>
                                                    @if(isset($data->apiName->name))
                                                        {{$data->apiName->name}}
                                                    @endif

                                                </td>
                                                <td>
                                                    {{$data->ip_address}}
                                                </td>
                                                <td>
                                                    {{$data->url}}
                                                </td>
                                                <td>
                                                    {{$data->created_at}}

                                                    &nbsp; &nbsp; <span class="badge badge-secondary"><i class="far fa-clock"> </i>
                                                        {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                                    </span>
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
                                        <span class="float-right"> {{ $results->appends(request()->except('page'))->links() }}
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
                    </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    @include('backend.modal.technical-error-modal')
    @include('backend.apiSetting.api_access_logs_modal')
    <!-- /.content-wrapper -->

@endsection
