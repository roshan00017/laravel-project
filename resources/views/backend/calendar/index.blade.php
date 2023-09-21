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
                                <a href="{{url('/dashboard')}}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    {{ trans('message.dashboard.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{$page_title}}
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
                            >
                                <a href="{{url($page_url)}}"
                                   class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
                                   data-toggle="tooltip"
                                   title="{{trans('message.button.list')}}"
                                >
                                    <i class="fa fa-list"></i>
                                    {{trans('message.button.list')}}
                                </a>

                                <button
                                        class="btn btn-primary btn-sm float-left boxButton rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#addCalendarModal"
                                        title="{{trans('message.button.add_new')}}"
                                >
                                    <i class="fa fa-plus-circle"></i>
                                    {{trans('message.button.add_new')}}
                                </button>
                                @include('backend.calendar.add')

                                <button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#filterCalendarModal"
                                        title="{{ trans('message.button.filter') }}">
                                    <i class="fas fa-filter"></i>
                                    {{ trans('message.button.filter') }}
                                </button>
                                @include('backend.calendar.filter')

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            @if(sizeof($results) > 0)
                                <div class="card-body">
                                    <table id=""
                                           class="table table-bordered table-striped dataTable dtr-inline"
                                    >
                                        <thead class="th-header">
                                        <tr class="{{setFont()}}">
                                            <th width="10px">
                                                {{trans('message.commons.s_n')}}
                                            </th>

                                            <th>
                                                {{trans('calendar.year')}}
                                            </th>

                                            <th>
                                                {{trans('calendar.month')}}
                                            </th>

                                            <th>
                                                {{trans('calendar.week_day')}}
                                            </th>

                                            <th width="15%">
                                                {{trans('calendar.day')}}
                                            </th>

                                            <th width="15%">
                                                {{trans('message.commons.action')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr class="{{setFont()}}">
                                                <th scope=row {{setFont()}}>
                                                    {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                                </th>

                                                <td class="f-kalimati">
                                                    {{$data->fy_code}}
                                                </td>

                                                <td>
                                                    {{getLan()=='np'?$data->month->name_np:$data->month->name_en}}
                                                </td>

                                                <td>
                                                    {{getLan()=='np'?$data->weekDays->name_np:$data->weekDays->name_en}}
                                                </td>

                                                <td>
                                                    {{$data->day}}
                                                </td>

                                                <td>
                                                    <button type="button"
                                                            class="btn btn-info btn-xs rounded-pill {{setFont()}}"
                                                            data-toggle="modal"
                                                            data-target="#editCalendarModal{{$key}}"
                                                            data-placement="top"
                                                            title="{{trans('message.button.edit')}}"
                                                    >
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    @include('backend.calendar.edit')
                                                    &nbsp;
                                                    <button type="button"
                                                            class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{$key}}"
                                                            data-placement="top"
                                                            title="{{trans('message.button.delete')}}"
                                                    >
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('backend.modal.delete_modal')

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <span
                                            class="float-right {{setFont()}}"
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
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.data-submit-modal')
    </div>

    <!-- /.content-wrapper -->

@endsection
