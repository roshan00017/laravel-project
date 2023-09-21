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
                                {{trans('message.pages.system_setting.login_setting.page_title')}}
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
                                    {{trans('message.pages.system_setting.login_setting.page_title')}}
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example3"
                                       class="table table-bordered"
                                >
                                    <thead class="th-header">
                                    <tr>
                                        <th class="{{setFont()}}">
                                            {{trans('message.pages.system_setting.login_setting.login_title')}}
                                        </th>
                                        <th class="{{setFont()}}">
                                            {{trans('message.pages.system_setting.login_setting.captcha_required')}}
                                        </th>
                                        <th class="{{setFont()}}">
                                            {{trans('message.pages.system_setting.login_setting.forgot_password_required')}}
                                        </th>
                                        <th class="{{setFont()}}">
                                            {{trans('message.pages.system_setting.login_setting.login_attempt_required')}}
                                        </th>
                                        <th class="{{setFont()}}" width="8%">
                                            {{trans('message.commons.action')}}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="{{setFont()}}">
                                            @if(isset($result['login_title']))
                                                {{ getLan() =='np' ? $result['login_title_np'] : $result['login_title'] }}
                                            @endif
                                        </td>
                                        <td class="{{setFont()}}">
                                            @if($result['login_captcha_required'] == '1')
                                                <button type="button"
                                                        class="btn btn-success btn-xs rounded-pill"
                                                        data-toggle="modal"
                                                        data-target="#captchaModal"
                                                        title="{{trans('message.button.status_update')}}"
                                                >
                                                    {{trans('message.button.yes')}}
                                                </button>
                                            @elseif($result['login_captcha_required']== '0')
                                                <button type="button"
                                                        class="btn btn-danger btn-xs rounded-pill"
                                                        data-toggle="modal"
                                                        data-target="#captchaModal"
                                                        title="{{trans('message.button.status_update')}}"
                                                >
                                                    {{trans('message.button.no')}}
                                                </button>
                                            @endif
                                        </td>
                                        <td class="{{setFont()}}">
                                            @if($result['forget_password_required'] == '1')
                                                <button type="button"
                                                        class="btn btn-success btn-xs rounded-pill"
                                                        data-toggle="modal"
                                                        data-target="#forgetPasswordModal"
                                                        title="{{trans('message.button.status_update')}}"
                                                >
                                                    {{trans('message.button.yes')}}
                                                </button>
                                            @elseif($result['forget_password_required']== '0')
                                                <button type="button"
                                                        class="btn btn-danger btn-xs rounded-pill"
                                                        data-toggle="modal"
                                                        data-target="#forgetPasswordModal"
                                                        title="{{trans('message.button.status_update')}}"
                                                >
                                                    {{trans('message.button.no')}}
                                                </button>
                                            @endif
                                        </td>

                                        <td>
                                            @if($result['login_attempt_required'] == '1')
                                                <button type="button"
                                                        class="btn btn-success btn-xs rounded-pill {{setFont()}}"
                                                        data-toggle="modal"
                                                        data-target="#loginAttemptModal"
                                                        title="{{trans('message.button.status_update')}}"
                                                >
                                                    {{trans('message.button.yes')}}
                                                </button>
                                            @elseif($result['login_attempt_required']== '0')
                                                <button type="button"
                                                        class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                                                        data-toggle="modal"
                                                        data-target="#loginAttemptModal"
                                                        title="{{trans('message.button.status_update')}}"
                                                >
                                                    {{trans('message.button.no')}}
                                                </button>
                                            @endif
                                            @if(isset($result['login_attempt_limit']) && $result['login_attempt_required'] == '1')
                                                &nbsp; &nbsp;
                                                {{$result['login_attempt_limit']}}
                                                &nbsp; &nbsp;
                                                <button type="button"
                                                        class="btn btn-success btn-xs rounded-pill"
                                                        data-placement="top"
                                                        data-toggle="modal"
                                                        data-target="#loginAttemptLimitModal"
                                                >
                                                    Update
                                                </button>
                                            @endif
                                        </td>


                                        <td>
                                            @if(allowEdit())
                                                <button type="button"
                                                        class="btn btn-info btn-xs rounded-pill "
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
    <script>

        function loginAttempt() {
            $('#loginAttemptModal').modal('hide');
            $('#loginAttemptLimitModal').modal('show');
        }

        function attemptYes() {
            $('#loginAttempt').show();
        }

        function attemptNo() {
            $('#loginAttempt').hide();
        }
    </script>
    @include('backend.modal.technical-error-modal')
    @include('backend.systemSetting.loginSetting.captchaStatusUpdateModal')
    @include('backend.systemSetting.loginSetting.forgotPasswordStatusUpdateModal')
    @include('backend.systemSetting.loginSetting.loginAttemptStatusUpdateModal')
    @include('backend.systemSetting.loginSetting.loginAttemptLimitUpdateModal')
    @include('backend.systemSetting.loginSetting.updateModal')
@endsection
