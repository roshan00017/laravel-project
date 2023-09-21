@extends('layouts.app')
@section('content')
@if (Session::has('success'))
<div class="alert alert-success {{setFont()}}">
    <i class="fa fa-check" aria-hidden="true"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">

    </button>
    {{ Session::get('success') }}
</div>
@endif

@if (Session::has('error') || Session::has('forgotError') || Session::has('server_error'))
<div class="alert alert-danger {{setFont()}}">
    <i class="fa fa-times" aria-hidden="true"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">

    </button>
    {{ Session::get('error') }}
    {{ Session::get('forgotError') }}
    {{ Session::get('server_error') }}
</div>
@endif

@if ( $errors->has('login_user_name') || $errors->has('email') || $errors->has('mobile_no') )

<div class="alert alert-danger {{setFont()}}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">

    </button>
    {{ $errors->first('email') }}
    {{ $errors->first('login_user_name') }}
    {{ $errors->first('mobile_no') }}
</div>
@endif
@php
if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass']))
{
$login_user_name = $_COOKIE['login_email'];
$login_pass = $_COOKIE['login_pass'];
$is_remember = "checked='checked'";
}
else{
$login_user_name ='';
$login_pass = '';
$is_remember = "";
}
@endphp
{!! Form::open(['method'=>'post','route'=>'login','id'=>'loginForm']) !!}

<div class="input-group mb-3 {{setFont()}}">


    {!! Form::text('identity',$login_user_name,
    ['class'=>'form-control',
    'placeholder'=>trans('message.authentication.login.user_name_or_email_address'),
    'autocomplete'=>'off',
    'id'=>'identity','required'])
    !!}
</div>
@if ($errors->has('identity'))
<div class="input-group mb-3" style="margin-top: -13px;">
    <strong style="color: red">{{ $errors->first('identity') }}</strong>
</div>
@endif

<div class="input-group mb-3 {{setFont()}}">


    <input type="password" name="password" value="{{$login_pass}}" class="form-control"
        placeholder="{{trans('message.authentication.login.password')}}" id="password-field" required>
    <div class="input-group-append">
        <div class="input-group-text">
            <i class="fa fa-eye field-icon toggle-password" toggle="#password-field" data-toggle="tooltip"
                title="Show Password"></i>
        </div>
    </div>
</div>

@if ($errors->has('password'))
<div class="input-group mb-3" style="margin-top: -13px;">
    <strong style="color: red">{{ $errors->first('password') }}</strong>
</div>
@endif

@if(systemSetting() && systemSetting()->login_captcha_required == 1)
<div class="form-group">
    <div class="captcha">
        <span>{!! captcha_img() !!}</span>
        &nbsp; &nbsp;
        <button type="button" class="btn btn-info" id="reload" data-toggle="tooltip" title="Refresh Captcha">
            &#x21bb;
        </button>
    </div>
</div>
<div class="form-group">
    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" autocomplete="off">
</div>
@if ($errors->has('captcha'))
<div class="input-group mb-3" style="margin-top: -13px;">
    <strong style="color: red">{{ $errors->first('captcha') }}</strong>
</div>
@endif
@endif
<div class="row">
    <div class="col-8">
        <div class="icheck-primary">
            <input type="checkbox" id="remember" name="rememberme" {{$is_remember}}>
            <label for="remember">
                Remember Me
            </label>
        </div>
    </div>
</div>
<div class="col-xs-12">
    <button type="submit" class="btn btn-primary rounded-pill btn-block {{setFont()}}" id="bnt-submit">
        {{trans('message.authentication.login.sign_in')}}
    </button>
</div>
{!! Form::close() !!}
@if(systemSetting() && systemSetting()->forget_password_required == 1)
<p class="mb-1 {{setFont()}}">
    <br>
    <a href="{{ route('password.request') }}" style="font-weight: 600">
        {{trans('message.authentication.login.forgot_password')}}
    </a>
</p>
@endif
@endsection