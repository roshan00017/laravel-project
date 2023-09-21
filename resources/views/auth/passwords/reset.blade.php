@extends('layouts.app')

@section('content')
    @if (Session::has('warning'))
        <div class="alert alert-danger {{setFont()}}">
            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
            >

            </button>
            {{ Session::get('warning') }}
        </div>
    @endif
    <form method="POST" action="{{ route('passwordReset') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="input-group mb-3">
            <input id="email"
                   type="hidden"
                   class="form-control"
                   name="email"
                   value="{{ $email }}"
            >
        </div>
        @if ($errors->has('email'))
            <div class="input-group mb-3" style="margin-top: -13px;">
                <strong style="color: red">{{ $errors->first('email') }}</strong>
            </div>
        @endif

        <div class="col-md-12 mb-3 {{setFont()}}">
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="{{trans('message.authentication.password_reset.enter_new_password')}}"
                   id="password-field"
                   required
            >
            @if($errors->has('password') == null)
                <span style="color: #d22a16; font-size: 13px; margin-top: 14px">{{trans('message.authentication.password_reset.password_info_message')}}</span>
                &nbsp;<span style="font-size: 13px;">Example : Ab1$b3wG</span>
            @endif
        </div>

        <div class="col-md-12 mb-3 {{setFont()}}">
            <input id="password_confirmation"
                   type="password"
                   class="form-control"
                   name="password_confirmation"
                    autocomplete="off"
                   placeholder="{{trans('message.authentication.password_reset.confirm_new_password')}}"
            >
        </div>
        @if ($errors->has('password_confirmation'))
            <div class="input-group mb-3" style="margin-top: -13px;">
                <strong style="color: red">{{ $errors->first('password_confirmation') }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <button type="submit"
                        class="btn btn-primary rounded-pill btn-block {{setFont()}}"
                >
                    {{trans('message.authentication.password_reset.change_password')}}
                </button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <p class="mt-3 mb-1 {{setFont()}}">
        <br>
        <a href="{{ route('login') }}" style="font-weight: 600">
            {{trans('message.authentication.forgot_password.return_to_login')}}
        </a>
    </p>
@endsection
