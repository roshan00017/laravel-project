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
                            {{trans('message.pages.system_setting.app_setting.page_title')}}
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
                                {{trans('message.pages.system_setting.app_setting.sub_page_title')}}
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
                                   class="btn btn-secondary rounded-pill btn-sm float-left  boxButton {{setFont()}}"
                                   data-toggle="tooltip"
                                   title="List"
                                >
                                    <i class="fa fa-list"></i>
                                    {{trans('message.pages.system_setting.app_setting.sub_page_title')}}
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example3"
                                       class="table table-bordered"
                                >
                                    <thead class="th-header">
                                    <tr class="{{setFont()}}">
                                        <th>
                                            {{trans('message.pages.system_setting.app_setting.app_name')}}
                                        </th>

                                        <th>
                                            {{trans('message.pages.system_setting.app_setting.app_short_name')}}
                                        </th>

                                        <th width="40%">
                                            {{trans('message.pages.system_setting.app_setting.app_logo')}}
                                        </th>

                                        <th width="8%">
                                            {{trans('message.commons.action')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="{{setFont()}}">
                                            {{getLan() =='np' ? $result['app_name_np'] : $result['app_name']}}
                                        </td>
                                        <td {{setFont()}}>
                                            {{getLan() =='np' ? $result['app_short_name_np'] : $result['app_short_name']}}
                                        </td>
                                        <td>
                                            @if(isset($result['app_logo']))
                                                <img src="{{asset('/storage/uploads/files/'.$result['app_logo'])}}"
                                                     alt="Admin Logo"
                                                     class="rounded-pill"
                                                     style="width: 60px; height: 60px"
                                                >
                                            @endif
                                            <button type="button"
                                                    class="btn btn-secondary btn-xs rounded-pill"
                                                    style="margin: 10px 0 0 10px;"
                                                    data-placement="top"
                                                    data-toggle="modal"
                                                    data-target="#imageModal"  @if($result['app_logo'] != null)
                                                    title="Change Logo"
                                                    @else title="Upload Logo" @endif
                                            >
                                                <i class="fa fa-upload">
                                                </i>
                                            </button>
                                            @if($result['app_logo'] != null)
                                                <button type="button" class="btn btn-info btn-xs rounded-pill"
                                                        style="margin: 10px 0 0 10px;"
                                                        data-placement="top"
                                                        data-toggle="modal"
                                                        data-target="#imageViewModal"
                                                        title="View Logo"
                                                >
                                                    <i class="fa fa-eye">
                                                    </i>
                                                </button>

                                                <button type="button"
                                                        class="btn btn-danger btn-xs rounded-pill"
                                                        style="margin: 10px 0 0 10px;"
                                                        data-placement="top"
                                                        data-toggle="modal"
                                                        data-target="#deleteFileModal"
                                                        title="Delete Logo"
                                                >
                                                    <i class="fa fa-trash">
                                                    </i>
                                                </button>
                                            @endif
                                        </td>

                                        <td>
                                            @if(allowEdit())
                                                <button type="button"
                                                        class="btn btn-info btn-xs rounded-pill"
                                                        data-toggle="modal"
                                                        data-target="#editModal"
                                                        data-placement="top"
                                                        title="Edit"
                                                >
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
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

    </div>

    <!-- /.content-wrapper -->
    @include('backend.modal.technical-error-modal')
    @include('backend.systemSetting.appSetting.updateModal')
    @include('backend.systemSetting.appSetting.deleteFileModal')
    @include('backend.systemSetting.appSetting.imageViewModal')
    @include('backend.systemSetting.appSetting.imageUploadModal')
@endsection
