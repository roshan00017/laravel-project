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
                                <a href="{{url('dashboard')}}"> {{ trans('message.dashboard.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="#">
                                    {{trans('message.pages.system_setting.api_setting.page_title')}}
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
                                @include('backend.components.buttons.list')

                            </div>
                        </div>
                        <div class="card">
                        @if(sizeof($results) > 0)
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2"
                                       class="table table-bordered"
                                >
                                    <thead class="th-header">
                                    <tr class="{{setFont()}}">
                                        <th width="10px">
                                            {{trans('message.commons.s_n')}}
                                        </th>

                                        <th>
                                            {{trans('message.pages.system_setting.api_setting.app_name')}}
                                        </th>

                                        <th>
                                            {{trans('message.pages.system_setting.api_setting.api_key')}}
                                        </th>

                                        <th>
                                            {{trans('message.commons.status')}}
                                        </th>

                                        <th>
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

                                            <td>
                                                {{$data->name}}
                                            </td>
                                            <td>
                                                {{$data->key}}
                                            </td>

                                            <td class="{{setFont()}}">
                                                @include('backend.components.buttons.status')
                                            </td>
                                            <td>
                                                &nbsp;
                                                @if (allowEdit())
                                                        <button type="button" class="btn btn-info btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
                                                                data-target="#editModal{{ $key }}" data-placement="top"
                                                                title="{{ trans('message.button.edit') }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                @endif
                                                &nbsp;
                                                @if (allowDelete() && $data->status ==false)
                                                    <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
                                                            data-target="#deleteModal{{ $key }}" data-placement="top"
                                                            title="{{ trans('message.button.delete') }}">


                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif


                                            </td>
                                        </tr>
                                        @include('backend.modal.status_modal')
                                        @include('backend.modal.delete_modal')
                                        @include('backend.apiSetting.editModal')
                                    @endforeach
                                    </tbody>
                                </table>
                                <span
                                        class="float-right">{{ $results->appends(request()->except('page'))->links() }}
                                </span>
                            </div>
                            <!-- /.card-body -->
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
        @include('backend.apiSetting.addModal')
        @include('backend.components.commonSearchModal')
        @include('backend.modal.check_data_modal')
        @include('backend.modal.technical-error-modal')
    </div>

    <!-- /.content-wrapper -->

@endsection
