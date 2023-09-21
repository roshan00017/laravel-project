<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>
        @if(systemSetting()->app_name)
            {{ getLan() =='np' ? systemSetting()->app_name_np : systemSetting()->app_name }}
        @else
            {{ env('APP_NAME') }}
        @endif
    </title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}">

    <link rel="stylesheet"
          href="{{asset('assets/css/style.css')}}">


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet"
          href="{{asset('assets/css/boostrap.min.css')}}" />

    <link rel="stylesheet"
          href="{{asset('assets/css/slick.css')}}" />


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel='stylesheet'
          href='{{ asset('assets/css/sweetalert2.min.css') }}'
    />


@if (@$load_css)
        @foreach ($load_css as $css)
            <link href="{{ asset($css) }}" rel="stylesheet" type="text/css" />
        @endforeach
    @endif

</head>