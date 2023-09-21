@extends('backend.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                            {{ trans('setting.sub_page_title') }}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right {{ setFont() }}">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    {{ trans('message.dashboard.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">
                                    {{ trans('setting.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="#">
                                    {{ trans('setting.sub_page_title') }}
                                </a>
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
                                <a href="{{ url($page_url) }}"
                                    class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{ setFont() }}"
                                    data-toggle="tooltip" title="{{ trans('message.button.list') }}">
                                    <i class="fa fa-list"></i>
                                    {{ trans('message.button.list') }}
                                </a>

                                @if (allowAdd())
                                    <button
                                        class="btn btn-primary btn-sm float-left boxButton rounded-pill {{ setFont() }}"
                                        data-toggle="modal" data-target="#addModal"
                                        title="{{ trans('message.button.add_new') }}">
                                        <i class="fa fa-plus-circle"></i>
                                        {{ trans('message.button.add_new') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card">
                            @if (sizeof($results) > 0)
                                <!-- /.card-header -->
                                <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead class="th-header">
                                        <tr class="{{ setFont() }}">
                                            <th width="10px">
                                                {{ trans('message.commons.s_n') }}
                                            </th>

                                            <th>
                                                {{ trans('message.pages.mst_document_type.code') }}
                                            </th>
                                            <th>
                                                {{ trans('message.pages.mst_document_type.name_en') }}
                                            </th>


                                            <th>
                                                {{ trans('message.commons.status') }}
                                            </th>

                                            <th width="10%">
                                                {{ trans('message.commons.action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results as $key => $data)
                                            <tr>
                                                <th scope=row {{ setFont() }}>
                                                    {{ ($results->currentpage() - 1) * $results->perpage() + $key + 1 }}
                                                </th>
                                                <td>
                                                    @if (isset($data->code))
                                                        {{ $data->code }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($data->name_np))
                                                        {{ getLan() == 'np' ? $data->name_np : $data->name_en }}
                                                    @endif
                                                </td>


                                                <td class="{{ setFont() }}">
                                                    @include('backend.components.buttons.status')
                                                </td>
                                                <td>
                                                    @include('backend.components.buttons.action')

                                                </td>
                                            </tr>
                                            @include('backend.modal.status_modal')
                                            @include('backend.modal.delete_modal')
                                            @include('backend.masterSettings.setting.editModal')
                                        @endforeach
                                    </tbody>
                                </table>
                                <span class="float-right" style="margin-top: 20px !important;">
                                    {{ $results->appends(request()->except('page'))->links() }}
                                </span>
                        </div>
                    @else
                        <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                            <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{ trans('message.commons.no_record_found') }}
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
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
        @include('backend.masterSettings.setting.addModal')
        @include('backend.basicDetails.suggestionCategory.serachModal')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.check_data_modal')

        <!-- /.content-wrapper -->

    @endsection
