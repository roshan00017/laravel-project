@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                            {{ $page_title }} {{ trans('message.pages.roles.details') }}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right {{ setFont() }}">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    {{ trans('message.dashboard.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ url($page_url) }}">
                                    {{ $page_title }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{ trans('message.pages.roles.details') }}
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')

            <!-- /.row -->


            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        @include('backend.components.buttons.returnBack')

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tbody>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('suggestion.date') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($value->incident_submit_date_np))
                                            {{ getLan() == 'np' ? $value->incident_submit_date_np : $value->incident_submit_date_en }}
                                            <i class="fa fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($value->created_at)->format('g:i A') }}
                                        @endif
                                    </td>
                                </tr>


                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('suggestion.name') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($value->name))
                                            {{ $value->name }}
                                        @endif
                                    </td>
                                </tr>


                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.mobile_no') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($value->mobile))
                                            {{ $value->mobile }}
                                        @endif
                                    </td>
                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('suggestion.email') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($value->email))
                                            {{ $value->email }}
                                        @endif
                                    </td>
                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('suggestion.title') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($value->title))
                                            {{ $value->title }}
                                        @endif
                                    </td>
                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('suggestion.description') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($value->description))
                                            {{ $value->description }}
                                        @endif
                                    </td>
                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('suggestion.file') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($value->file))
                                            <a href="{{ URL::to('/storage/' . $filePath . '/' . $value->file) }}"
                                                target="_blank" class="btn btn-secondary btn-xs rounded-pill"
                                                data-placement="top" title="{{ trans('message.pages.common.viewFile') }}">
                                                <i class="fa fa-file"></i>
                                            </a>
                                            &nbsp;
                                            <a href="{{ URL::to('/storage/' . $filePath . '/' . $value->file) }}"
                                                class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" download
                                                data-toggle="tooltip" title="Download File">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
@endsection
