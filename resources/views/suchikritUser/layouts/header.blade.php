<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
                <span class="d-lg-none d-sm-inline-block {{setFont()}}" style="font-weight: 700">
                    {{trans('message.pages.common.menu')}}
                </span>
            </a>
        </li>


        <li class="nav-item d-none d-sm-inline-block">
            <a href="javascript:void(0)" class="nav-link {{setFont()}}" style="font-size: 18px; margin-top: -8px">

                {{ getLan() == 'np' ? ' स्थानीय सरकार, विराटनगर महानगरपालिका मोरङ, कोशी प्रदेश' : '
                    Local Government, Biratnagar Metropolitan, Morang, Koshi Province' }}
                <br>
                @if(systemSetting()->app_name)
                <span style="margin-top: 20px; font-size: 24px">
                    {{ getLan() =='np' ? systemSetting()->app_name_np : systemSetting()->app_name }}</span>
                @else
                <span style="font-size: 20px">
                    {{ env('APP_NAME') }}
                </span>
                @endif
                <br>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li style="margin-right: 10px;" class="d-none d-sm-inline-block">

            <a style="font-size: 16px; line-height:20px;">
                <label style="margin-bottom:20px; font-weight: 500" class="nav-link {{setFont()}}">
                    @if(Session::get('fiscal_year_code') !='' ) {{trans('common.fiscal_year')}} @endif
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
                    class="dropdown-item {{ getLan() == 'en' ? 'active' : '' }}">
                    <i class="flag-icon flag-icon-us mr-2"></i> English
                </a>
                <a href="{{route('LangChange', ['lang' => 'np'])}}"
                    class="dropdown-item {{ getLan() == 'np' ? 'active' : '' }} f-kalimati">
                    <i class="flag-icon flag-icon-np mr-2"></i> नेपाली
                </a>
            </div>
        </li>
        <li class="nav-item">
            <div class="theme-switch-wrapper nav-link">
                <label class="theme-switch" for="checkbox">
                    <input type="checkbox" style="margin: 3px !important;" id="checkbox" />
                    <span class="slider round"></span>
                </label>
            </div>
        </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{url('/images/user.jpg')}}" class="user-image img-circle elevation-2" alt="User Image">
            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <li class="user-header bg-primary">
                    <img src="{{url('/images/user.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    <p>
                        Suchikrit user
                        <small>
                            Member since : created_date

                        </small>
                    </p>
                </li>
                <li class="user-footer">
                    <a href="{{url('user-profile')}}"
                        class="btn btn-secondary btn-sm rounded-pill btn-flat {{setFont()}}">
                        <i class="fas fa-user mr-2"></i>
                        {{trans('message.header.profile')}}
                    </a>

                    <a href="#" class="btn btn-danger btn-sm rounded-pill btn-flat float-right {{setFont()}}"
                        data-toggle="modal" data-target="#logoutModal" title="Click here for logout">
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
