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
                        {{trans('message.pages.hr_designation.page_title')}}
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
                            <a href="javascript:void(0);">
                                {{trans('message.pages.hr_designation.basic_detail')}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            {{trans('message.pages.hr_designation.page_title')}}
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
                        <div class="card-header" style="text-align:right">
                            <a href="{{url($page_url)}}" class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}" data-toggle="tooltip" title="{{trans('message.button.list')}}">
                                <i class="fa fa-list"></i>
                                {{trans('message.button.list')}}
                            </a>
                            @if(allowAdd())
                            <button class="btn btn-primary btn-sm float-left boxButton rounded-pill {{setFont()}}" data-toggle="modal" data-target="#addModal" title="{{trans('message.button.add_new')}}">
                                <i class="fa fa-plus-circle"></i>
                                {{trans('message.button.add_new')}}
                            </button>
                            @endif
                            <button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}" data-toggle="modal" data-target="#searchModal" title="{{ trans('message.button.filter') }}">
                                <i class="fas fa-filter"></i>
                                {{ trans('message.button.filter') }}
                            </button>


                            @if( $request->code !=null || $request->status !=null)

                            <a href="{{url(@$page_url)}}" class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}" title="{{ trans('message.button.reload') }}">
                                <i class="fas  fa-undo"></i>
                                {{ trans('message.button.reload') }}
                            </a>

                            @endif
                        </div>
                    </div>
                    <div class="card">
                        @if(sizeof($results) > 0)
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                                <thead class="th-header">
                                    <tr class="{{setFont()}}">
                                        <th width="10px">
                                            {{trans('message.commons.s_n')}}
                                        </th>

                                        <th>
                                            {{trans('message.pages.hr_designation.code')}}
                                        </th>
                                        <th>
                                            {{ getLan() =='np' ? trans('message.pages.hr_designation.emp_name_np'):trans('message.pages.hr_designation.emp_name_en')}}
                                        </th>
                                        <th>
                                            {{ getLan() =='np' ? trans('message.pages.hr_designation.em_post'):trans('message.pages.hr_designation.em_post')}}
                                        </th>
                                        <th>
                                            {{trans('message.pages.hr_designation.description')}}
                                        </th>
                                        <th width="10%">
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
                                        <th scope="row {{setFont()}}">
                                            {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                        </th>

                                        <td class="{{setFont()}}">
                                            {{ $data->code}}
                                        </td>
                                        <td>
                                            {{ getLan() =='np' ? $data->name_np: $data->name_en}}

                                        </td>
                                        <td>
                                            {{$data->emp_post}}

                                        </td>
                                        <td>
                                            @if(isset($data->description))
                                            {{$data->description}}
                                            @endif
                                        </td>
                                        <td class="{{setFont()}}">
                                            @include('backend.components.buttons.status')
                                        </td>
                                        <td>
                                            @include('backend.components.buttons.action')

                                        </td>
                                    </tr>
                                    @include('backend.modal.status_modal')
                                    @include('backend.basicDetails.hrDesignation.show')
                                    @include('backend.modal.delete_modal')
                                    @include('backend.basicDetails.hrDesignation.edit')
                                    @endforeach
                                </tbody>
                            </table>
                            <span class="float-right {{setFont()}}">
                                {{ $results->appends(request()->except('page'))->links() }}
                            </span>
                        </div>

                        @else
                        <div class="col-md-12 {{setFont()}}" style="padding-top: 10px">
                            <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{trans('message.commons.no_record_found')}}
                            </label>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
</div>

@include('backend.basicDetails.hrDesignation.add')
@include('backend.basicDetails.hrDesignation.search')
@include('backend.modal.technical-error-modal')
@include('backend.modal.data-submit-modal')
</section>

@endsection