@extends('backend.layouts.app')
<title>@yield('page_title',trans('errorPage.401.title'))</title>
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <center><div class="error-page">
                    <h2 class="text-red {{setFont()}}"
                        style="font-size: 50px;"
                    >
                        401
                    </h2>
                </div>

                <div class="error-content">
                    <h3 class="text-red {{setFont()}}">
                        <i class="fa fa-warning"></i>
                        {{trans('errorPage.401.error_title')}}
                    </h3>
                    <p style="font-size: 20px;" class="{{setFont()}}">
                        {{trans('errorPage.401.error_description')}}
                        <br>
                        {{trans('errorPage.401.error_sub_description')}}
                        <br> <br>
                        <a
                                class="btn btn-danger"
                                href="{{URL::previous()}}"
                        >
                            <i class="fa fa-arrow-left"> </i>
                            {{trans('errorPage.401.error_back')}}
                        </a>
                    </p>
                </div>
                <div>
                </div>
            </center>
        </section>
    </div>
@endsection
