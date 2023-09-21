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
                            {{$page_title}}
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
                                <a href="{{url($page_url)}}">
                                    {{$page_title}}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{ trans('message.button.list') }}
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
                                   title="{{trans('message.button.list')}}"
                                >
                                    <i class="fa fa-list"></i>
                                    {{trans('message.button.list')}}
                                </a>

                                <button class="btn btn-info btn-sm float-right boxButton rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#searchModal"
                                        title="{{ trans('message.button.filter') }}">
                                    <i class="fas fa-filter"></i>
                                    {{ trans('message.button.filter') }}
                                </button>
                                @if(sizeof($results) > 0)


                                <button class="btn btn-success  btn-sm float-right rounded-pill boxButton "
                                        onclick="exportpatraTableToExcel('patratblData')"><i class='fa fa-print'></i>
                                    XLS
                                </button>

                                <button class="btn btn-danger  btn-sm float-right rounded-pill boxButton"
                                        data-toggle="modal" data-target=" #patraModel "><i class='fa fa-print'></i> PDF
                                </button>
                                @endif

                                @if( $request->fy_code !=null || $request->from_date !=null || $request->to_date !=null ||
                                $request->ward !=null  || $request->employee_id !=null || $request->department_id !=null
                                 || $request->user_id != null
                                )

                                    <a href="{{url(@$page_url)}}"
                                       class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}"
                                       title="{{ trans('message.button.reload') }}"
                                    >
                                        <i class="fas  fa-undo"></i>
                                        {{ trans('message.button.reload') }}
                                    </a>

                                @endif


                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            @if(sizeof($results) > 0)
                                <div class="box">
                                    <div class="box-header">
                                        <h2 class="" style="font-size:20px; margin-top:0px; margin-bottom:0px;">
                                            <th>
                                                {{trans('dcDocument.dc_document.title')}}
                                            </th>
                                        </h2>
                                    </div>
                                    <div class="box-body">

                                        <div id="patratblData">

                                            <table id=""
                                                   class="table table-bordered table-striped dataTable dtr-inline"
                                            >
                                                <thead class="th-header">
                                                <tr class="{{setFont()}}">
                                                    <th width="10px">
                                                        {{trans('message.commons.s_n')}}
                                                    </th>
                                                    <th>
                                                        {{trans('dcDocument.dc_document.fiscal_year')}}
                                                    </th>
                                                    <th>
                                                        {{trans('dcDocument.dc_document.registration_number')}}
                                                    </th>
                                                    <th>
                                                        {{trans('dcDocument.dc_document.registration_date')}}
                                                    </th>
                                                    <th>
                                                        {{trans('dcDocument.dc_document.letter_topic')}}
                                                    </th>
                                                    <th>
                                                        {{trans('dcDocument.dc_document.action')}}
                                                    </th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>

                                    </div>

                                </div>

        </section>

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
    <!-- /.row -->
    </div>
    </div>
    </section>

    <!-- /.container-fluid -->
    <!-- /.content -->
    </div>
    @include('backend.modal.technical-error-modal')
    @include('backend.edmis.report.patra.searchModal')
    @include('backend.edmis.report.patra.patraModel')
@endsection