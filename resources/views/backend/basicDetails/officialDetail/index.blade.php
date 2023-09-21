@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 {{setFont()}}">
                        {{trans('officialDetails.title')}}
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
                                {{trans('message.commons.basicDetails')}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            {{trans('officialDetails.title')}}
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
                            <a href="{{url($page_url)}}"
                                class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
                                data-toggle="tooltip" title="{{trans('message.button.list')}}">
                                <i class="fa fa-list"></i>
                                {{trans('message.button.list')}}
                            </a>

                            <button class="btn btn-primary btn-sm float-left boxButton rounded-pill {{setFont()}}"
                                data-toggle="modal" data-target="#addModal" title="{{trans('message.button.add_new')}}">
                                <i class="fa fa-plus-circle"></i>
                                {{trans('message.button.add_new')}}
                            </button>
                            <button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}"
                                data-toggle="modal" data-target="#searchModal"
                                title="{{ trans('message.button.filter') }}">
                                <i class="fas fa-filter"></i>
                                {{ trans('message.button.filter') }}
                            </button>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card">

                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                                <thead class="th-header">
                                    <tr class="{{setFont()}}">
                                        <th width="10px">
                                            {{trans('message.commons.s_n')}}
                                        </th>

                                        <th>
                                            {{ trans('officialDetails.present/past')}}
                                        </th>
                                        <th>
                                            {{ getLan() =='np' ? trans('officialDetails.name_np'):trans('officialDetails.name_en')}}
                                        </th>

                                        <th>
                                            {{trans('officialDetails.termCommencementDate')}}
                                        </th>
                                        <th>
                                            {{trans('officialDetails.termEndedDate')}}
                                        </th>
                                        <th>
                                            {{trans('officialDetails.email')}}
                                        </th>
                                        <th>
                                            {{trans('officialDetails.mobile')}}
                                        </th>

                                        <th width="10%">
                                            {{trans('message.commons.status')}}
                                        </th>

                                        <th width="8%">
                                            {{trans('message.commons.action')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="{{setFont()}}">
                                        <th>
                                            1
                                        </th>

                                        <td>
                                            Haal ko
                                        </td>
                                        <td>
                                            Dev Narayan Chaudhari
                                        </td>

                                        <td>
                                            2023/05/10
                                        </td>
                                        <td>
                                            2023/05/15
                                        </td>
                                        <td>
                                            dev@gmail.com
                                        </td>
                                        <td>
                                            9808524690
                                        </td>
                                        <td>
                                            Active
                                        </td>
                                        <td>
                                            <!-- <i class="fa fa-heart" style="font-size:12px"></i>
                                            <i class="fa fa-times" style="font-size:12px"></i>
                                            <i class="fa fa-eye" style="font-size:12px"></i> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                            <!-- <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{ trans('message.commons.no_record_found') }}
                            </label> -->
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.basicDetails.officialDetail.search')
    @include('backend.modal.technical-error-modal')
    @include('backend.modal.data-submit-modal')
</div>
@endsection