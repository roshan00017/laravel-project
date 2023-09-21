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

                            @if (
                            $request->code != null ||
                            $request->from_date != null ||
                            $request->to_date != null ||
                            $request->meeting_category_id != null ||
                            $request->meeting_status_id != null ||
                            $request->fy_id != null

                            )
                            <a href="{{ url(@$page_url) }}"
                                class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{ setFont() }}"
                                title="{{ trans('message.button.reload') }}">
                                <i class="fas  fa-undo"></i>
                                {{ trans('message.button.reload') }}
                            </a>
                            @endif

                            @if (allowAdd())
                            <a href="{{ url(@$page_url . '/create') }}"
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
                                        <th width="3%">
                                            {{ trans('message.commons.s_n') }}
                                        </th>
                                        {{--                                                @if (systemAdmin() == true)--}}
                                        {{--                                                    <th>--}}
                                        {{--                                                        {{ trans('common.local_body') }}--}}
                                        {{--                                                    </th>--}}
                                        {{--                                                @endif--}}
                                        <th>
                                            {{ trans('meeting.meeting.title') }}
                                        </th>
                                        <th>
                                            {{ trans('message.pages.common.code') }}
                                        </th>

                                        <th>
                                            {{ trans('meeting.meeting.meeting_category') }}
                                        </th>

                                        <th>
                                            {{ trans('meeting.meeting.proposed_date') }}
                                        </th>


                                        <th>
                                            {{ trans('meeting.meeting.meeting_date') }}
                                        </th>


                                        <th>
                                            {{ trans('meeting.meeting.agendaFinalized') }}
                                        </th>

                                        <th>
                                            {{ trans('meeting.meeting.meeting_status') }}
                                        </th>

                                        <th width="14%">
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
                                        {{--                                                    @if (systemAdmin() == true)--}}
                                        {{--                                                        <td class="{{ setFont() }}">--}}
                                        {{--                                                            @if (isset($data->client))--}}
                                        {{--                                                                {{ getLan() == 'np' ? $data->client->name_np : $data->client->name_en }}--}}
                                        {{--                                                            @else--}}
                                        {{--                                                                {{ trans('common.system_setting') }}--}}
                                        {{--                                                            @endif--}}
                                        {{--                                                        </td>--}}
                                        {{--                                                    @endif--}}

                                        <td class="{{setFont()}}">
                                            @if (isset($data->title))
                                            {{ $data->title }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($data->code))
                                            {{ $data->code }}
                                            @endif
                                        </td>
                                        <td class="{{ setFont() }}">
                                            @if (isset($data->category->name_en))
                                            {{ getLan() == 'np' ? $data->category->name_np : $data->category->name_en }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($data->proposed_date_bs))
                                            {{ getLan() == 'np' ? $data->proposed_date_bs : $data->proposed_date_ad }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($data->meeting_date_bs))
                                            {{ getLan() == 'np' ? $data->meeting_date_bs : $data->meeting_date_ad }}
                                            @endif
                                        </td>

                                        <td class="{{ setFont() }}">
                                            @include('backend.meetingManagement.meeting.meetingStatus.meetingAgendaStatus')
                                        </td>

                                        <td class="{{ setFont() }}">
                                            @include('backend.meetingManagement.meeting.meetingStatus.meetingStatus')
                                        </td>
                                        <td>

                                            @if (allowShow())
                                            <button type="button"
                                                class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}"
                                                data-toggle="modal" data-target="#showModal{{ $key }}"
                                                data-placement="top" title="{{ trans('message.button.show') }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @endif
                                            &nbsp
                                            <button type="button"
                                                class="btn btn-primary btn-xs rounded-pill {{ setFont() }}"
                                                data-toggle="modal" data-target="#meetingStatusLogModal{{ $key }}"
                                                data-placement="top" title="{{ trans('message.button.show') }}">
                                                <i class="fas fa-cogs"></i>
                                            </button>
                                            &nbsp;
                                            @if (allowEdit() && $data->agenda_finalized == 0 && $data->meeting_status_id
                                            == 1)
                                            <a href="{{ route($page_route . '.' . 'edit', hashIdGenerate($data->id)) }}"
                                                class="btn btn-info btn-xs rounded-pill {{ setFont() }}"
                                                title="{{ trans('message.button.edit') }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            &nbsp;
                                            @endif
                                            &nbsp;
                                            @if (allowDelete() && $data->agenda_finalized == 0 &&
                                            $data->meeting_status_id == 1)
                                            <button type="button"
                                                class="btn btn-danger btn-xs rounded-pill {{ setFont() }}"
                                                data-toggle="modal" data-target="#deleteModal{{ $key }}"
                                                data-placement="top" title="{{ trans('message.button.delete') }}">


                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endif
                                            @include('backend.meetingManagement.meeting.meetingStatusUpdateModal')

                                            @include('backend.meetingManagement.meeting.show')
                                            @include('backend.meetingManagement.meeting.meetingStatus.meetingAgendaFinalizedModal')
                                            @include('backend.modal.delete_modal')
                                            @include('backend.meetingManagement.meeting.meetingStatusLogModal')

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <span class="float-right" style="margin-top: 20px !important;">
                                {{ $results->appends(request()->except('page'))->links() }}
                            </span>
                        </div>
                        @else
                        <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                            <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{ trans('message.commons.no_record_found') }}
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
    @include('backend.meetingManagement.meeting.meetingSearchModal')
    @include('backend.modal.technical-error-modal')
    @include('backend.modal.check_data_modal')
    @include('backend.modal.data-submit-modal')

</div>

<!-- /.content-wrapper -->




@endsection