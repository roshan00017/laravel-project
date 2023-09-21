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

                            <a href="{{url($page_url)}}" class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}" data-toggle="tooltip" title="{{trans('message.button.list')}}">
                                <i class="fa fa-list"></i>
                                {{trans('message.button.list')}}
                            </a>

                            <button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}" data-toggle="modal" data-target="#searchModal" title="{{ trans('message.button.filter') }}">
                                <i class="fas fa-filter"></i>
                                {{ trans('message.button.filter') }}
                            </button>
                            @if( $request->from_date !=null || $request->to_date !=null || $request->dispatch_no !=null
                            || $request->regd_no !=null || $request->letter_no !=null || $request->letter_sub !=null)

                            <a href="{{url(@$page_url)}}" class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}" title="{{ trans('message.button.reload') }}">
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
                            <table id="" class="table table-bordered table-striped dataTable dtr-inline">
                                <thead class="th-header">
                                    <tr class="{{setFont()}}">
                                        <th width="10px">
                                            {{trans('message.commons.s_n')}}
                                        </th>
                                        <th>
                                            {{trans('dcDocument.dc_document.registration_date')}}
                                        </th>
                                        <th>
                                            {{trans('dcDocument.dc_document.registration_number')}}
                                        </th>
                                        <th>
                                            {{trans('dcDocument.dc_document.letter_topic')}}
                                        </th>
                                        <th>
                                            {{trans('dcDocument.dc_document.fiscal_year')}}
                                        </th>
                                        <th style="width: 100px;">
                                            {{ trans('message.commons.action') }}
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
                                            {{ getLan() =='np' ? $data->regd_date_bs : $data->regd_date_ad }}

                                        </td>
                                        <td>
                                            @if(isset($data->regd_no))
                                            {{ $data->regd_no }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($data->letter_sub))
                                            {{ $data->letter_sub }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($data->fiscalYear))
                                            {{ $data->fiscalYear->code }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route($page_route.'.'.'show', hashIdGenerate( $data->id))}}" class="btn btn-secondary btn-xs rounded-pill {{setFont()}}" title="{{trans('message.button.show')}}">
                                                <i class="fas fa-eye"></i>

                                            </a>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>

                        </div>
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
@include('backend.edmis.dcDocument.add')
@include('backend.modal.technical-error-modal')
@include('backend.edmis.dcDocument.search')
@endsection