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
                            {{ $page_title }}
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
                                    {{ $page_title }}
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
                            <div class="card-header" style="text-align:right">

                                <a href="{{ url($page_url) }}"
                                    class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{ setFont() }}"
                                    data-toggle="tooltip" title="{{ trans('message.button.list') }}">
                                    <i class="fa fa-list"></i>
                                    {{ trans('message.button.list') }}
                                </a>

                                <button class="btn btn-info btn-sm float-right rounded-pill {{ setFont() }}"
                                    data-toggle="modal" data-target="#searchModal"
                                    title="{{ trans('message.button.filter') }}">
                                    <i class="fas fa-filter"></i>
                                    {{ trans('message.button.filter') }}
                                </button>

                                @if ($request->meeting_id != null)
                                    <a href="{{ url(@$page_url) }}"
                                        class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{ setFont() }}"
                                        title="{{ trans('message.button.reload') }}">
                                        <i class="fas  fa-undo"></i>
                                        {{ trans('message.button.reload') }}
                                    </a>
                                @endif

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
                        <!-- /.card-header -->
                        <div class="card">
                            @if (sizeof($results) > 0)
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                                        <thead class="th-header">
                                            <tr class="{{ setFont() }}">
                                                <th width="10px">
                                                    {{ trans('message.commons.s_n') }}
                                                </th>

                                                <th>
                                                    {{ trans('message.pages.meeting_member.meeting_code') }}
                                                </th>
                                                <th>
                                                    {{ trans('meeting.final_verdict.file') }}
                                                </th>
                                                <th>
                                                    {{ trans('meeting.final_verdict.is_final') }}
                                                </th>
                                                <!-- <th>
                                                                    {{ trans('meeting.final_verdict.remarks') }}
                                                                        </th> -->
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
                                                        @if (isset($data->meeting->code))
                                                            {{ $data->meeting->code }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($data->meeting_status_id != 5)
                                                            @if ($data->files != null)
                                                                @php
                                                                    $fileNames = explode(',', $data->files);
                                                                @endphp
                                                                @foreach ($fileNames as $fileName)
                                                                    <a href="{{ URL::to('/storage/' . $filePath . '/' . $fileName) }}"
                                                                        target="_blank"
                                                                        class="btn btn-secondary btn-xs rounded-pill"
                                                                        data-placement="top"
                                                                        title="{{ trans('message.pages.common.viewFile') }}">
                                                                        <i class="fa fa-file"></i>
                                                                    </a>
                                                                    &nbsp;
                                                                    <a href="{{ URL::to('/storage/' . $filePath . '/' . $fileName) }}"
                                                                        class="btn btn-danger btn-xs rounded-pill {{ setFont() }}"
                                                                        download data-toggle="tooltip"
                                                                        title="Download File">
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                    <br> <!-- Add line break between files -->
                                                                @endforeach
                                                            @else
                                                                N/A
                                                            @endif
                                                        @endif
                                                    </td>

                                                    <td class="{{ setFont() }}" style="width: 180px">
                                                        @include('backend.meetingManagement.finalVerdictFile.fileFinalize.fileStatusUpdate')
                                                    </td>
                                                    <td>
                                                        &nbsp;
                                                        @if (allowEdit() && $data->meeting->meeting_status_id != 5)
                                                            <button type="button"
                                                                class="btn btn-info btn-xs rounded-pill {{ setFont() }}"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $key }}"
                                                                data-placement="top"
                                                                title="{{ trans('message.button.edit') }}">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                        @endif

                                                        &nbsp;
                                                        @if (allowDelete() && $data->meeting->meeting_status_id != 5)
                                                            <button type="button"
                                                                class="btn btn-danger btn-xs rounded-pill {{ setFont() }}"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $key }}"
                                                                data-placement="top"
                                                                title="{{ trans('message.button.delete') }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif

                                                    </td>
                                                </tr>
                                                @include('backend.modal.delete_modal')
                                                @include('backend.meetingManagement.finalVerdictFile.show')
                                                @include('backend.meetingManagement.finalVerdictFile.fileFinalize.fileFinalizeModal')
                                                @include('backend.meetingManagement.finalVerdictFile.edit')
                                            @endforeach
                                        </tbody>

                                    </table>
                                    <span class="float-right" style="margin-top: 20px !important;">
                                        {{ $results->appends(request()->except('page'))->links() }}
                                    </span>
                                </div>
                            @else
                                <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                                    <label class="form-control badge badge-pill"
                                        style="text-align:  center; font-size: 18px;">
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
                <!-- /.row -->
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
        @include('backend.meetingManagement.finalVerdictFile.add')
        @include('backend.meetingManagement.finalVerdictFile.search')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.check_data_modal')
        @include('backend.modal.data-submit-modal')
    </div>

    <!-- /.content-wrapper -->




@endsection
