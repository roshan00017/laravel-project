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
                            {{trans('message.pages.profile.page_title')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right {{setFont()}}">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}">
                                    {{ trans('message.pages.users_management.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{trans('message.pages.profile.page_title')}}
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
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline" style="border-radius: 24px !important;">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         @if(userInfo()->image!=null)
                                         src="{{asset('/storage/'.userProfilePath().Auth::user()->image)}}"
                                         @else src="{{url('images/user.jpg')}}" @endif
                                         alt="User profile picture"
                                    >
                                </div>
                                <button type="button"
                                        class="btn btn-xs btn-secondary rounded-pill btn-sm"
                                        data-placement="top"
                                        style="margin: 10px 0 0 40px;"
                                        data-toggle="modal" data-target="#profilePictureModal"
                                >
                                    <i class="{{setFont()}}">
                                        @if(userInfo()->image != null)  {{trans('message.pages.profile.change_profile_photo')}} @else  {{trans('message.pages.profile.upload_profile_photo')}} @endif
                                    </i>
                                </button>
                                @if(userInfo()->image != null)
                                    <button type="button"
                                            class="btn btn-danger btn-xs rounded-pill"
                                            data-placement="top"
                                            style="margin-top: 10px; margin-left: 10px"
                                            data-toggle="modal"
                                            data-target="#deleteFileModal"
                                            title="{{trans('message.pages.common.deleteFile')}}"
                                    >
                                        <i class="fa fa-trash">
                                        </i>
                                    </button>
                                @endif

                            </div>
                            <!-- Profile  Modal start -->
                            <div class="modal fade"
                                 id="profilePictureModal"
                            >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content modal-content-radius">
                                        <div class="modal-header btn-primary rounded-pill">
                                            <h4 class="modal-title {{setFont()}}">
                                                {{trans('message.pages.profile.change_profile_photo')}}
                                            </h4>
                                            <button type="button"
                                                    class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                            >
                                                <span aria-hidden="true"
                                                      data-toggle="tooltip"
                                                      title="Close"
                                                >   &times;
                                                </span>
                                            </button>
                                        </div>
                                        {!! Form::open(['method'=>'post',
                                               'url'=>'/profile/profilePic',
                                               'enctype'=>'multipart/form-data'])
                                        !!}
                                        <div class="modal-body {{setFont()}}">
                                            <div style="width: 450px; margin:10px 0 0 35px;">
                                                {{--set database image column name--}}
                                                <input type="hidden"
                                                       name="column_name"
                                                       value="image"
                                                >
                                                {{--set file tile --}}
                                                <input type="hidden"
                                                       name="file_title"
                                                       value="{{userInfo()->full_name}}"
                                                >
                                                <label> {{trans('message.pages.profile.upload_image')}}</label> <label
                                                        class="text-danger">*</label> <br>
                                                <input name="update_file"
                                                       type="file"
                                                       required=""
                                                       class="profile-img"
                                                >
                                                {{csrf_field()}}
                                                <br>
                                                @if($errors->has('upload_file') == null)
                                                    <span class="text text-danger"
                                                          style="font-size: 13px;color: #ff042c;"
                                                    >
                                                      {{trans('message.pages.users_management.file_upload_message')}}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center {{setFont()}}">
                                            <button type="submit"
                                                    class="btn btn-success rounded-pill"
                                            >  {{trans('message.pages.profile.upload_profile_photo')}}
                                            </button>
                                            &nbsp; &nbsp;
                                            <button type="button"
                                                    class="btn btn-danger rounded-pill"
                                                    data-dismiss="modal"
                                            >
                                                {{trans('message.button.close')}}
                                            </button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary" style="border-radius: 24px !important;">
                            <div class="card-header rounded-pill">
                                <h3 class="card-title  {{setFont()}}">
                                    {{trans('message.pages.profile.about_me')}}
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body {{setFont()}}">
                                <strong>
                                    <i class="fas fa-envelope"></i>
                                    {{trans('message.pages.users_management.login_email_address')}}
                                </strong>

                                <p class="text-muted">
                                    {{userInfo()->email}}
                                </p>

                                <hr>

                                <strong>
                                    <i class="fas fa-user"></i> {{trans('message.pages.users_management.login_user_name')}}
                                </strong>

                                <p class="text-muted">
                                    {{userInfo()->login_user_name}}
                                </p>
                                @if(@$lastLogin)
                                    <hr>
                                    <strong>
                                        <i class="fa fa-sign-in-alt">
                                        </i>
                                        {{trans('message.pages.profile.last_logged_in')}}
                                    </strong>
                                    <p class="text-muted"
                                       style="float:right"
                                    >
                                        {{ @$lastLogin }}
                                    </p>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card" style="border-radius: 24px !important;">
                            <div class="card-header p-2 {{setFont()}}">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active rounded-pill"
                                           href="#profile_setting"
                                           data-toggle="tab"
                                        >
                                            {{trans('message.pages.profile.profile_setting')}}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link rounded-pill"
                                           href="#account_setting"
                                           data-toggle="tab"
                                        >
                                            {{trans('message.pages.profile.account_setting')}}
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body {{setFont()}}">
                                <div class="tab-content">
                                    <div class="tab-pane active"
                                         id="profile_setting"
                                    >
                                        {!! Form::open(['method'=>'post',
                                                'url'=>'profileUpdate'])
                                        !!}
                                        <input type="hidden"
                                               name="update_status"
                                               value="1"
                                        >
                                        <div class="form-group row">
                                            <label for="inputName"
                                                   class="col-sm-2 col-form-label"
                                            >
                                                {{trans('message.pages.users_management.full_name')}}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::text('full_name',
                                                        Auth::user()->full_name,['class'=>'form-control'])
                                                !!}

                                                {!! $errors->first('full_name', '
                                                              <span class="badge badge-danger">
                                                                  :message
                                                              </span>
                                                ') !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputExperience"
                                                   class="col-sm-2 col-form-label"
                                            >
                                                {{trans('message.pages.profile.address')}}
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::textarea('address',
                                                        Auth::user()->address,['class'=>'form-control',
                                                      'rows'=>'2'])
                                                !!}

                                                {!! $errors->first('address', '
                                                             <span class="badge badge-danger">
                                                                 :message
                                                             </span>
                                                ') !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit"
                                                        class="btn btn-success rounded-pill"
                                                >
                                                    {{trans('message.button.update_profile')}}
                                                </button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="account_setting">
                                        {!! Form::open(['method'=>'post','url'=>'profileUpdate','id'=>'credentialForm']) !!}
                                        <input type="hidden" name="update_status" value="2">
                                        <div class="form-group row">
                                            <label for="inputName"
                                                   class="col-sm-2 col-form-label">   {{trans('message.pages.users_management.login_user_name')}}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::text('login_user_name',
                                                        Auth::user()->login_user_name,
                                                        ['class'=>'form-control',
                                                        'id'=>'login_user_name',
                                                        'required'
                                                        ])
                                                !!}

                                                {!! $errors->first('login_user_name', '
                                                              <span class="badge badge-danger">
                                                                  :message
                                                              </span>
                                                ') !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputName"
                                                   class="col-sm-2 col-form-label">   {{trans('common.mobile_no')}}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::text('mobile_no',
                                                        Auth::user()->mobile_no,
                                                        ['class'=>'form-control',
                                                        'required',
                                                        'id'=>'mobile'
                                                        ])
                                                !!}

                                                {!! $errors->first('mobile_no', '
                                                              <span class="badge badge-danger">
                                                                  :message
                                                              </span>
                                                ') !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputName"
                                                   class="col-sm-2 col-form-label"
                                            >
                                                {{trans('message.pages.users_management.login_email_address')}}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::email('email',
                                                        Auth::user()->email,
                                                        ['class'=>'form-control',
                                                        'id'=>'email',
                                                        'required'
                                                        ])
                                                !!}

                                                {!! $errors->first('email', '
                                                              <span class="badge badge-danger">
                                                                  :message
                                                              </span>
                                                ') !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit"
                                                        class="btn btn-success rounded-pill"
                                                >
                                                    {{trans('message.button.update_profile')}}
                                                </button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                        {!! Form::open(['method'=>'post',
                                                'url'=>'updatePassword','id'=>'credentialForm'])
                                        !!}
                                        <input type="hidden"
                                               name="userId"
                                               value="{{userInfo()->id}}"
                                        >
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                   class="col-sm-2 col-form-label"
                                            >
                                                {{trans('message.pages.profile.current_password')}}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::password('old',
                                                        array(
                                                        'class' => 'form-control','required',
                                                        'autocomplete'=>'off'));
                                                !!}
                                                {!! $errors->first('old', '
                                                    <span class="badge badge-danger">
                                                        :message
                                                    </span>
                                                ') !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                   class="col-sm-2 col-form-label"
                                            >
                                                {{trans('message.pages.profile.new_password')}}
                                                <span class="text text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::password('password',
                                                        array(
                                                        'class' => 'form-control',
                                                        'required',
                                                        'autocomplete'=>'off'));
                                                !!}
                                                @if($errors->has('password') == null)
                                                    <br>
                                                    <span style="color: #d22a16; font-size: 14px;">
                                                      {{trans('passwords.password_validation_message')}}
                                                    </span>
                                                    <br>
                                                    &nbsp;<span
                                                            style="font-size: 15px; color: #0b58a2; font-weight: 600">
                                                        {{ getLan() =='np' ? 'उदाहरण' : 'Example' }} : Ab1$b3wG
                                                    </span>
                                                @endif
                                                {!! $errors->first('password', '
                                                    <span class="badge badge-danger">
                                                        :message
                                                    </span>
                                                ') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                   class="col-sm-2 col-form-label">
                                                {{trans('message.pages.users_management.confirm_password')}}
                                                <label class="text text-danger">
                                                    *
                                                </label>
                                            </label>
                                            <div class="col-sm-10">
                                                {!! Form::password('password_confirmation',
                                                            array(
                                                            'class' => 'form-control',
                                                            'required',
                                                            'autocomplete'=>'off'));
                                                !!}
                                                {!! $errors->first('password_confirmation', '
                                                      <span class="badge badge-danger">
                                                          :message
                                                      </span>
                                                  ') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit"
                                                        class="btn btn-success rounded-pill"
                                                >
                                                    {{trans('message.button.update_password')}}
                                                </button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                            <!-- /.modal -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@include('backend.modal.check_data_modal')
@include('backend.modal.file-delete-modal')
