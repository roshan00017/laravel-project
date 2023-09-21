@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 {{setFont()}}">
                        {{ $page_title}}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right {{setFont()}}">
                        <li class="breadcrumb-item">
                            <a href="{{url('dashboard')}}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                {{ trans('message.dashboard.page_title') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{url($page_url)}}" >
                                {{$page_title}}
                            </a>
                        </li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card card-default">
        <div class="card-header bg-primary" data-card-widget="collapse">
            <h3 class="card-title " >{{$advancesearch}} </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="card" style="border-radius: 24px !important;">
                                <div class="card-header p-2 {{setFont()}}">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link rounded-pill  {{ setFont() }} {{ ($request->filter_module == 'chalaniKitab') ? 'active' : '' }}" style="font-weight: 900;" href="#chalaniKitab" data-toggle="tab">
                                                {{ $dispatch_book}}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link rounded-pill  {{ setFont() }} {{ ($request->filter_module == 'dartaKitab') ? 'active' : '' }}" style="font-weight: 900;" href="#dartaKitab" data-toggle="tab">
                                                {{$darta_kitab}}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link rounded-pill  {{ setFont() }} {{ ($request->filter_module == 'document') ? 'active' : '' }}" style="font-weight: 900;" href="#document" data-toggle="tab">
                                                {{$document}}
                                            </a>
                                        </li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body {{setFont()}}">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="dartaKitab">
                                            @include('backend.edmis.masterSearch.dartaKitab')
                                        </div>
                                        <div class="tab-pane" id="document">
                                            @include('backend.edmis.masterSearch.document')
                                        </div>
                                        <div class="tab-pane" id="chalaniKitab">
                                            @include('backend.edmis.masterSearch.chalaniKitab')
                                        </div>
                                    </div><!-- /.tab-content -->

                                    @if ($request->filter_module == 'document')
                                        
                                        {{-- Load document form --}}
                                        @include('backend.edmis.masterSearch.documentindex')
                                    @elseif ($request->filter_module == 'chalaniKitab')
                                        {{-- Load chalaniKitab form --}}
                                        @include('backend.edmis.masterSearch.chalaniKitabindex')
                                    @elseif ($request->filter_module == 'dartaKitab')
                                        {{-- Load dartaKitab form --}}
                                        @include('backend.edmis.masterSearch.dartaKitabIndex')
                                    @endif

                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.form-group -->
                </div><!-- /.col-md -->
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




