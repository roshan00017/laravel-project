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
                            {{ trans('meeting.meeting_link_list.page_title') }}
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
                                    {{ trans('meeting.meeting_link_list.page_title') }}
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

                                @if ($request->code != null || $request->title !=null || $request->from_date !=null || $request->to_date !=null || $request->fy_id !=null)
                                    <a href="{{ url(@$page_url) }}"
                                       class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{ setFont() }}"
                                       title="{{ trans('message.button.reload') }}">
                                        <i class="fas  fa-undo"></i>
                                        {{ trans('message.button.reload') }}
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
                                                <th width="13%">
                                                    {{ trans('message.pages.meeting_member.meeting_code') }}
                                                </th>
                                                <th width="20%">
                                                    {{ trans('meeting.meeting.title') }}
                                                </th>
                                                <th width="15%">
                                                    {{trans('meeting.meeting.meeting_date')}}
                                                </th>

                                                <th width="40%">
                                                    {{ trans('meeting.meeting_link_list.meeting_link') }}
                                                </th>


                                                <th width="15%">
                                                    {{ trans('meeting.meeting_link_list.total_member') }}
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
                                                        @if (isset($data->code))
                                                            {{ $data->code }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($data->title))
                                                            {{$data->title}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($data->proposed_date_bs))
                                                            {{ getLan() == 'np' ? $data->proposed_date_bs : $data->proposed_date_ad }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if (isset($data->meeting_url))
                                                            {{ $data->meeting_url }}
                                                        @endif
                                                        &nbsp;
                                                        @if($data->meeting_status !=5)
                                                            <a href="{{$data->meeting_url}}" target="_blank"
                                                               class="btn btn-xs btn-secondary rounded-pill"
                                                               style="margin-top: 10px">Join Now</a>
                                                            @if($data->meeting_password !=null)
                                                                <br>
                                                                <label class="{{setFont()}}" > {{ trans('meeting.meeting.password') }} : </label>
                                                                    {{ $data->meeting_password }}
{{--                                                                <input class="form-control" type="password" value="{{ $data->meeting_password }}">--}}

                                                                @endif
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @php
                                                            $memberCount = $meetingRepo->getCountMemberByMeeting($data->id)
                                                        @endphp
                                                        {{ $memberCount }}
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


                                                    </td>
                                                </tr>
                                                @include('backend.meetingManagement.meetingLinkList.show')
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
        @include('backend.meetingManagement.meetingLinkList.searchModal')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.data-submit-modal')
    </div>

    <!-- /.content-wrapper -->

@endsection