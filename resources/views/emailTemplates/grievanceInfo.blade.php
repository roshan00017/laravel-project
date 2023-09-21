<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('grievanceInfo.title') }}</title>
</head>
<body style="width: 100%; border: 3px solid #cccccc">
<br>
<div class="container" style="margin-left:30px;  text-align: center;">
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
