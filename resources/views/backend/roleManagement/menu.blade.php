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
                            {{trans('message.pages.menu.page_title')}}
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
                                    {{trans('message.commons.roles')}}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{trans('message.pages.menu.page_title')}}
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
                                        <div class="card-header {{setFont()}}"
                                             style="text-align:right"
                                        >
                                            <a href="{{url($page_url)}}"
                                               class="btn btn-secondary btn-sm float-left  boxButton rounded-pill"
                                               data-toggle="tooltip"
                                               title=" {{trans('message.button.list')}}"
                                            >
                                                <i class="fa fa-list"></i>
                                                {{trans('message.button.list')}}
                                            </a>

                                        </div>
                                        <!-- /.card-header -->
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
                                                        {{trans('message.pages.menu.parentMenu')}}
                                                    </th>
                                                    <th>
                                                        {{trans('message.pages.menu.menuName')}}
                                                    </th>
                                                    <th>
                                                        {{trans('message.pages.menu.menuLink')}}
                                                    </th>
                                                    <th class="text-center">
                                                        {{trans('message.pages.menu.icon')}}
                                                    </th>
                                                    <th style="width: 30px"
                                                        class="text-centered"
                                                    >
                                                        {{trans('message.commons.status')}}
                                                    </th>
                                                    <th class="text-right">
                                                        {{trans('message.pages.menu.order')}}
                                                    </th>
                                                    <th width="8%">
                                                        {{trans('message.commons.action')}}
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($menus as $key=>$data)
                                                    <tr>
                                                        <th scope=row {{setFont()}}>
                                                            {{ ($menus->currentpage()-1) * $menus->perpage() + $key+1 }}
                                                        </th>
                                                        <td>
                                                            @if(isset($data->parent->menu_name))

                                                                <label class="badge badge-secondary"> {{$data->parent->menu_name}}</label>
                                                            @else
                                                                <label class="badge badge-info">Is a Parent</label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{$data->menu_name}}
                                                        </td>
                                                        <td>
                                                            @if($data->menu_link !=null)
                                                                {{$data->menu_link}}
                                                            @else
                                                                <label class="badge badge-info"> Parent Menu</label>

                                                            @endif
                                                        </td>

                                                        <td class="text-center">
                                                            <i class="{!! $data->menu_icon !!}"
                                                               aria-hidden="true"
                                                            >
                                                            </i>
                                                        </td>
                                                        <td class="{{setFont()}}">
                                                            @if($data->menu_status == '1')
                                                                <button type="button"
                                                                        class="btn btn-success btn-xs rounded-pill"
                                                                        data-toggle="modal"
                                                                        data-target="#statusModal{{$key}}"
                                                                        title="Click here update  status"
                                                                >
                                                                    {{trans('message.button.active')}}
                                                                </button>
                                                            @elseif($data->menu_status== '0')
                                                                <button type="button"
                                                                        class="btn btn-danger btn-xs rounded-pill"
                                                                        data-toggle="modal"
                                                                        data-target="#statusModal{{$key}}"
                                                                        title="Click here update  status"
                                                                >
                                                                    {{trans('message.button.inactive')}}
                                                                </button>
                                                            @endif
                                                                @include('backend.modal.status_modal')
                                                        </td>
                                                        <!-- /.modal -->
                                                        <td class="text-center">
                                                            {{$data->menu_order}}
                                                        </td>
                                                            <td>
                                                                @if(allowEdit())
                                                                    <button type="button"
                                                                            class="btn btn-info btn-xs rounded-pill"
                                                                            data-toggle="modal"
                                                                            data-target="#editModal{{$key}}"
                                                                            data-placement="top"
                                                                            title="Edit"
                                                                    >
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </button>
                                                            @endif
                                                                <!-- Edit Modal Start -->
                                                                    <div class="modal fade"
                                                                         id="editModal{{$key}}"
                                                                    >
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content modal-content-radius"
                                                                            >
                                                                                <div class="modal-header btn btn-primary rounded-pill">
                                                                                    <h4 class="modal-title {{setFont()}}">
                                                                                        {{trans('message.commons.edit')}}
                                                                                    </h4>
                                                                                    <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close"
                                                                                    >
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body {{setFont()}}">
                                                                                    {!! Form::model($data,['method'=>'PUT',
                                                                                            'route'=>['menus.update',$data->id]])
                                                                                    !!}
                                                                                    <div class="row">
                                                                                        <div class="form-group col-md-6">
                                                                                            <label>
                                                                                                {{trans('message.pages.menu.parentMenu')}}
                                                                                            </label>
                                                                                            {{Form::select('parent_id',
                                                                                                       $parentList->pluck('menu_name','id'),
                                                                                                       Request::get('parent_id'),
                                                                                                       ['class'=>'form-control select2',
                                                                                                       'style'=>'width: 100%;',
                                                                                                       'placeholder'=> 'Select Parent Menu'])
                                                                                            }}

                                                                                            {!! $errors->first('user_type_id', '<span class="test text-danger">:message</span>') !!}
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label>
                                                                                                {{trans('message.pages.menu.menuName')}}
                                                                                            </label>
                                                                                            <label class="text text-danger">
                                                                                                *
                                                                                            </label>

                                                                                            {!! Form::text('menu_name',null,
                                                                                                        ['class'=>'form-control',
                                                                                                        'placeholder'=>'Enter Menu Name',
                                                                                                        'required'])
                                                                                            !!}
                                                                                            {!! $errors->first('menu_name', '<span class="test text-danger">:message</span>') !!}
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label>
                                                                                                {{trans('message.pages.menu.icon')}}
                                                                                            </label>
                                                                                            <label class="text text-danger">
                                                                                                *
                                                                                            </label>

                                                                                            {!! Form::text('menu_icon',null,
                                                                                                        ['class'=>'form-control',
                                                                                                        'placeholder'=>'Enter Menu Icon',
                                                                                                        'required'])
                                                                                            !!}
                                                                                            {!! $errors->first('menu_icon', '<span class="text text-danger">:message</span>') !!}
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <label>
                                                                                                {{trans('message.pages.menu.order')}}
                                                                                            </label>
                                                                                            <label class="text text-danger">
                                                                                                *
                                                                                            </label>

                                                                                            {!! Form::number('menu_order',
                                                                                                    null,['class'=>'form-control',
                                                                                                    'min'=>'1','required'])
                                                                                            !!}
                                                                                            {!! $errors->first('menu_order', '<span class="text text-danger">:message</span>') !!}
                                                                                        </div>

                                                                                    </div>


                                                                                    <div class="modal-footer justify-content-center">

                                                                                        @include('backend.components.buttons.updateAction')
                                                                                    </div>
                                                                                    {!! Form::close() !!}
                                                                                </div>
                                                                                <!-- /.modal-content -->
                                                                            </div>
                                                                            <!-- /.modal-dialog -->
                                                                        </div>
                                                                    </div>
                                                                    <!-- /Add Modal End -->
                                                            </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <span
                                                    class="float-right">{{ $menus->appends(request()->except('page'))->links() }}
                                            </span>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>

                            <!-- /.col -->
                        </div>
                </div>
                <!-- /.row -->
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection
