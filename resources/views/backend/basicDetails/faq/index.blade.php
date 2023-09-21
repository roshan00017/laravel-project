@extends('backend.layouts.app')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{setFont()}}">
                        {{$page_title}}
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
                                <a href="javascript:void(0);">
                                {{ trans('office.basic_details') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                            {{$page_title}}
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"
                                 style="text-align:right"
                            >
                            

                           @include('backend.basicDetails.faq.list')

                            </div>
                        </div>
                            <!-- /.card-header -->
                        <div class="card">
                            @if(sizeof($results) > 0)
                                <div class="card-body">
                                    <table id="example2"
                                           class="table table-bordered table-striped dataTable dtr-inline"
                                    >
                                        <thead class="th-header">
                                        <tr class="{{setFont()}}">
                                            <th width="10px">
                                                {{trans('message.commons.s_n')}}
                                            </th>

                                            <th>
                                            {{trans('faq.question')}}
                                            </th>
                                            <th>
                                            {{trans('faq.answer')}}
                                            </th>
                                            <th>
                                                {{ trans('message.commons.status') }}
                                            </th>
                                            <th width="10%">
                                                {{trans('message.commons.action')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th scope=row {{setFont()}}>
                                                    {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                                </th>
                                                <td>
                                                {{ getLan()=='np' ? $data->question_ne : $data->question}}
                                                </td>
                                                <td>
                                                {{ getLan()=='np' ? $data->answer_ne : $data->answer}}
                                                </td>
                                                <td class="{{setFont()}}">
                                                    @include('backend.components.buttons.status')
                                                </td>
                                                <td>
                                                    @include('backend.components.buttons.action')

                                                </td>
                                            </tr>

                                            @include('backend.modal.status_modal')
                                            @include('backend.modal.delete_modal')
                                            @include('backend.basicDetails.faq.edit')
                                            @include('backend.basicDetails.faq.show')

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <spans
                                            class="float-right"
                                            style="margin-top: 20px !important;"
                                    >
                                    {{ $results->appends(request()->except('page'))->links() }}
                                </span>
                                </div>
                            @else
                                <div class="col-md-12 {{setFont()}}"
                                     style="padding-top: 10px"
                                >
                                    <label class="form-control badge badge-pill"
                                           style="text-align:  center; font-size: 18px;"
                                    >
                                        <i class="fas fa-ban" style="margin-top: 6px"></i>
                                        {{trans('message.commons.no_record_found')}}
                                    </label>
                                </div>
                                <!-- /.card -->
                        @endif
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.row -->
            </div>  
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
        @include('backend.basicDetails.faq.add')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.check_data_modal')
    </div>

    <!-- /.content-wrapper -->

        


@endsection