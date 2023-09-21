<!doctype html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta charset="UTF-8">
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

<div class="container" style="margin-left:30px;  text-align: center;">
    <a href="{{ url('/') }}" title="logo" target="_blank">
        <img width="80" src="{{ asset('images/logo.jpg') }}" title="logo" alt="logo">
    </a>
    <br>
    <h1>  {{ trans('grievanceInfo.hello') }}</h1>
    <p>
        <strong>
            {{ trans('grievanceInfo.dear') }}    {{ $name }} {{ trans('grievanceInfo.sir/madam') }}
        </strong>
    <p>
    <p class="lead">
        {{ trans('grievanceInfo.description1') }} {{$complaint_no}} {{ trans('grievanceInfo.description2') }}
        <br>
        {{ trans('grievanceInfo.description3') }}
    </p>
    <p> {{ trans('grievanceInfo.ticket_no') }} <strong>{{ $complaint_no }}</strong></p>
   

    
    <p>
        <strong>
            {{ trans('grievanceInfo.thank_you') }}
            <br>

        </strong>
    <p>
        <br/>
    <div class="col-md-12">
        <div>
            <hr style="width: 100%;">
            <br> © 2023 <a href="{{ url('/') }}" style="color:#337ab7; margin-bottom: 10px; text-decoration: none;">ई-कार्यालय</a>
        </div>
    </div>
</div>
</body>
</html>

