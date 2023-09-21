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
                            {{ $page_title}}
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
                                <a href="{{url('dcDispatchBook')}}">
                                    {{ $page_title}}
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
                            <div class="card-header"
                                 style="text-align:center"
                            >

                                <a href="{{url($page_url)}}"
                                   class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
                                   data-toggle="tooltip"
                                   title="{{trans('message.button.list')}}"
                                >
                                    <i class="fa fa-list"></i>
                                    {{trans('message.button.list')}}
                                </a>

                                <button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#searchModal"
                                        title="{{ trans('message.button.filter') }}">
                                    <i class="fas fa-filter"></i>
                                    {{ trans('message.button.filter') }}
                                </button>

                                @if( $request->from_date !=null || $request->to_date !=null || $request->letter_no !=null || $request->dispatch_no !=null
                                    || $request->letter_status !=null|| $request->fiscal_year_id !=null 

                                )

                                    <a href="{{url(@$page_url)}}"
                                       class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}"
                                       title="{{ trans('message.button.reload') }}"
                                    >
                                        <i class="fas  fa-undo"></i>
                                        {{ trans('message.button.reload') }}
                                    </a>

                                @endif

                                @if(allowAdd())

                                    <a href="{{url(@$page_url .'/create')}}"
                                       class="btn btn-primary btn-sm float-left boxButton boxButton rounded-pill {{setFont()}}"
                                       title="{{trans('message.button.add_new')}}"
                                    >
                                        <i class="fa fa-plus-circle"></i>
                                        {{trans('message.button.add_new')}}
                                    </a>
                                @endif

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
                                            <th width="3%">
                                                {{ trans('message.commons.s_n') }}
                                            </th>

                                            <th width="5%">
                                                {{ trans('dispatch.dispatch_data.letter_no') }}
                                            </th>

                                            <th>
                                                {{ trans('dispatch.dispatch_data.dispatch_no') }}
                                            </th>

                                            <th>
                                                {{ trans('dispatch.dispatch_data.dispatch_date_bs') }}
                                            </th>

                                            <th>
                                                {{ trans('dispatch.dispatch_data.letter_sub') }}
                                            </th>
                                            <th>
                                                {{ trans('dispatch.dispatch_data.to_office_name') }}
                                            </th>


                                            <th>
                                                {{ trans('dispatch.dispatch_data.from_branch_id') }}
                                            </th>

                                            <th>
                                                {{ trans('dispatch.dispatch_data.person_name') }}
                                            </th>

                                            <th>
                                                {{ trans('dispatch.dispatch_data.letter_status') }}
                                            </th>

                                            <th width="14%">
                                                {{trans('message.commons.action')}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th scope="row {{setFont()}}">
                                                    {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                                </th>
                                                <td class="{{setFont()}}">
                                                    @if(isset($data->letter_no))
                                                        {{ $data->letter_no }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if(isset($data->dispatch_no))
                                                        {{ $data->dispatch_no }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if(isset($data->dispatch_date_bs))
                                                        {{getLan() == 'np'? $data->dispatch_date_bs : $data->dispatch_date_ad}}
                                                    @endif
                                                </td>

                                                <td class="{{setFont()}}">
                                                    @if(isset($data->letter_sub))
                                                        {{ $data->letter_sub }}
                                                    @endif
                                                </td>
                                                <td class="{{setFont()}}">
                                                    @if(isset($data->office->name_en))
                                                        {{getLan() == 'np'? $data->office->name_np : $data->office->name_en}}
                                                    @endif
                                                </td>

                                                <td class="{{setFont()}}">
                                                    @if(isset($data->branch->name_np))
                                                        {{getLan() == 'np'? $data->branch->name_np : $data->branch->name_en}}
                                                    @endif
                                                </td>


                                                <td class="{{setFont()}}">
                                                    @if(isset($data->contact_person))
                                                        {{ $data->contact_person }}
                                                    @endif
                                                </td>

                                                <td class="{{setFont()}}">
                                                    @if(isset($data->status->name_np))
                                                        {{getLan() == 'np' ? $data->status->name_np : $data->status->name_en}}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if(allowShow())
                                                        <a href="{{route($page_route.'.'.'show', hashIdGenerate( $data->id))}}"
                                                           class="btn btn-secondary btn-xs rounded-pill {{setFont()}}"
                                                           title="{{trans('message.button.show')}}">
                                                            <i class="fas fa-eye"></i>

                                                        </a>
                                                    @endif

                                                    @if(allowShow())
                                                        <a href="{{url('dcDispacthBookStatusLogDetails/'. hashIdGenerate( $data->id))}}"
                                                           class="btn btn-primary btn-xs rounded-pill {{setFont()}}"
                                                           title="{{trans('message.button.show')}}"
                                                        >
                                                            <i class="fas fa-cogs"></i>

                                                        </a>
                                                    @endif
                                                    &nbsp;

                                                    @if(allowEdit())
                                                        <a href="{{route($page_route.'.'.'edit',hashIdGenerate( $data->id))}}"
                                                           class="btn btn-info btn-xs rounded-pill {{setFont()}}"
                                                           title="{{trans('message.button.edit')}}"
                                                        >
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    @endif

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
                                                    @include('backend.modal.delete_modal')

                                                </td>

                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div style="padding-top: 20px">
                                            <span class="fa-pull-left">
                                                Showing {{($results->currentpage()-1)*$results->perpage()+1}} to {{$results->currentpage()*$results->perpage()}}
                                                 of  {{$results->total()}} entries
                                            </span>
                                        <span class="float-right">
                                            {{ $results->appends(request()->except('page'))->links() }}
                                        </span>
                                    </div>
                                </div>
                                <!-- /.card-body -->

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
                            @endif
                        </div>
                        <!-- /.card -->


                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>


    @include('backend.modal.technical-error-modal')
    @include('backend.edmis.dcDispatchBook.searchModal')
@endsection
