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
                            {{trans('message.pages.role_access.page_title')}}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right {{setFont()}}">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}">
                                    {{ trans('message.dashboard.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="#">{{trans('message.commons.roles')}}</a>
                            </li>

                            <li class="breadcrumb-item">
                                {{trans('message.pages.role_access.page_title')}}
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Content header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header"
                     style="text-align:right"
                >
                    <h3 class="card-title {{setFont()}}">
                        {{trans('message.pages.role_access.please_select_the_user_type_from_above_drop_down_menu')}}
                    </h3>
                    <a href="{{URL::previous()}}"
                       class="float-right"
                       data-toggle="tooltip"
                       title="Go Back"
                    >
                        <i class="fa fa-arrow-circle-left fa-2x"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 10px">
                            {!! Form::open(['class'=>'form-inline',
                                        'url'=>'roleManagement/permissions',
                                         'id'=>'perForm',
                                        'method'=>'GET'])
                            !!}
                            <div class="form-group col-sm-6 col-xs-6 col-md-3 col-lg-3 {{setFont()}}" >

                                {{Form::select('role_id',
                                        $roleList->pluck('name','id'),
                                        Request::get('role_id'),
                                        ['class'=>'form-control select2',
                                        'style'=>'width:100%;','required',
                                        'id'=>'role_id','placeholder'=>trans('message.pages.role_access.select_user_type')])
                                }}
                                {!! $errors->first('role_id', '<span class="text-danger">:message</span>') !!}

                            </div>
                            &nbsp; &nbsp;
                            <button type="submit"
                                    class="btn btn-primary rounded-pill btn-sm {{setFont()}}"
                                    name="filter"
                            >
                                <i class="fa fa-search" aria-hidden="true"></i>
                                {{trans('message.button.filter')}}
                            </button>
                            &nbsp; &nbsp;  &nbsp; &nbsp;
                            <a href="{{url('roleManagement/permissions')}}"
                               class="btn btn-secondary rounded-pill btn-sm {{setFont()}}"
                            > <i class="fas  fa-sync-alt"></i>
                                {{trans('message.button.reload')}}
                            </a>
                            {!! Form::close() !!}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if($request->role_id !=null)
                                <div class="table-responsive">
                                    <table class="table  table-striped table-hover">
                                        <thead class="th-header">
                                        <tr class="{{setFont()}}">
                                            <th>
                                                {{trans('message.pages.role_access.module_name')}}
                                            </th>
                                            <th>

                                            </th>
                                            <th>
                                                {{trans('message.pages.role_access.read')}}
                                            </th>
                                            <th>
                                                {{trans('message.pages.role_access.write')}}
                                            </th>
                                            <th>
                                                {{trans('message.pages.role_access.edit')}}
                                            </th>
                                            <th>
                                                {{trans('message.pages.role_access.delete')}}
                                            </th>
                                            <th>
                                                {{trans('message.pages.role_access.show')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($menus as $key=>$menu)

                                            <?php
                                            $secondLevelMenus = $menuRepo::getAccessMenu($menu->id,
                                                Request::get('role_id'));
                                            ?>
                                            <tr>
                                                <td class="{{setFont()}}">
                                                    {{ ++$key }}.
                                                    {{ getLan()=='np' ? $menu->menu_name_np : $menu->menu_name }}
                                                </td>
                                                @if(count($secondLevelMenus) == 0 && $menu->id !=1)
                                                <td>
                                                    <div class="checkbox">

                                                        <label>
                                                            <input type="checkbox"
                                                                   data-toggle="toggle"
                                                                   data-size="mini"
                                                                   data-onstyle="success"
                                                                   data-offstyle="danger"
                                                                   data-width="45"
                                                                   class="all"
                                                                   {{ ($menu->allow_index == 1 && $menu->allow_add == 1 && $menu->allow_edit == 1
                                                                    && $menu->allow_delete == 1 && $menu->allow_show == 1)?'checked':null }}
                                                                   value="{{$menu->group_role_id}}"
                                                            >
                                                        </label>
                                                        <label class="{{setFont()}}">
                                                            {{trans('message.pages.role_access.all')}}
                                                        </label>
                                                    </div>
                                                </td>
                                                @endif
                                                <td>
                                                    <div class="checkbox">

                                                        <label>
                                                            <input type="checkbox"
                                                                   data-toggle="toggle"
                                                                   data-size="mini"
                                                                   data-onstyle="success"
                                                                   data-offstyle="danger"
                                                                   data-width="45"
                                                                   class="read"
                                                                   {{ ($menu->allow_index == 1)?'checked':null }}
                                                                   value="{{$menu->group_role_id}}"
                                                            >
                                                        </label>
                                                    </div>
                                                </td>
                                                @if(count($secondLevelMenus) == 0 && $menu->id !=1)
                                                    <td><!-- Rounded switch -->
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"
                                                                       data-toggle="toggle"
                                                                       data-size="mini"
                                                                       data-onstyle="success"
                                                                       data-offstyle="danger"
                                                                       data-width="45"
                                                                       {{ ($menu->allow_add == 1)?'checked':null }}
                                                                       class="write"
                                                                       value="{{$menu->group_role_id}}"
                                                                >

                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><!-- Rounded switch -->
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"
                                                                       data-toggle="toggle"
                                                                       data-size="mini"
                                                                       data-onstyle="success"
                                                                       data-offstyle="danger"
                                                                       data-width="45"
                                                                       {{ ($menu->allow_edit == 1)?'checked':null }}
                                                                       class="edit"
                                                                       value="{{ $menu->group_role_id }}"
                                                                >
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><!-- Rounded switch -->
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"
                                                                       data-toggle="toggle"
                                                                       data-size="mini"
                                                                       data-onstyle="success"
                                                                       data-offstyle="danger"
                                                                       data-width="45"
                                                                       {{ ($menu->allow_delete == 1)?'checked':null }}
                                                                       class="delete"
                                                                       value="{{$menu->group_role_id}}"
                                                                >
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><!-- Rounded switch -->
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"
                                                                       data-toggle="toggle"
                                                                       data-size="mini"
                                                                       data-onstyle="success"
                                                                       data-offstyle="danger"
                                                                       data-width="45"
                                                                       {{ ($menu->allow_show == 1)?'checked':null }}
                                                                       class="show"
                                                                       value="{{$menu->group_role_id}}"
                                                                >
                                                            </label>
                                                        </div>
                                                    </td>
                                                @endif

                                            </tr>
                                            @if(count($secondLevelMenus) > 0)
                                                @foreach($secondLevelMenus as $val=>$secondLevelMenu)
                                                    <tr>
                                                        <td class="{{setFont()}}">
                                                            <p style="padding-left: 15px;">
                                                                {{ $key.'.'.++$val }}
                                                                .
                                                                    {{ getLan()=='np' ? $secondLevelMenu->menu_name_np : $secondLevelMenu->menu_name }}

                                                            </p>
                                                        </td>
                                                        @if($secondLevelMenu->action_module_status == 1)
                                                            <td>
                                                                <div class="checkbox">

                                                                    <label>
                                                                        <input type="checkbox"
                                                                               data-toggle="toggle"
                                                                               data-size="mini"
                                                                               data-onstyle="success"
                                                                               data-offstyle="danger"
                                                                               data-width="45"
                                                                               class="all"
                                                                               {{ ($menu->allow_index == 1 && $menu->allow_add == 1 && $menu->allow_edit == 1
                                                                                && $menu->allow_delete == 1 && $menu->allow_show == 1)?'checked':null }}
                                                                               value="{{$menu->group_role_id}}"
                                                                        >
                                                                    </label>
                                                                    <label class="{{setFont()}}">
                                                                        {{trans('message.pages.role_access.all')}}
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <div class="checkbox">

                                                                <label>
                                                                    <input type="checkbox"
                                                                           data-toggle="toggle"
                                                                           data-size="mini"
                                                                           data-onstyle="success"
                                                                           data-offstyle="danger"
                                                                           data-width="45"
                                                                           {{ ($secondLevelMenu->allow_index == 1)?'checked':null }}
                                                                           class="read"
                                                                           value="{{$secondLevelMenu->group_role_id}}"
                                                                    >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        @if($secondLevelMenu->action_module_status == 1)
                                                        <td><!-- Rounded switch -->
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox"
                                                                           data-toggle="toggle"
                                                                           data-size="mini"
                                                                           data-onstyle="success"
                                                                           data-offstyle="danger"
                                                                           data-width="45"
                                                                           {{ ($secondLevelMenu->allow_add == 1)?'checked':null }}
                                                                           class="write"
                                                                           value="{{$secondLevelMenu->group_role_id}}"
                                                                    >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><!-- Rounded switch -->
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox"
                                                                           data-toggle="toggle"
                                                                           data-size="mini"
                                                                           data-onstyle="success"
                                                                           data-offstyle="danger"
                                                                           data-width="45"
                                                                           {{ ($secondLevelMenu->allow_edit == 1)?'checked':null }}
                                                                           class="edit"
                                                                           value="{{ $secondLevelMenu->group_role_id }}"
                                                                    >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><!-- Rounded switch -->
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox"
                                                                           data-toggle="toggle"
                                                                           data-size="mini"
                                                                           data-onstyle="success"
                                                                           data-offstyle="danger"
                                                                           data-width="45"
                                                                           {{ ($secondLevelMenu->allow_delete == 1)?'checked':null }}
                                                                           class="delete"
                                                                           value="{{$secondLevelMenu->group_role_id}}"
                                                                    >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><!-- Rounded switch -->
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox"
                                                                           data-toggle="toggle"
                                                                           data-size="mini"
                                                                           data-onstyle="success"
                                                                           data-offstyle="danger"
                                                                           data-width="45"
                                                                           {{ ($secondLevelMenu->allow_show == 1)?'checked':null }}
                                                                           class="show"
                                                                           value="{{$secondLevelMenu->group_role_id}}"
                                                                    >
                                                                </label>
                                                            </div>
                                                        </td>
                                                            @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="card card-info" style="margin-top: 30px">
                                    <div class="card-header {{setFont()}}">
                                        <h3 class="card-title">
                                            <i class="fas fa-info-circle"></i>
                                            {{trans('message.pages.role_access.please_select_the_user_type_from_above_drop_down_menu')}}
                                        </h3>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    @include('backend.modal.technical-error-modal')
@endsection

