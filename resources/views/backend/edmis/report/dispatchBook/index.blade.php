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
                          
                            {{ trans('dispatchreport.dc_dispatch_book.page_title') }} 
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
                                <a href="{{url($page_url)}}">
                                {{ trans('dispatchreport.dc_dispatch_book.page_title') }}
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
                         @if(sizeof($results) > 0)
                         <button style = "margin-right:10px;" class="btn btn-success  btn-sm float-right rounded-pill boxButton {{setFont()}}" onclick="exportdispatchTableToExcel('tblData')"><i class='fa fa-print'></i> XLS</button>
                         <button style = "margin-right:10px;" class="btn btn-danger  btn-sm float-right rounded-pill boxButton {{setFont()}}" data-toggle="modal" data-target=" #dispatchModal "><i class='fa fa-print'></i> PDF</button>
                         @endif
                         <button style = "margin-right:10px;" class="btn btn-info btn-sm float-right rounded-pill boxButton {{setFont()}}"
                                 data-toggle="modal"
                                 data-target="#searchModal"
                                 title="{{ trans('message.button.filter') }}">
                             <i class="fas fa-filter"></i>
                             {{ trans('message.button.filter') }}
</button>
                         <!-- @if(sizeof($results) > 0)
                         <button  class="btn btn-success  btn-sm float-right rounded-pill boxButton" onclick="exportdispatchTableToExcel('tblData')"><i class='fa fa-print'></i> XLS</button>
                         <button style = "margin-right:10px;" class="btn btn-danger  btn-sm float-right rounded-pill boxButton" data-toggle="modal" data-target=" #dispatchModal "><i class='fa fa-print'></i> PDF</button>
                         @endif
                          -->
                         
                         @if( $request->fy_code !=null || $request->from_date !=null || $request->to_date !=null ||
                         $request->ward !=null  || $request->employee_id !=null || $request->department_id !=null
                          || $request->user_id != null
                         )
                         
                             <a href="{{url(@$page_url)}}"
                                class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}"
                                title="{{ trans('message.button.reload') }}"
                             >
                                 <i class="fas  fa-undo"></i>
                                 {{ trans('message.button.reload') }}
                             </a>
                         
                         @endif


                            </div>
                        </div>
                       
                  
                            <div class="card">
                                
                                @if(sizeof($results) > 0)
                                <div class="card-body">
                                    <div id="tblData">
                                    <table id=""
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
                                                {{ getLan() == 'np'?  trans('dispatch.dispatch_data.dispatch_date_bs') : trans('dispatch.dispatch_data.dispatch_date_ad')  }}
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
                                                    {{getLan() == 'np'? $data->dispatch_date_bs : $data->dispatch_date_ad  }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if(isset($data->letter_sub))
                                                        {{ $data->letter_sub }}
                                                    @endif
                                                </td>
                                                <td class="{{setFont()}}">
                                                    @if(isset($data->office->name_en))
                                                    {{getLan() == 'np'? $data->office->name_np : $data->office->name_en}}
                                                    @endif
                                                </td>
                                                

                                                <td>
                                                    @if(isset($data->branch->name_np))
                                                        {{getLan() == 'np'? $data->branch->name_np : $data->branch->name_en}}
                                                    @endif
                                                </td>
                                                
                                                

                                                <td>
                                                    @if(isset($data->contact_person))
                                                        {{ $data->contact_person }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if(isset($data->status->name_np))
                                                        {{getLan() == 'np' ? $data->status->name_np : $data->status->name_en}}
                                                    @endif
                                                </td>

                                                    
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                   
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

                     
                </div>
            </div>
</div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    @include('backend.modal.technical-error-modal')
    @include('backend.edmis.report.dispatchBook.searchModal')
    @include('backend.edmis.report.dispatchBook.dispatchModal')
@endsection









































































































































































































































