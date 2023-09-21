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
                                    {{trans('message.dashboard.page_title')}}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">
                                    {{trans('message.pages.system_setting.app_setting.page_title')}}
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

                                @if(systemAdmin() ==true)
                                <button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#searchModal"
                                        title="{{ trans('message.button.filter') }}">
                                    <i class="fas fa-filter"></i>
                                    {{ trans('message.button.filter') }}
                                </button>
                                @endif

                                @if( $request->client_id !=null || $request->status !=null )

                                    <a href="{{url(@$page_url)}}"
                                       class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}"
                                       title="{{ trans('message.button.reload') }}"
                                    >
                                        <i class="fas  fa-undo"></i>
                                        {{ trans('message.button.reload') }}
                                    </a>

                                @endif

                                @if(allowAdd() )
                                    <button
                                            class="btn btn-primary btn-sm float-left boxButton rounded-pill {{setFont()}}"
                                            data-toggle="modal"
                                            data-target="#addModal"
                                            title="{{trans('message.button.add_new')}}"
                                    >
                                        <i class="fa fa-plus-circle"></i>
                                        {{trans('message.button.add_new')}}
                                    </button>

                                @endif

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            @if(sizeof($results) > 0)
                                <div class="card-body">
                                    <table id="example2"
                                           class="table table-bordered table-striped dataTable dtr-inline"
                                    >
                                        <thead class="th-header">
                                        <tr class="{{setFont()}}">
                                            <th width="10px">
                                                {{trans('message.commons.s_n')}}
                                            </th>

                                            @if(systemAdmin() ==true)
                                            <th>
                                                {{trans('common.local_body')}}
                                            </th>
                                            @endif
                                            <th>
                                                {{trans('common.sms_provider_name')}}
                                            </th>

                                            <th>
                                                {{trans('message.pages.system_setting.sms_setting.sms_from')}}
                                            </th>

                                            <th>
                                                {{trans('message.commons.status')}}
                                            </th>

                                            <th width="13%">
                                                {{trans('message.commons.action')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th scope=row {{setFont()}}>
                                                    {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                                </th>

                                                @if(systemAdmin() ==true)

                                                <td class="{{setFont()}}">
                                                    @if(isset($data->client))
                                                        {{ getLan() =='np' ? $data->client->name_np : $data->client->name_en }}
                                                    @else
                                                        {{ trans('common.system_setting') }}

                                                    @endif
                                                </td>
                                                @endif
                                                <td>
                                                    @if(isset($data->sms_provider_name))
                                                        {{$data->sms_provider_name}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($data->sms_from))
                                                        {{$data->sms_from}}
                                                    @endif
                                                </td>
                                                <td class="{{setFont()}}">
                                                    @include('backend.components.buttons.status')
                                                </td>
                                                <td>
                                                    @if(allowShow())

                                                        <button type="button"
                                                                class="btn btn-secondary btn-xs rounded-pill {{setFont()}}"
                                                                data-toggle="modal"
                                                                data-target="#showModal{{$key}}"
                                                                data-placement="top"
                                                                title="{{trans('message.button.show')}}"
                                                        >
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    @endif
                                                    &nbsp;
                                                    @if(allowEdit())

                                                        <button type="button"
                                                                class="btn btn-info btn-xs rounded-pill {{setFont()}}"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{$key}}"
                                                                data-placement="top"
                                                                title="{{trans('message.button.edit')}}"
                                                        >
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    @endif
                                                    &nbsp;
                                                    @if(allowDelete() && $data->status ==false)
                                                        <button type="button"
                                                                class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{$key}}"
                                                                data-placement="top"
                                                                title="{{trans('message.button.delete')}}"
                                                        >
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif


                                                </td>
                                            </tr>
                                            @include('backend.modal.status_modal')
                                            @include('backend.modal.delete_modal')
                                            @include('backend.systemSetting.smsSetting.show')
                                            @include('backend.systemSetting.smsSetting.edit')
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <span
                                            class="float-right"
                                            style="margin-top: 20px !important;"
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
        @include('backend.systemSetting.smsSetting.add')
        @include('backend.systemSetting.smsSetting.searchModal')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.check_data_modal')
    </div>

    <!-- /.content-wrapper -->

@endsection

