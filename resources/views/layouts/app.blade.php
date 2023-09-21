<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title class="{{setFont()}}">
        @if(isset(systemSetting()->app_name))
        {{getLan() == 'np' ? systemSetting()->app_name_np : systemSetting()->app_name }}
        @else
        {{ env('APP_NAME') }}
        @endif
        | Log in
    </title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}">
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">--}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('theme-design/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme_switch.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.css')}}">
</head>

<body class="hold-transition  backgroundLogin">
    <div class="container">
        <div class="panel panel-left" style="background-color: #fff;">
            @include('backend.modal.check_data_modal')
            <!-- /.login-logo -->
            <div class=" card-outline card-primary">
                <a class="nav-link {{setFont()}}" style="margin-bottom: -10px !important;" data-toggle="dropdown"
                    href="#">
                    @if(getLan() == 'np')
                    <strong style="font-size: 18px">
                        ने
                    </strong>
                    @else
                    <strong style="font-size: 18px">
                        En
                    </strong>
                    @endif
                </a>
                <span class="dropdown-menu dropdown-menu-left p-0">
                    <a href="{{route('LangChange', ['lang' => 'en'])}}"
                        class="dropdown-item {{ getLan() == 'en' ? 'active' : '' }}">
                        <i class="flag-icon flag-icon-us mr-2"></i> English
                    </a>
                    <a href="{{route('LangChange', ['lang' => 'np'])}}"
                        class="dropdown-item {{ getLan() == 'np' ? 'active' : '' }} f-kalimati">
                        <i class="flag-icon flag-icon-np mr-2"></i> नेपाली
                    </a>
                </span>
                <div class="card-body">
                    @if (Route::current()->getName() == 'eoadmin')
                    <p class="login-box-msg {{setFont()}}" style="padding: 0 0 20px 0">
                        @if(isset(systemSetting()->login_title))
                        {{getLan() == 'np' ? systemSetting()->login_title_np : systemSetting()->login_title }}
                        @endif
                    </p>
                    @elseif(Route::current()->getName() == 'password.request')
                    <p class="login-box-msg {{setFont()}}">
                        {{trans('message.authentication.forgot_password.forgot_password_title')}}
                    </p>

                    @else
                    <p class="login-box-msg {{setFont()}}">
                        {{trans('message.authentication.password_reset.password_reset_title')}}
                    </p>

                    @endif

                    @yield('content')
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <br>

        </div>
        <div class="panel panel-right" style="width:fit-content;background-color:#1B5696;">
            <div class="text-center" style=" margin-top: 10px;">
                <a href="javascript:void(0)" stysetFontle="color: white;font-size: 30px;"
                    class="{{getLan() == 'np' ? 'h4' : 'h5'}} {{setFont()}}">
                    @if(isset(systemSetting()->app_name))
                    {{getLan() == 'np' ? systemSetting()->app_name_np : systemSetting()->app_name }}
                    @else
                    {{ env('APP_NAME') }}
                    @endif
                </a>
                <div class="login-logo">
                    <img class="img-circle"
                        src='@if(isset(systemSetting()->app_logo)){{asset('/storage/uploads/files/'.systemSetting()->app_logo)}} @else {{asset('images/logo.jpg')}} @endif'
                        style='max-width:80px;max-height:80px;margin-top: 5px;' />
                </div>
                <div style=" margin-top: 10px;">
                    <strong class="{{setFont()}}"
                        style="font-size:22px; margin-left:2px;margin-top:55px; color: white;">
                        {{  @clientInfo()->name }}
                    </strong><br><br>
                    <strong class="{{setFont()}}" style="font-size:16px;margin-top:70px;margin-left:9px; color: white;">
                        @if(@clientInfo()->local_body_type_id == 4)
                        {{ getLan() == 'np' ? ' गाउँकार्यपालिकाको कार्यालय' : '
                        Office of the Village Executive' }}
                        @else
                        {{ getLan() == 'np' ? ' नगरकार्यपालिकाको कार्यालय ' : 'City Executive Office' }}
                        @endif
                        ,
                    </strong>
                    <br>
                    <strong class="{{setFont()}}" style="font-size:16px;margin-top:70px; color: white;">
{{--                        {{  @clientInfo()->district_name }} , --}}
                        {{  @clientInfo()->province_name }}
                    </strong>
                    <br>
                </div><br>
                <strong class="{{setFont()}}" style="color:white; margin-left:5px;">App Version :
                    {{ appVersion()->latest_version }}
                </strong>
                <!-- /.card-body -->
            </div>
        </div>
</body>
<style>
.container {
    display: flex;
    margin-top: 125px;
    width: 59%;
    height: 400px;
}

.panel {
    flex: 1;
    padding: 20px;
    background-color: #f0f0f0;
    color: #333;
    border-radius: 0 20px 20px 0;

}

.panel-left {
    border-radius: 20px 0 0 20px;
    border-right: 1px solid #fff;
}

.panel h2 {
    margin-top: 0;
    border-radius: 0 0 20px 20px;
}

@media only screen and (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .panel {
        border-right: none;
        margin-bottom: 20px;
    }

    .panel-right {
        display: none;
    }

    .panel-left {
        border-radius: 20px;
        width: fit-content;
    }
}
</style>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('theme-design/js/main.min.js')}}"></script>
<script src="{{asset('plugins/validation/validate.min.js')}}"></script>
<script src="{{asset('plugins/validation/additional-methods.min.js')}}"></script>

<script type="text/javascript">
$('#reload').click(function() {
    $.ajax({
        type: 'GET',
        url: 'reload-captcha',
        success: function(data) {
            $(".captcha span").html(data.captcha);
        }
    });
});
</script>
<script>
$("document").ready(function() {
    setTimeout(function() {
        $("div.alert").remove();
    }, 5000); // 5 secs

});
</script>

@if(@$load_js)
@foreach(@$load_js as $js)
<script src="{{asset($js)}}"></script>
@endforeach
@endif
<script type="text/javascript">
var site_url = "{{asset('/')}}";
@if(@$script_js) {
    !!$script_js!!
}
@endif
</script>

</html>