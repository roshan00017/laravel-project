<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link"
               data-widget="pushmenu"
               href="#"
               role="button"
            >
                <i class="fas fa-bars"></i>
                <span class="d-lg-none d-sm-inline-block {{setFont()}}"
                      style="font-weight: 700"
                >
                    {{trans('message.pages.common.menu')}}
                </span>
            </a>
        </li>


        <li class="nav-item d-none d-sm-inline-block">
            <a href="javascript:void(0)" class="nav-link {{setFont()}}"
               style="font-size: 18px; margin-top: -8px">

                {{  clientInfo()->name }}
                <br>
                @if(clientInfo()->local_body_type_id == 4)
                    {{ getLan() == 'np' ? ' गाउँकार्यपालिकाको कार्यालय' : '
                    Office of the Village Executive' }}
                @else
                    {{ getLan() == 'np' ? ' नगरकार्यपालिकाको कार्यालय ' : 'City Executive Office' }}
                @endif
                ,
{{--                {{  clientInfo()->district_name }} ,--}}
                {{  clientInfo()->province_name }}
                {{--                <br>--}}
                {{--                @if(systemSetting()->app_name)--}}
                {{--                    <span style="margin-top: 20px; font-size: 24px">   {{ getLan() =='np' ? systemSetting()->app_name_np : systemSetting()->app_name }}</span>--}}
                {{--                @else--}}
                {{--                   <span style="font-size: 20px">--}}
                {{--                        {{ env('APP_NAME') }}--}}
                {{--                   </span>--}}
                {{--                @endif--}}
                <br>


            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li style="margin-right: 10px;" class="d-none d-sm-inline-block">

            <a style="font-size: 16px; line-height:20px;">
                <label style="margin-bottom:20px; font-weight: 500" class="nav-link {{setFont()}}">
                    @if(Session::get('fiscal_year_code') !='' ) {{trans('common.fiscal_year')}}  @endif
                    <br>
                    <span class="{{setFont()}}">
                            @if(Session::get('fiscal_year_code') !='')
                            {{  Session::get('fiscal_year_code') }}
                        @else
                            {{currentFy()}}
                        @endif
                        </span>
                </label>
            </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link">
                <label style="margin-bottom:0px; font-size: 16px; font-weight: 500 " class="{{setFont()}}">
                    {{ (new \App\Helpers\DateConverter)->eng_to_nep(date('Y-m-d'),'np')}}
                    <label id="timeset" style="font-weight: 400 !important;"></label><br>
                    <lablel>{{ date('l jS \of F Y ') }}</lablel>
                </label>
            </a>

        </li>

        @if(systemAdmin() == true || userInfo()->user_module =='client_admin' || userInfo()->user_module =='ghs')
            @if(@$totalNotification > 0)
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge blink {{setFont()}}">{{@$totalNotification}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @if(@$totalNotification > 0)
                            <span class="dropdown-item dropdown-header {{setFont()}}">
                        {{$totalNotification}} {{trans('common.notifications')}}
                        </span>
                        @endif
                        @if(@$totalComplaintNotification > 0)
                            <div class="dropdown-divider"></div>
                            <a  href="{{ route('notification.index',['type'=>encrypt('complaint')]) }}"
                               class="dropdown-item {{ setFont() }}">
                                <i class="fa fa-info mr-2"></i> {{@$totalComplaintNotification}} {{trans('common.new_complaint_register')}}
                            </a>
                        @endif
                        @if(@$totalSuggestionNotification > 0)
                            <div class="dropdown-divider"></div>
                            <a  href="{{ route('notification.index',['type'=>encrypt('suggestion')]) }}"
                               class="dropdown-item {{ setFont() }}">
                                <i class="fa fa-cogs mr-2"></i> {{@$totalSuggestionNotification}} {{trans('common.new_suggestion_register')}}
                            </a>
                        @endif
                        @if(@$totalIncidentNotification > 0)
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('notification.index',['type'=>encrypt('incident')]) }}"
                               class="dropdown-item {{ setFont() }}">
                                <i class="fa fa-bullhorn mr-2"></i> {{@$totalIncidentNotification}} {{trans('common.new_incident_register')}}
                            </a>
                        @endif
                        @if(systemAdmin() == true || userInfo()->user_module =='app')
                            @if(@$totalAppointmentNotification > 0)
                                <div class="dropdown-divider"></div>
                                <a   href="{{ route('notification.index',['type'=>encrypt('appointment')]) }}"
                                     href="{{url('notifications')}}"
                                   class="dropdown-item {{ setFont() }}"
                                >
                                    <i class="fa fa-handshake mr-2"></i> {{@$totalAppointmentNotification}}
                                    {{trans('common.new_appointment_register')}}
                                </a>
                            @endif
                        @endif
                        <div class="dropdown-divider"></div>
                        <a href="{{url('notifications')}}"
                           class="dropdown-item dropdown-footer {{setFont()}}">
                            {{trans('common.sell_all_notifications')}}
                        </a>
                    </div>
                </li>
            @endif
        @endif

        <li class="nav-item dropdown">

            <a class="nav-link {{setFont()}}" data-toggle="dropdown" href="#">
                @if( getLan() == 'en')
                    <strong> En </strong>
                @elseif(getLan() == 'np')
                    <strong style="font-size: 18px"> <i class="flag-icon flag-icon-np"></i> ने</strong>
                @else
                    <strong style="font-size: 18px"> En</strong>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                <a href="{{route('LangChange', ['lang' => 'en'])}}"
                   class="dropdown-item {{ getLan() == 'en' ? 'active' : '' }}"
                >
                    <i class="flag-icon flag-icon-us mr-2"></i> English
                </a>
                <a href="{{route('LangChange', ['lang' => 'np'])}}"
                   class="dropdown-item {{ getLan() == 'np' ? 'active' : '' }} f-kalimati"

                >
                    <i class="flag-icon flag-icon-np mr-2"></i> नेपाली
                </a>
            </div>
        </li>
        <li class="nav-item">
            <div class="theme-switch-wrapper nav-link">
                <label class="theme-switch" for="checkbox">
                    <input type="checkbox" style="margin: 3px !important;" id="checkbox"/>
                    <span class="slider round"></span>
                </label>
            </div>
        </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="@if(isset(userInfo()->image))
                {{asset('/storage/'.userProfilePath().userInfo()->image)}}
                @else {{url('/images/user.jpg')}} @endif"
                     class="user-image img-circle elevation-2"
                     alt="User Image"
                >
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <li class="user-header bg-primary">
                    <img src="@if(isset(userInfo()->image)) {{asset('/storage/'.userProfilePath().userInfo()->image)}}
                    @else {{url('/images/user.jpg')}} @endif"
                         class="img-circle elevation-2" alt="User Image">
                    <p>
                        @if(isset(userInfo()->full_name))
                            {{userInfo()->full_name}}
                        @endif
                        <small>
                            Member since : {{ userInfo()->created_at->format('d') }} ,
                            {{ userInfo()->created_at->format('F') }} {{ userInfo()->created_at->format('Y') }}
                        </small>
                    </p>
                </li>
                <li class="user-footer">
                    <a href="{{url('my-profile')}}"
                       class="btn btn-secondary btn-sm rounded-pill btn-flat {{setFont()}}"
                    >
                        <i class="fas fa-user mr-2"></i>
                        {{trans('message.header.profile')}}
                    </a>

                    <a href="#"
                       class="btn btn-danger btn-sm rounded-pill btn-flat float-right {{setFont()}}"
                       data-toggle="modal"
                       data-target="#logoutModal"
                       title="Click here for logout"
                    >
                        <i class="fa fa-sign-out-alt"></i>
                        {{trans('message.header.sign_out')}}
                    </a>
                </li>

            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<!-- logout  modal start -->
<div class="modal fade"
     id="logoutModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    @if(systemSetting())
                        {{getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
                    @else
                        {{trans('message.pages.common.app_short_name')}}
                    @endif
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['method' => 'POST',
                        'class'=>'inline', 'route'=>['logout']])
            !!}
            <div class="modal-body">
                <h6 class="{{setFont()}}">
                    {{trans('message.header.are_you_sure_you_want_to_sign_out')}}
                </h6>

            </div>
            <div class="modal-footer justify-content-center {{setFont()}}">
                <button type="submit"
                        class="btn btn-primary rounded-pill"
                >
                    <i class="fa fa-check-circle"></i>
                    {{trans('message.button.yes')}}
                </button>
                &nbsp; &nbsp;
                <button type="button"
                        class="btn btn-danger rounded-pill"
                        data-dismiss="modal"
                >
                    <i class="fa fa-times-circle"></i>
                    {{trans('message.button.no')}}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
