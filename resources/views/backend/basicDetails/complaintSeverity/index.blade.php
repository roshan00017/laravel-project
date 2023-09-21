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
                        {{ trans('severityType.severityType.title') }}
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
                            {{ trans('severityType.severityType.title') }}
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
                                 style="text-align:right"
                                >       <a href="{{url($page_url)}}"
                                                class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
                                    data-toggle="tooltip"
                                    title="{{trans('message.button.list')}}"
                                    >
                                        <i class="fa fa-list"></i>
                                        {{trans('message.button.list')}}
                                    </a>
                                                                                
                                            @if(allowAdd())

                                                @if(@$create_menu ==true)

                                                    <a href="{{url(@$page_url .'/create')}}"
                                                    class="btn btn-primary btn-sm float-left boxButton boxButton rounded-pill {{setFont()}}"
                                                    title="{{trans('message.button.add_new')}}"
                                                    >
                                                        <i class="fa fa-plus-circle"></i>
                                                        {{trans('message.button.add_new')}}
                                                    </a>
                                                @else
                                                    <button
                                                            class="btn btn-primary btn-sm float-left boxButton rounded-pill {{setFont()}}"
                                                            data-toggle="modal"
                                                            data-target="#addModal"
                                                            title="{{trans('message.button.add_new')}}"
                                                    >
                                                        <i class="fa fa-plus-circle"></i>
                                                        {{trans('message.button.add_new')}}
                                                    </button>

                                                @endif
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
                                            <th width="10px">
                                                {{trans('message.commons.s_n')}}
                                            </th>

                                            <th>
                                                {{trans('message.pages.common.code')}}
                                            </th>
                                            <th>
                                                {{trans('severityType.severityType.severity_name')}}
                                            </th>
                                                  <th width="15%">
                                                {{trans('severityType.severityType.depth')}}
                                            </th>
                                            <th width="15%">
                                                {{trans('message.commons.status')}}
                                            </th>
                                            <th width="12%">
                                                {{trans('message.commons.action')}}
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
                                                    @if(isset($data->code))
                                                        {{$data->code}}
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ getLan()=='np' ? $data->name_ne : $data->name}}
                                                 </td>
                                                       
                                                <td>
                                                    {{$data->depth}}
                                                </td>


                                                <td class="{{setFont()}}">
                                                    @include('backend.components.buttons.status')
                                                </td>

                                                <td>
                                                    @include('backend.components.buttons.action')

                                                </td>
                                            </tr>
                                            @include('backend.modal.status_modal')

                                            @include('backend.modal.delete_modal')
                                            @include('backend.basicDetails.complaintSeverity.edit')
                                        @endforeach
                                        </tbody>
                                        {{-- @include('backend.basicDetails.complaintType.show') --}}
                                    </table>
                                    <span
                                            class="float-right"
                                            style="margin-top: 20px !important;"
                                    >
                                    {{ $results->appends(request()->except('page'))->links() }}
                                </span>
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
                                <!-- /.card -->
                        @endif
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.row -->
            </div>  
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
        @include('backend.components.commonSearchModal')
        @include('backend.basicDetails.complaintSeverity.add')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.check_data_modal')
    </div>

    <!-- /.content-wrapper -->
@endsection