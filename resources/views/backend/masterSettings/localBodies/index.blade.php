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
                                    {{trans('message.dashboard.page_title')}}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                
                                    {{trans('localbody.local_body_name')}}
                               
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
                                @include('backend.components.buttons.list')

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
                                                {{trans('localbody.local_body_name')}}
                                            </th>
                                            <th>
                                                {{trans('localbody.total_ward')}}
                                            </th>
                                            <th>
                                            {{trans('localbody.code')}}
                                            </th>
                                            <th>
                                            {{trans('localbody.web_url')}}
                                            </th>

                                            <th>
                                            {{trans('message.commons.status')}}
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
                                                <td class="{{ setFont() }}">
                                                    {{ getLan()=='np' ? $data->name_np : $data->name_en}}
                                                </td>
                                                <td class="{{ setFont() }}">
                                                    @if(isset($data->total_ward))
                                                        {{$data->total_ward}}
                                                    @endif
                                                </td>
                                                <td class="{{ setFont() }}">
                                                    @if(isset($data->code))
                                                        {{$data->code}}
                                                    @endif
                                                </td>
                                                <td class="{{ setFont() }}">
                                                    @if(isset($data->web_url))
                                                        {{$data->web_url}}
                                                    @endif
                                                </td>
                                                
                                                
                                                <td class="{{setFont()}}">
                                                    @include('backend.components.buttons.status')
                                                </td>

                                                
                                                <td>
                                                    &nbsp;
                                                    @if (allowShow() && @$show_button == true)
                                                    @if (@$index_menu == true)
                                                        <a href="{{ url(@$page_url) }}" class="btn btn-info btn-sm rounded-pill {{ setFont() }}"
                                                            title="{{ trans('message.button.show') }}">
                                                            <i class="fas fa-eye"></i>
                                                            {{ trans('message.button.show') }}"
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
                                                            data-target="#showModal{{ $key }}" data-placement="top" title="{{ trans('message.button.show') }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    @endif
                                                @endif
        
                                            @if(allowEdit())
                                                <button type="button"
                                                        class="btn btn-info btn-xs rounded-pill "
                                                        data-toggle="modal"
                                                        data-target="#editModal{{$key}}"
                                                        data-placement="top"
                                                        title="Edit"
                                                >
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                            @endif
                                            
                                            &nbsp;
                                            @if(allowDelete())
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
                                            </tr>
                                            @include('backend.modal.status_modal')
                                            @include('backend.masterSettings.localBodies.delete')
                                            @include('backend.masterSettings.localBodies.update')
                                            @include('backend.masterSettings.localBodies.show')
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <span
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
        {{-- @include('backend.masterSettings.localBodies.show') --}}
        @include('backend.masterSettings.localBodies.add')
        @include('backend.masterSettings.localBodies.searchModal')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.check_data_modal')
        @include('backend.modal.data-submit-modal')
       
    </div>

    <!-- /.content-wrapper -->

@endsection

