<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title class="{{ setFont() }}">
        @if (isset(systemSetting()->app_name))
            {{ getLan() == 'np' ? systemSetting()->app_name_np : systemSetting()->app_name }}
        @else
            {{ env('APP_NAME') }}
        @endif
        | {{ trans('auth.passwordReset.title') }}

    </title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}">
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }
    </style>
    <style>
        @font-face {
            font-family: "Kalimati";
            src: url("../fonts/kalimati.ttf") format("truetype");
        }

        .f-kalimati {
            font-family: "Kalimati";
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
<!--100% body table-->
<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
       style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;" class="{{setFont()}}">
    <tr>
        <td>
            <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                   align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="{{ url('/') }}" title="logo" target="_blank">
                            <img width="80" src="{{ asset('images/logo.jpg') }}" title="logo" alt="logo">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                               style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding:0 35px;">
                                    <h3 class="{{ setFont() }}"
                                        style="color:#1e1e2d; font-weight:500; margin:0;font-size:22px;">
                                        {{ trans('suchikritFrontEnd.congrats') }}
                                        <br>
                                        {{ $full_name }}
                                        {{ trans('suchikritFrontEnd.head_sub_title') }}
                                    </h3>
                                    <br>
                                    <p class="{{setFont()}}">
                                       {{ trans('suchikritFrontEnd.maillinefirst') }}
                                        <br>
                                        {{ trans('suchikritFrontEnd.maillinesecond') }}
                                        <br>
                                        {{ trans('suchikritFrontEnd.maillinethird') }}
                                        <br>
                                        {{ trans('suchikritFrontEnd.maillinefourth') }}
                                    </p>

                                    <p class="{{setFont()}}"> 
                                        {{ trans('suchikritFrontEnd.otp') }} 
                                        <strong>{{ $otp }}</strong></p>
                                    <p style="color: red;font-size: 16px;" class="{{setFont()}}">
                                        {{ trans('suchikritFrontEnd.maillinefifth') }} <br>
                                        {{ trans('suchikritFrontEnd.maillinesixth') }}
                                    </p>
                                    <p>
                                        {{trans('suchikritFrontEnd.loginid')}} : <strong>{{ $email}} / {{$mobile}}</strong>
                                    <p class="{{setFont()}}">
                                        {{ trans('suchikritFrontEnd.maillineseventh') }}
                                        <a href="{{ route('otpVerify',['token'=>encrypt($otp)]) }}"
                                           style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff;  background: #1b5696;; border-radius: 60px; text-decoration:none;"
                                        >
                                        {{ trans('suchikritFrontEnd.click') }} </a>
                                    <p>
                                    <br>
                                    <p class="{{ setFont() }}"
                                       style="color:#1e1e2d; font-size:18px;line-height:24px; margin:0;">
                                        {{ trans('suchikritFrontEnd.thankyou') }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <p
                                style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                            &copy; <?php echo date('Y'); ?>
                            <strong class="{{ setFont() }}">
                                @if (systemSetting()->app_name)
                                    {{ getLan() == 'np' ? systemSetting()->app_name_np : systemSetting()->app_name }}
                                @else
                                    {{ env('APP_NAME') }}
                                @endif
                            </strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
