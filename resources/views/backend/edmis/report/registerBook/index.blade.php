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
                        <div class="card-header" style="text-align:center">
                            <a href="{{url($page_url)}}"
                                class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
                                data-toggle="tooltip" title="{{trans('message.button.list')}}">
                                <i class="fa fa-list"></i>
                                {{trans('message.button.list')}}
                            </a>
                            <button class="btn btn-info btn-sm float-right rounded-pill boxButton {{setFont()}}"
                                data-toggle="modal" data-target="#searchModal"
                                title="{{ trans('message.button.filter') }}">
                                <i class="fas fa-filter"></i>
                                {{ trans('message.button.filter') }}
                            </button>
                            @if(sizeof($results) > 0)
                            <button class="btn btn-success  btn-sm float-right rounded-pill boxButton"
                                onclick="exportdartaTableToExcel('dartatblData')"><i class='fa fa-print'></i>
                                XLS</button>
                            <button class="btn btn-danger  btn-sm float-right rounded-pill boxButton"
                                data-toggle="modal" data-target=" #dartaModel "><i class='fa fa-print'></i> PDF</button>
                            @endif

                            @if( $request->fy_code !=null || $request->from_date !=null || $request->to_date !=null ||
                            $request->ward !=null || $request->employee_id !=null || $request->department_id !=null
                            || $request->user_id != null
                            )

                            <a href="{{url(@$page_url)}}"
                                class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}"
                                title="{{ trans('message.button.reload') }}">
                                <i class="fas  fa-undo"></i>
                                {{ trans('message.button.reload') }}
                            </a>

                            @endif


                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card">
                        @if(sizeof($results) > 0)
                        <div class="card-body">
                            <div id="dartatblData">
                                <table id="" class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead class="th-header">
                                        <tr class="{{setFont()}}">
                                            <th width="10px">
                                                {{ trans('message.commons.s_n') }}
                                            </th>

                                            <th>
                                                {{ trans('dartaKitab.dc_register_book.invoice_no') }}
                                            </th>

                                            <th>
                                                {{ trans('dartaKitab.dc_register_book.Registration_no') }}
                                            </th>

                                            <th>
                                                {{getLan() =='np' ? trans('dartaKitab.dc_register_book.Date_of_Registration_np'): trans('dartaKitab.dc_register_book.Date_of_Registration_en') }}
                                            </th>

                                            <th style="display: none;">
                                                {{ trans('dartaKitab.dc_register_book.Date_of_Registration_en') }}
                                            </th>

                                            <th>
                                                {{ trans('dartaKitab.dc_register_book.letter_no') }}
                                            </th>

                                            <th>
                                                {{ trans('dartaKitab.dc_register_book.ward_No') }}
                                            </th>

                                            <th>
                                                {{ trans('dartaKitab.dc_register_book.subject_of_the_letter') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($results as $key=>$data)
                                        <tr>
                                            <th scope="row {{setFont()}}">
                                                {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                            </th>


                                            <td>

                                                {{$data->dispatch_no}}

                                            </td>
                                            <td>
                                                {{$data->regd_no}}

                                            </td>

                                            <td>
                                                {{ getLan() =='np' ? $data->regd_date_bs : $data->regd_date_ad }}

                                            </td>
                                            <td>
                                                {{$data->letter_no}}

                                            </td>

                                            <td>
                                                {{$data->ward_no}}

                                            </td>
                                            <td>
                                                {{$data->letter_sub}}

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div style="padding-top: 20px">

                                </div>
                            </div>
                            <!-- /.card-body -->
                    <!-- /.card-body -->

                    @else
                    <div class="col-md-12 {{setFont()}}" style="padding-top: 10px">
                        <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                            <i class="fas fa-ban" style="margin-top: 6px"></i>
                            {{trans('message.commons.no_record_found')}}
                        </label>
                    </div>
                    @endif
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
</section>
<!-- /.container-fluid -->
<!-- /.content -->
</div>
@include('backend.modal.technical-error-modal')
@include('backend.edmis.report.registerBook.searchModal')
@include('backend.edmis.report.registerBook.dartaModel')
@endsection
