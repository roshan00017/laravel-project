@extends('backend.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                            {{ $page_title }}
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
                                {{ $page_title }}
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
                                <a href="{{ url($page_url) }}"
                                    class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{ setFont() }}"
                                    data-toggle="tooltip" title="{{ trans('message.button.list') }}">
                                    <i class="fa fa-list"></i>
                                    {{ trans('message.button.list') }}
                                </a>

                                <button class="btn btn-info btn-sm float-right rounded-pill {{ setFont() }}"
                                    data-toggle="modal" data-target="#searchModal"
                                    title="{{ trans('message.button.filter') }}">
                                    <i class="fas fa-filter"></i>
                                    {{ trans('message.button.filter') }}
                                </button>

                                
                                @if( $request->name !=null || $request->details !=null || $request->total_members   )

                                <a href="{{url(@$page_url)}}" class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}" title="{{ trans('message.button.reload') }}">
                                    <i class="fas  fa-undo"></i>
                                    {{ trans('message.button.reload') }}
                                </a>

                                @endif


                                @if ($request->title != null)
                                    <a href="{{ url(@$page_url) }}"
                                        class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{ setFont() }}"
                                        title="{{ trans('message.button.reload') }}">
                                        <i class="fas  fa-undo"></i>
                                        {{ trans('message.button.reload') }}
                                    </a>
                                @endif

                                @if (allowAdd())
                                    <a href="{{ url('groupInfo') }}"
                                        class="btn btn-primary btn-sm float-left boxButton boxButton rounded-pill {{ setFont() }}"
                                        title="{{ trans('message.button.add_new') }}">
                                        <i class="fa fa-plus-circle"></i>
                                        {{ trans('message.button.add_new') }}
                                    </a>
                                @endif

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card">
                            @if (sizeof($results) > 0)
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                                        <thead class="th-header">
                                            <tr class="{{ setFont() }}">
                                                <th width="10px">
                                                    {{ trans('message.commons.s_n') }}
                                                </th>


                                                <th>
                                                    {{ trans('chat.group_name') }}
                                                </th>
                                                <th>
                                                    {{ trans('chat.group_details') }}
                                                </th>
                                                <th>
                                                    {{ trans('chat.total_member') }}
                                                </th>
                                                <th>
                                                    {{ trans('chat.group_creator') }}
                                                </th>

                                                <th width="20%">
                                                    {{ trans('message.commons.action') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($results as $key => $data)
                                                <tr>
                                                    <th scope=row {{ setFont() }}>
                                                        {{ ($results->currentpage() - 1) * $results->perpage() + $key + 1 }}
                                                    </th>
                                                    <td class="{{ setFont() }}">
                                                        {{ $data->name }}
                                                        
                                                    </td>
                                                    <td class="{{ setFont() }}">
                                                        {{ $data->details }}
                                                    </td>
                                                    <td class="{{ setFont() }}">
                                                        {{ $data->total_members}}
                                                    </td>
                                                    <td class="{{ setFont() }}">
                                                    @if($userinfo == $data->created_by)
                                                    <strong class="badge badge-secondary {{setFont()}}">{{getLan() == 'np' ? 'तपाई' : 'You'}}</strong>
                                                    @endif

                                                    </td>

                                                    <td class="{{ setFont() }}">
                                                    <button type="button" class="btn btn-info btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
                                                        data-target="#editModal{{ $key }}" data-placement="top"
                                                        title="{{ trans('message.button.edit') }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>

                                                    <a href="{{ route($page_route . '.' . 'show', hashIdGenerate($data->id)) }}"
                                                    class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}"
                                                        title="{{ trans('message.button.show') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                   
                                                    <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
                                                        data-target="#deleteModal{{ $key }}" data-placement="top"
                                                        title="{{ trans('message.button.delete') }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                        

                                                    </td>

                                                </tr>
                                                @include('backend.chatModule.group.editGroup')
                                                @include('backend.chatModule.group.delete_modal_group')
                                               
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <span class="float-right {{ setFont() }}">
                                        {{ $results->appends(request()->except('page'))->links() }}
                                    </span>
                                </div>
                            @else
                                <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                                    <label class="form-control badge badge-pill"
                                        style="text-align:  center; font-size: 18px;">
                                        <i class="fas fa-ban" style="margin-top: 6px"></i>
                                        {{ trans('message.commons.no_record_found') }}
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
        @include('backend.modal.data-submit-modal')
        @include('backend.chatModule.group.search_modal')
    
    </div>

    <!-- /.content-wrapper -->

@endsection
