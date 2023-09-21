@extends('layouts.app')

@section('content')

    @if (Session::has('status'))
        <div class="alert alert-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
            >
            </button>
            {{ Session::get('status') }}
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success {{setFont()}}">
            <i class="fa fa-check" aria-hidden="true"></i>
            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
            >

            </button>
            {{ Session::get('success') }}
        </div>
    @endif
    @if ( $errors->has('identity') || $errors->has('role') || Session::has('forgotError'))

        <div class="alert btn-sm alert-danger {{setFont()}}">
            <span type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
            >

            </span>
            {{ $errors->first('identity') }}
            {{ Session::get('forgotError') }}
            {{ $errors->first('role') }}
        </div>
    @endif

    {!! Form::open(['method'=>'post',
                'url'=>'forgotPassword',
                'id'=>'password_reset'
                ])
    !!}
    <div class="input-group mb-3 {{setFont()}}">
        {!! Form::email('identity',null,
                    ['class'=>'form-control','
                    placeholder'=>trans('message.authentication.forgot_password.enter_your_email_address'),
                    'id'=>'identity','required'])
         !!}
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit"
                    class="btn btn-primary  rounded-pill btn-block {{setFont()}}"
                    id="bnt-submit"
            >
                {{trans('message.authentication.forgot_password.request_new_password')}}
            </button>
        </div>
    </div>
    {!! Form::close() !!}
    <p class="mt-3 mb-1 {{setFont()}}">
        <br>
        <a href="{{ route('login') }}" style="font-weight: 600">
            {{trans('message.authentication.forgot_password.return_to_login')}}
        </a>
    </p>
    @include('backend.modal.data-submit-modal')
@endsection
