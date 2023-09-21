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
                            {{ trans('message.pages.users_management.page_title') }}
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
                                <a href="{{ url('users') }}">
                                    {{ trans('message.pages.users_management.page_title') }}
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
                            <div class="card-header" style="text-align:center">
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

                                @if (
                                    $request->client_id != null ||
                                        $request->status != null ||
                                        $request->email != null ||
                                        $request->login_user_name != null)
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
                                    <table id="" class="table table-bordered table-striped dataTable dtr-inline">
                                        <thead class="th-header">
                                            <tr class="{{ setFont() }}">
                                                <th width="10px">
                                                    {{ trans('message.commons.s_n') }}
                                                </th>
                                                @if (systemAdmin() == true)
                                                    <th>
                                                        {{ trans('common.local_body') }}
                                                    </th>
                                                @endif
                                                <th>
                                                    {{ trans('message.pages.users_management.full_name') }}
                                                </th>

                                                <th>
                                                    {{ trans('message.pages.users_management.login_email_address') }}
                                                </th>

                                                <th>
                                                    {{ trans('message.commons.status') }}
                                                </th>

                                                <th>
                                                    {{ trans('message.pages.users_management.block_status') }}
                                                </th>

                                                <th style="width: 100px;">
                                                    {{ trans('message.commons.action') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($results as $key => $data)
                                                <tr>
                                                    <th scope="row {{ setFont() }}">
                                                        {{ ($results->currentpage() - 1) * $results->perpage() + $key + 1 }}
                                                    </th>
                                                    @if (systemAdmin() == true)
                                                        <td class="{{ setFont() }}">
                                                            @if (isset($data->client))
                                                                {{ getLan() == 'np' ? $data->client->name_np : $data->client->name_en }}
                                                            @else
                                                                {{ trans('common.system_setting') }}
                                                            @endif
                                                        </td>
                                                    @endif

                                                    <td class="{{ setFont() }}">

                                                        @if ($data->user_module == 'app')
                                                            @if ($data->access_user_type == 'km')
                                                                @if (isset($data->electedPerson))
                                                                    {{ getLan() == 'np' ? $data->electedPerson->name_np : $data->electedPerson->name_en }}
                                                                @endif
                                                            @elseif($data->access_user_type == 'om')
                                                                @if (isset($data->employee))
                                                                    {{ getLan() == 'np' ? $data->employee->first_name_np : $data->employee->first_name_en }}
                                                                @endif
                                                            @endif
                                                        @else
                                                            {{ getLan() == 'np' ? $data['full_name_np'] : $data['full_name'] }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{ $data->email }}
                                                        @if (isset($data->phone_number))
                                                            <br>
                                                            {{ $data->phone_number }}
                                                        @endif
                                                    </td>

                                                    <td class="{{ setFont() }}">
                                                        @if ($data->id != \Illuminate\Support\Facades\Auth::user()->id)
                                                            @include('backend.components.buttons.status')
                                                        @endif
                                                    </td>

                                                    <td class="{{ setFont() }}">
                                                        @if ($data->id != \Illuminate\Support\Facades\Auth::user()->id)
                                                            @if ($data->block_status == true)
                                                                <button type="button"
                                                                    class="btn btn-danger btn-xs rounded-pill"
                                                                    data-toggle="modal"
                                                                    data-target="#blockStatusModal{{ $key }}"
                                                                    title="Click here update  status">
                                                                    {{ trans('message.button.yes') }}
                                                                </button>
                                                            @elseif($data->block_status == false)
                                                                <strong class="btn btn-secondary btn-xs rounded-pill">
                                                                    {{ trans('message.button.no') }}
                                                                </strong>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (userInfo()->role_id == 1 || userInfo()->role_id == 2)
                                                            <button type="button"
                                                                class="btn btn-success btn-xs rounded-pill passwordReset"
                                                                data-id="{{ $data->id }}"
                                                                data-widget="{{ $page_url }}"
                                                                title="  {{ trans('message.pages.common.password_reset') }}">
                                                                <i class="fas fa-lock"></i>
                                                            </button>
                                                        @endif
                                                        &nbsp;
                                                        @include('backend.components.buttons.action')
                                                    </td>
                                                </tr>
                                                @include('backend.modal.status_modal')
                                                @include('backend.modal.delete_modal')
                                                @include('backend.users.edit_modal')
                                                @include('backend.users.show')
                                                @include('backend.users.block_status-modal')
                                                @include('backend.modal.password-reset-modal')
                                                @include('backend.modal.file-delete-modal')
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div style="padding-top: 20px">
                                        <span class="fa-pull-left">
                                            Showing {{ ($results->currentpage() - 1) * $results->perpage() + 1 }} to
                                            {{ $results->currentpage() * $results->perpage() }}
                                            of {{ $results->total() }} entries
                                        </span>
                                        <span class="float-right">
                                            {{ $results->appends(request()->except('page'))->links() }}
                                        </span>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            @else
                                <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                                    <label class="form-control badge badge-pill"
                                        style="text-align:  center; font-size: 18px;">
                                        <i class="fas fa-ban" style="margin-top: 6px"></i>
                                        {{ trans('message.commons.no_record_found') }}
                                    </label>
                                </div>
                            @endif
                        </div>
                        <!-- /.card -->


                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    @include('backend.users.add_modal')
    @include('backend.users.search_modal')
    @include('backend.modal.check_data_modal')
    @include('backend.modal.data-submit-modal')
    <!-- /.content-wrapper -->
    <script>
        function passwordYes() {
            $("#passwordBlock").hide();
            $("#confirmPasswordBlock").hide();
        }

        function passwordNo() {
            $("#passwordBlock").show();
            $("#confirmPasswordBlock").show();
        }
    </script>
    @include('backend.modal.technical-error-modal')
@endsection
