@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
  <!-- Content header (Page header) -->
  @include('backend.message.flash')
  <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                        {{ getLan() == 'np' ? $value->name.' समूह सदस्य' : $value->name.' Group Member' }}

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
                            <a href="{{ url('group') }}">
                                {{ $page_title }}
                            </a>
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

                     <div class="card">
                            <div class="card-header" style="text-align:right">
                                @if (allowAdd())
                                <button
                                        class="btn btn-primary btn-sm float-left boxButton rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#addModal"
                                        title="{{trans('message.button.add_new')}}"
                                >
                                    <i class="fa fa-plus-circle"></i>
                                        {{ trans('chat.add_member') }}
                                </button>
                                @endif

                            </div>
                        </div>

    
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
                                                @if($user_info == $created_by)
                                                <th width="20%">
                                                    {{ trans('chat.remove_user') }}
                                                </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($results as $key => $data)
                                                <tr>
                                                    <th scope=row {{ setFont() }}>
                                                    {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                                    </th>
                                                    <td class="{{ setFont() }}">
                                                    {{ getLan() == 'np' ? $data->full_name_np : $data->full_name }}
                                                    {{-- $data->member_id --}}

                                                    </td>
                                                    @if($user_info == $created_by && $data->member_id != $created_by)
                                                        <td class="{{ setFont() }}">
                                                            <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
                                                                data-target="#deleteModal{{ $key }}" data-placement="top"
                                                                title="{{ trans('message.button.delete') }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    @endif

                                                </tr>
                                                @include('backend.chatModule.group.delete_modal_member')
                                              
                                          
                                               
                                            @endforeach
                                        </tbody>
                                    </table>
                                  
                              
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

                            <br>
                           
                            <div class="col-md-6">
                                <a href="{{ url('group') }}" class="btn btn-info rounded-pill {{ setFont() }}">
                                    <i class="fa fa-arrow-alt-circle-left"></i>
                                    {{ trans('chat.group_index') }}
                                </a>
                            </div>
                           
                        </div>
                        </div>

                        
                        @include('backend.chatModule.group.add_model')
                       
       
</div>
    @endsection