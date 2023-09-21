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
                                <a href="{{url($page_url)}}"
                                   class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
                                   data-toggle="tooltip"
                                   title="{{trans('message.button.list')}}"
                                >
                                    <i class="fa fa-list"></i>
                                    {{trans('message.button.list')}}
                                </a>


                                <button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#searchModal"
                                        title="{{ trans('message.button.filter') }}">
                                    <i class="fas fa-filter"></i>
                                    {{ trans('message.button.filter') }}
                                </button>


                                @if( $request->status_id !=null || $request->from_date !=null || $request->to_date !=null

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
                            @if (sizeof($results) > 0)
                                <div class="card-body">
                                    <table id="example2"
                                           class="table table-bordered table-striped dataTable dtr-inline">
                                        <thead class="th-header">
                                        <tr class="{{ setFont() }}">
                                            <th width="10%">
                                                {{trans('message.commons.s_n')}}
                                            </th>
                                            <th>
                                                {{ trans('dartaKitab.dc_register_book.Registration_no') }}
                                            </th>
                                            <th>
                                                {{trans('message.pages.logs_management.action_logs.date')}}
                                            </th>

                                            <th>
                                                {{trans('message.commons.status')}}
                                            </th>
                                            <th>
                                                {{trans('common.updated_by')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($results as $key => $data)
                                            <tr>
                                                <th scope=row {{ setFont() }}>
                                                    {{ ($results->currentpage() - 1) * $results->perpage() + $key + 1 }}
                                                </th>

                                                <td class="{{setFont()}}">
                                                    @if(isset($data->dcRegister->regd_no))
                                                        {{$data->dcRegister->regd_no}}
                                                    @endif

                                                </td>

                                                <td class="{{setFont()}}">
                                                    @if(isset($data->update_date_np))
                                                        {{ getLan() =='np' ? $data->update_date_np : $data->update_date_en }}
                                                    @endif
                                                    {{ getLan() =='np' ? $data->updated_date_np : $data->updated_date_en }}
                                                    <i class="fa fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($data->created_at)->format('g:i A') }}

                                                </td>

                                                <td class="{{setFont()}}">
                                                    @if(isset($data->dcStatus->name_np))
                                                        {{getLan() == 'np' ? $data->dcStatus->name_np : $data->dcStatus->name_en }}
                                                    @endif

                                                </td>
                                                <td class="{{setFont()}}">
                                                    @if(isset($data->updatedBy))
                                                        @if(userInfo()->id == $data->updated_by)
                                                            {{ getLan() =='np' ? 'तपाईं' : 'You' }}
                                                        @else
                                                            {{ getLan() =='np' ? $data->updatedBy->full_name_np : $data->updatedBy->full_name_en }}
                                                        @endif

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
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.check_data_modal')
        @include('backend.edmis.dcRegisterBookLog.searchModal')
    </div>

    <!-- /.content-wrapper -->




@endsection
