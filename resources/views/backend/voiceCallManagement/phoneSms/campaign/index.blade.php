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
                                {{$page_title}}
                            </li>
                            <li class="breadcrumb-item">
                                {{ trans('message.button.list') }}
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
                            <div class="card-header" style="text-align:right">
                                <a href="{{url($page_url)}}"
                                   class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
                                   data-toggle="tooltip" title="{{trans('message.button.list')}}">
                                    <i class="fa fa-list"></i>
                                    {{trans('message.button.list')}}
                                </a>
                                <button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#searchModal"
                                        title="{{ trans('message.button.filter') }}">
                                    <i class="fas fa-filter"></i>
                                    {{ trans('message.button.filter') }}
                                </button>

                                @if( $request->module_name !=null || $request->module_unique_id !=null ||
                                    $request->from_date !=null || $request->to_date !=null || $request->services !=null

                                )

                                    <a href="{{url(@$page_url)}}"
                                       class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}"
                                       title="{{ trans('message.button.reload') }}"
                                    >
                                        <i class="fas  fa-undo"></i>
                                        {{ trans('message.button.reload') }}
                                    </a>

                                @endif
                                @if (allowAdd())
                                    <button
                                            class="btn btn-primary btn-sm float-left boxButton rounded-pill {{ setFont() }}"
                                            data-toggle="modal" data-target="#addModal"
                                            title="{{ trans('message.button.add_new') }}">
                                        <i class="fa fa-plus-circle"></i>
                                        {{ trans('message.button.add_new') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            @if(sizeof($results) > 0)
                                <div class="card-body">
                                    <table id="example2"
                                           class="table table-bordered table-striped dataTable dtr-inline">
                                        <thead class="th-header">
                                        <tr class="{{setFont()}}">
                                            <th width="5%">
                                                {{trans('message.commons.s_n')}}
                                            </th>
                                            <th width="13%">
                                                {{trans('voiceCallManagement.date')}}
                                            </th>
                                            <th>
                                                {{trans('voiceCallManagement.moduleName')}}
                                            </th>
                                            <th>
                                                {{trans('voiceCallManagement.title')}}
                                            </th>
                                            <th>
                                                {{trans('voiceCallManagement.service')}}
                                            </th>
                                            <th>
                                                {{ trans('voiceCallManagement.mobile_count') }}
                                            </th>
                                            <th>
                                                {{ trans('message.commons.status') }}
                                            </th>
                                            <th width="8%">
                                                {{ trans('message.commons.action') }}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th scope=row {{setFont()}}>
                                                    {{++$key}}
                                                </th>
                                                <td class="{{setFont()}}">
                                                    {{ getLan() == 'np' ? $data->campaign_added_date_np : $data->campaign_added_date_en }}
                                                    <br>
                                                    {{ \Carbon\Carbon::parse($data->created_at)->format('g:i A') }}

                                                </td>
                                                <td class="{{setFont()}}">
                                                    @if (isset($data->module_name))
                                                        {{ moduleName($data->module_name) }}
                                                    @endif

                                                </td>
                                                <td class="{{setFont()}}">
                                                    @if($data->campaign_name !=null)
                                                        {{$data->campaign_name}}
                                                    @endif

                                                </td>
                                                <td class="{{setFont()}}">
                                                    @if (isset($data->campaign_service))
                                                        {{ tingTingService($data->campaign_service) }}
                                                    @endif

                                                </td>
                                                <td class="{{setFont()}}">
                                                    @if (isset($data->campaign_number_count))
                                                        {{ $data->campaign_number_count }}
                                                    @endif

                                                </td>
                                                <td class="{{setFont()}}">
                                                    @if (isset($data->campaign_status))
                                                        @if($data->campaign_status =='Not Started')
                                                            <button class="btn btn-warning btn-xs rounded-pill">
                                                                {{ $data->campaign_status }}

                                                            </button>
                                                        @elseif($data->campaign_status =='Completed')
                                                            <button class="btn btn-success btn-xs rounded-pill">
                                                                {{ $data->campaign_status }}

                                                            </button>
                                                        @else
                                                            <button class="btn btn-secondary btn-xs rounded-pill">
                                                                {{ $data->campaign_status }}

                                                            </button>
                                                        @endif
                                                    @endif

                                                </td>
                                                <td>
                                                    @if (allowShow())
                                                        <a href="{{route($page_route.'.'.'show', hashIdGenerate( $data->id))}}"
                                                           class="btn btn-secondary btn-xs rounded-pill {{setFont()}}"
                                                           title="{{trans('message.button.show')}}">
                                                            <i class="fas fa-eye"></i>

                                                        </a>
                                                    @endif
                                                    &nbsp;

                                                    @if(allowEdit())

                                                        <button type="button"
                                                                class="btn btn-info btn-xs rounded-pill {{setFont()}}"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{$key}}"
                                                                data-placement="top"
                                                                title="{{trans('message.button.edit')}}"
                                                        >
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                    @endif
                                                        &nbsp;
                                                    @if(allowDelete() && systemAdmin() ==true)
                                                        <button type="button"
                                                                class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{$key}}"
                                                                data-placement="top"
                                                                title="{{trans('message.button.delete')}}"
                                                        >
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                @include('backend.voiceCallManagement.phoneSms.campaign.edit')
                                                @include('backend.voiceCallManagement.phoneSms.campaign.deleteModal')


                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <span class="float-right {{setFont()}}">
                                        {!! urldecode(str_replace("/?","?",$results->appends(Request::all())->render())) !!}
                                    </span>
                                </div>
                            @else
                                <div class="col-md-12 {{setFont()}}" style="padding-top: 10px">
                                    <label class="form-control badge badge-pill"
                                           style="text-align:  center; font-size: 18px;">
                                        <i class="fas fa-ban" style="margin-top: 6px"></i>
                                        {{trans('message.commons.no_record_found')}}
                                    </label>
                                </div>
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
        @include('backend.modal.technical-error-modal')
        @include('backend.voiceCallManagement.phoneSms.campaign.add')
        @include('backend.voiceCallManagement.phoneSms.campaign.searchModal')
        @include('backend.modal.data-submit-modal')
    </div>

    <!-- /.content-wrapper -->

@endsection