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
                            {{ trans('message.pages.meeting_member.page_title') }}
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
                                <a href="javascript:void(0);">
                                    {{ trans('message.pages.meeting_member.page_title') }}
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

                                @if (
                                    $request->name != null ||
                                        $request->is_invite != null ||
                                        $request->contact_no != null ||
                                        $request->meeting_id != null ||
                                        $request->email != null)
                                    <a href="{{ url(@$page_url) }}"
                                        class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{ setFont() }}"
                                        title="{{ trans('message.button.reload') }}">
                                        <i class="fas  fa-undo"></i>
                                        {{ trans('message.button.reload') }}
                                    </a>
                                @endif

                                @if (allowAdd())
                                    <a href="{{url(@$page_url .'/create')}}" 
                                    class="btn btn-primary btn-sm float-left boxButton rounded-pill {{ setFont() }}" 
                                    title="{{ trans('message.button.add_new') }}">
                                        <i class="fa fa-plus-circle"></i>
                                        {{ trans('message.button.add_new') }}
                                    </a>
                                @endif

                            </div>
                            <!-- /.card-header -->
                            <div class="card">
                                @if (sizeof($results) > 0)
                                    <div class="card-body">
                                        <table id="example2"
                                            class="table table-bordered table-striped dataTable dtr-inline">
                                            <thead class="th-header">
                                                <tr class="{{ setFont() }}">

                                                    <th width="3%">
                                                        {{ trans('message.commons.s_n') }}
                                                    </th>
                                                    <th width="10px">
                                                        {{ trans('message.pages.meeting_member.meeting_code') }}
                                                    </th>
                                                    
                                                    <th width="10px">
                                                        {{ trans('meeting.meeting.title') }}
                                                    </th>

                                                    <th width="10px">
                                                        {{ trans('message.pages.meeting_member.name') }}
                                                    </th>

                                                    <th width="10px">
                                                        {{ trans('message.pages.meeting_member.office') }}
                                                    </th>

                                                    <th width="10px">
                                                        {{ trans('message.pages.common.designation') }}
                                                    </th>

                                                    <th width="10px">
                                                        {{ trans('message.pages.meeting_member.contact_no') }}
                                                    </th>

                                                    <th width="10%">
                                                        {{ trans('message.pages.meeting_member.email') }}
                                                    </th>

                                                    <th width="10%">
                                                        {{ trans('message.pages.meeting_member.is_invite') }}
                                                    </th>

                                                    <th width="10%">
                                                        {{ trans('message.pages.meeting_member.is_present') }}
                                                    </th>

                                                    <th width="10%">
                                                        {{ trans('message.commons.action') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($results as $key => $data)
                                                    <tr>
                                                        <th scope="row {{ setFont() }}">
                                                            {{ ($results->currentpage() - 1) * $results->perpage() + $key + 1 }}
                                                        </th>

                                                        <td>
                                                            @if (isset($data->meeting->code))
                                                                {{ $data->meeting->code }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if (isset($data->meeting->title))
                                                                {{ $data->meeting->title }}
                                                            @endif
                                                        </td>

                                                        <td class="{{ setFont() }}">
                                                            {{ getLan() == 'np' ? $data->name_np : $data->name_en }}
                                                        </td>

                                                        <td>
                                                            @if (isset($data->office))
                                                                {{ $data->office }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (isset($data->post))
                                                                {{ $data->post }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if (isset($data->contact_no))
                                                                {{ $data->contact_no }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (isset($data->email))
                                                                {{ $data->email }}
                                                            @endif
                                                        </td>

                                                        <td class="{{ setFont() }}">
                                                            @include('backend.meetingManagement.meetingMember.is_invite.is_invite')
                                                        </td>
                                                        
                                                        <td class="{{ setFont() }} row">
                                                            @include('backend.meetingManagement.meetingMember.is_invite.is_present')
                                                           
                                                        </td>
                                                        
                                                        
                                                        <td>
                                                            @if (allowShow())
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}"
                                                                    data-toggle="modal"
                                                                    data-target="#showModal{{ $key }}"
                                                                    data-placement="top"
                                                                    title="{{ trans('message.button.show') }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                            @endif
                                                            &nbsp;
                                                            @if (allowEdit() && $data->meeting->meeting_status_id == 1)
                                                                <button type="button"
                                                                    class="btn btn-info btn-xs rounded-pill {{ setFont() }}"
                                                                    data-toggle="modal"
                                                                    data-target="#editModal{{ $key }}"
                                                                    data-placement="top"
                                                                    title="{{ trans('message.button.edit') }}">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </button>
                                                            @endif

                                                            &nbsp;
                                                            @if (allowDelete() && $data->meeting->meeting_status_id == 1)
                                                                <button type="button"
                                                                    class="btn btn-danger btn-xs rounded-pill {{ setFont() }}"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteModal{{ $key }}"
                                                                    data-placement="top"
                                                                    title="{{ trans('message.button.delete') }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                    @include('backend.meetingManagement.meetingMember.is_invite.is_invite_modal')
                                                    @include('backend.modal.delete_modal')
                                                    @include('backend.meetingManagement.meetingMember.show')
                                                    @include('backend.meetingManagement.meetingMember.edit_modal')
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
                            </div>
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
        @include('backend.meetingManagement.meetingMember.add_modal')
        @include('backend.meetingManagement.meetingMember.searchModal')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.data-submit-modal')
    </div>

    <!-- /.content-wrapper -->

@endsection
