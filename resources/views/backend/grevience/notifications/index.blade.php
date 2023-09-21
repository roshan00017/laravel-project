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
                                @include('backend.grevience.notifications.list')
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
                                                {{ trans('notification.notify_date') }}
                                            </th>
                                            <th>
                                                {{ trans('notification.notify_type') }}
                                            </th>
                                            <th>
                                                {{ trans('notification.notify_title') }}
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
                                                    {{ getLan() == 'np' ? $data->notify_date_np : $data->notify_date_en }}
                                                </td>

                                                <td class="{{setFont()}}">
                                                    @if (isset($data->notify_type))
                                                        {{ notifyType($data->notify_type) }}
                                                    @endif
                                                </td>
                                                <td class="{{setFont()}}">
                                                    {{ getLan() == 'np' ? $data->title_np : $data->title_en }}
                                                </td>
                                                <td class="{{setFont()}}">
                                                    @if(isset($data->notification_read_date_en))
                                                        {{ trans('notification.seen') }}
                                                        @if(isset($data->readBy->full_name))
                                                            @if(userInfo()->id == $data->notify_read_by)
                                                                <strong class="badge badge-secondary {{setFont()}}">{{getLan() == 'np' ? 'तपाई' : 'You'}}</strong>
                                                            @else
                                                                {{$data->readBy->full_name}}
                                                            @endif
                                                        @endif
                                                        <i class="fa fa-calendar"></i> {{ getLan()=='np' ? $data->notification_read_date_np : $data->notification_read_date_en }}
                                                        <span class="badge badge-secondary rounded-pill"><i class="far fa-clock"> </i>
                                                        {{ \Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}

                                                    @else
                                                        {{ trans('notification.unseen') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (allowShow())
                                                        {{ Form::open(['url' => $data->notify_url, 'method' => 'GET'])}}
                                                        <input type="hidden" name="is_notify" value="true"/>
                                                        <button type="submit"
                                                                class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}"
                                                                title="{{ trans('message.button.show') }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        {{ Form::close() }}

                                                    @endif

                                                </td>
                                            </tr>
                                            @include('backend.grevience.notifications.show')
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
        @include('backend.grevience.notifications.search')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.check_data_modal')
    </div>

    <!-- /.content-wrapper -->




@endsection
