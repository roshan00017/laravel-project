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
                            {{ trans('employee.page_title') }}
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
                                    {{ trans('employee.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{ trans('meeting.meeting.list') }}
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
                                @include('backend.components.buttons.list')

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
                                                        {{ trans('employee.na_pa_ga_pa') }}
                                                    </th>

                                                    {{-- <th width="10px">
                                                        {{ trans('employee.photo') }}
                                                    </th> --}}

                                                    <th width="10px">
                                                        {{ trans('employee.full_name') }}
                                                    </th>

                                                    <th width="10px">
                                                        {{ trans('employee.email') }}
                                                    </th>

                                                    <th width="10px">
                                                        {{ trans('employee.phone') }}
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

                                                        <td class="{{ setFont() }}">
                                                            @if (isset($data->client))
                                                                {{ getLan() =='np' ? $data->client->name_np : $data->client->name_en}}
                                                            @endif
                                                        </td>

                                                        <td class="{{ setFont() }}">
                                                            <?php
                                                            $fullName_np = $data->first_name_np;
                                                            if (!empty($data->middle_name_np)) {
                                                                $fullName_np .= ' ' . $data->middle_name_np;
                                                            }
                                                            $fullName_np .= ' ' . $data->last_name_np;
                                                            
                                                            $fullName_en = $data->first_name_en;
                                                            if (!empty($data->middle_name_en)) {
                                                                $fullName_en .= ' ' . $data->middle_name_en;
                                                            }
                                                            $fullName_en .= ' ' . $data->last_name_en;
                                                            ?>
                                                            {{ getLan() == 'np' ? $fullName_np : $fullName_en }}
                                                        </td>


                                                        <td>
                                                            @if (isset($data->email))
                                                                {{ $data->email }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if (isset($data->phone_number))
                                                                {{ $data->phone_number }}
                                                            @endif
                                                        </td>


                                                        <td>
                                                            @include('backend.components.buttons.action')

                                                        </td>
                                                    </tr>
                                                    @include('backend.edmis.employee.show_modal')
                                                    @include('backend.edmis.employee.edit_modal')
                                                    @include('backend.modal.delete_modal')
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
        @include('backend.edmis.employee.add_modal')
        @include('backend.edmis.employee.searchModal')
        @include('backend.modal.technical-error-modal')
        @include('backend.modal.data-submit-modal')
    </div>

    <!-- /.content-wrapper -->
@endsection
