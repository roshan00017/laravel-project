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
                                @include('backend.grevience.suggestions.list')
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            @if (sizeof($results) > 0)
                                <div class="card-body">
                                    <table id="example2"
                                           class="table table-bordered table-striped dataTable dtr-inline">
                                        <thead class="th-header">
                                        <tr class="{{ setFont() }}">
                                            <th width="10px">
                                                {{ trans('message.commons.s_n') }}
                                            </th>

                                            <th>
                                                {{ trans('suggestion.date') }}
                                            </th>

                                            <th>
                                                {{ trans('suggestion.suggestion_type') }}
                                            </th>
                                            <th>
                                                {{ trans('suggestion.name') }}
                                            </th>
                                            <th>
                                                {{ trans('complaints.mobile_no') }}
                                            </th>
                                            <th>
                                                {{ trans('suggestion.email') }}
                                            </th>
                                            <th>
                                                {{ trans('suggestion.file') }}
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
                                                    {{ getLan() == 'np' ? $data->submit_date_np : $data->submit_date_en }}
                                                </td>
                                                <td>
                                                    {{ getLan() == 'np' ? $data->suggestion_categories->name : $data->suggestion_categories->name_ne }}

                                                </td>
                                                <td>
                                                    @if (isset($data->name))
                                                        {{ $data->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($data->mobile))
                                                        {{ $data->mobile }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($data->email))
                                                        {{ $data->email }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($data->files))
                                                        <a href="{{URL::to('/storage/'.$filePath.'/'.$data->files)}}"
                                                           target="_blank"
                                                           class="btn btn-secondary btn-xs rounded-pill"
                                                           data-placement="top"
                                                           title="{{trans('message.pages.common.viewFile')}}"
                                                        >
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="{{URL::to('/storage/'.$filePath.'/'.$data->files)}}"
                                                           class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                                                           download
                                                           data-toggle="tooltip"
                                                           title="Download File"
                                                        >
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (allowShow())
                                                        <a href="{{ route('suggestions.show', ['id' => hashIdGenerate($data->id)]) }}"
                                                           class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}"
                                                           title="{{ trans('message.button.show') }}">
                                                            <i class="fas fa-eye"></i>

                                                        </a>

                                                    @endif
                                                </td>

                                            </tr>
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
        @include('backend.grevience.suggestions.search')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.check_data_modal')
    </div>

    <!-- /.content-wrapper -->




@endsection
