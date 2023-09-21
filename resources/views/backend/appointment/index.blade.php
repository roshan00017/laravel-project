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
                            {{ trans('appointment.page_title') }}
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
                                    {{ trans('appointment.page_title') }}
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
                                    $request->code != null ||
                                        $request->from_date != null ||
                                        $request->to_date != null ||
                                        $request->appointment_no != null ||
                                        $request->mobile_no != null ||
                                        $request->email != null ||
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
                                    <a href="{{ url('appointmentInfo') }}"
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
                                    <table id="example2"
                                           class="table table-bordered table-striped dataTable dtr-inline">
                                        <thead class="th-header">
                                        <tr class="{{ setFont() }}">
                                            <th width="10px">
                                                {{ trans('message.commons.s_n') }}
                                            </th>


                                            <th>
                                                {{ trans('appointment.appointment_no') }}
                                            </th>

                                            <th>
                                                {{ trans('appointment.appointment_date') }}
                                            </th>

                                            <th>
                                                {{ trans('appointment.full_name') }}
                                            </th>

                                            <th>
                                                {{ trans('appointment.email') }}
                                            </th>

                                            <th>
                                                {{ trans('appointment.mobile_no') }}
                                            </th>
                                            <th>
                                                {{trans('message.commons.status')}}
                                            </th>

                                            <th width="13%">
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
                                                <td class="{{ setFont() }}">
                                                    {{  $data->appointment_no  }}
                                                </td>

                                                <td class="{{ setFont() }}">
                                                    {{ getLan() =='np' ?  $data->appointment_date_bs : $data->appointment_date_ad }}
                                                    &nbsp;
                                                    <i class="fa fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse(@$data->time)->format('g:i A') }}
                                                </td>


                                                <td class="{{setFont()}}">
                                                    @if (isset($data->full_name))
                                                        {{ $data->full_name }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (isset($data->email))
                                                        {{ $data->email }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($data->mobile_no))
                                                        {{ $data->mobile_no }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->appointment_status == 1)
                                                        <button class="btn btn-xs btn-secondary rounded-pill {{setFont()}}"
                                                                data-toggle="modal"
                                                                data-target="#statusModal{{ $key }}"
                                                        >
                                                            @if(isset($data->appointmentStatus))
                                                            {{  getLan() =='np' ? $data->appointmentStatus->name_np : $data->appointmentStatus->name_en}}
                                                            @endif
                                                        </button>
                                                    @elseif($data->appointment_status == 2)
                                                        <button class="btn btn-xs btn-success rounded-pill {{setFont()}}">
                                                            @if(isset($data->appointmentStatus))
                                                                {{  getLan() =='np' ? $data->appointmentStatus->name_np : $data->appointmentStatus->name_en}}
                                                            @endif

                                                        </button>
                                                    @elseif($data->appointment_status == 3)
                                                        <button class="btn btn-xs btn-info rounded-pill {{setFont()}}">
                                                            @if(isset($data->appointmentStatus))
                                                                {{  getLan() =='np' ? $data->appointmentStatus->name_np : $data->appointmentStatus->name_en}}
                                                            @endif

                                                        </button>
                                                    @elseif($data->appointment_status == 4)
                                                        <button class="btn btn-xs btn-danger rounded-pill {{ setFont() }}">
                                                            @if (isset($data->appointmentStatus))
                                                                {{ getLan() == 'np' ? $data->appointmentStatus->name_np : $data->appointmentStatus->name_en }}
                                                            @endif

                                                        </button>
                                                    @elseif($data->appointment_status == 5)
                                                        <button class="btn btn-xs btn-primary rounded-pill {{ setFont() }}">
                                                        @if (isset($data->appointmentStatus))
                                                            {{ getLan() == 'np' ? $data->appointmentStatus->name_np : $data->appointmentStatus->name_en }}
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (allowShow())
                                                        <a href="{{ route($page_route . '.' . 'show', hashIdGenerate($data->id)) }}"
                                                           class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}"
                                                           title="{{ trans('message.button.show') }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
                                                    &nbsp;
                                                    @if (allowEdit() && $data->appointment_status == 1)
                                                        <a href="{{ route($page_route . '.' . 'edit', hashIdGenerate($data->id)) }}"
                                                           class="btn btn-info btn-xs rounded-pill {{ setFont() }}"
                                                           title="{{ trans('message.button.edit') }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    @endif
                                                    &nbsp;
                                                    @if (allowDelete() && $data->appointment_status == 1)
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
                                            @include('backend.modal.delete_modal')
                                            @include('backend.appointment.visitUpdateModal')
                                        @endforeach

                                        </tbody>
                                    </table>
                                    <span class="float-right" style="margin-top: 20px !important;">
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
                    </div>
                </div>
            </div>
        </section>
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.data-submit-modal')
        @include('backend.appointment.searchModal')
    </div>
@endsection
