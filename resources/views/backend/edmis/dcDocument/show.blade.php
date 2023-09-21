@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 {{ setFont() }}">
                        {{ $page_title }} {{trans('message.pages.roles.details')}}
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
                            <a href="{{ url($page_url) }}">
                                {{ $page_title }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            {{trans('message.pages.roles.details')}}
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

        <!-- /.row -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @include('backend.components.buttons.returnBack')
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3 {{setFont()}}">
                            <lable>{{ trans('dcDocument.dc_document.document') }}:</lable>
                            <a data-toggle="modal" data-target="#addFileModal" class="btn btn-success btn-sm rounded-pill {{setFont()}}" title="{{trans('dcDocument.dc_document.add_file')}}">
                                <i class="fa fa-plus-circle"></i>
                                {{trans('dcDocument.dc_document.add_file')}}
                            </a>
                        </div>
                        <div class="form-group col-md-6 {{setFont()}}">
                            <lable>{{ trans('dcDocument.dc_document.branch_transfer') }}:</lable>
                            <a data-toggle="modal" data-target="#branchModal" class="btn btn-info btn-sm rounded-pill {{setFont()}}" title="{{trans('dcDocument.dc_document.branch_transfer')}}">
                                <i class="fas fa-exchange-alt"></i>
                                {{trans('dcDocument.dc_document.branch_transfer')}}
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3 {{setFont()}}">
                            <lable>{{ trans('dartaKitab.dc_register_book.Registration_no') }}</lable>
                            <input type="text" name="regd_no" required class="form-control" value="{{  $dcRegisterBook->regd_no}}" readonly>
                        </div>
                        <div class="form-group col-md-3 {{setFont()}}">
                            <lable>
                                {{getLan() =='np' ? trans('dartaKitab.dc_register_book.Date_of_Registration_np'): trans('dartaKitab.dc_register_book.Date_of_Registration_en')}}
                            </lable>
                            <input type="text" name="regd_no" required class="form-control" value="{{getLan() =='np' ? $dcRegisterBook->regd_date_bs :  $dcRegisterBook->regd_date_ad}}" readonly>
                        </div>
                        <div class="form-group col-md-3 {{setFont()}}">
                            <lable>{{ trans('dartaKitab.dc_register_book.subject_of_the_letter') }}</lable>
                            <input type="text" name="regd_no" required class="form-control" value="  {{ $dcRegisterBook->letter_sub }}" readonly>
                        </div>
                    </div>
                </div>
                @if(sizeof($results)>0)
                <div class="card-body">
                    <table id="" class="table table-bordered table-striped dataTable dtr-inline">
                        <thead class="th-header {{setFont()}}">
                            <tr class="{{setFont()}}">
                                <th>
                                    {{ trans('dartaKitab.dc_register_book.letter_receiving_depart') }}
                                </th>
                                <th>
                                    {{trans('dcDocument.dc_document.fiscal_year')}}
                                </th>
                                <th>
                                    {{ trans('dartaKitab.dc_register_book.letter_receiving_person') }}
                                </th>
                                <th>
                                    {{ trans('dartaKitab.dc_register_book.letter_status') }}
                                </th>

                                <th width="8%">
                                    {{ trans('suggestion.file') }}
                                </th>
                                <th>
                                    {{trans('dcDocument.dc_document.duration')}}
                                </th>
                                <th style="width: 100px;">
                                    {{ trans('message.commons.action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $key=>$data)
                            <tr class="{{setFont()}}">
                                <td>
                                    @if( $data->to_section_id == null)
                                    {{ getLan() =='np' ? $dcRegisterBook->office->name_np :  $dcRegisterBook->office->name_en }}
                                    @else
                                    @if(isset($data->to_section_id))
                                    {{ getLan() =='np' ? $data->toSection->name_np :  $data->toSection->name_en }}
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if(isset($data->fiscal_year_id))
                                    {{ $data->fiscalyear->code }}
                                    @endif
                                </td>

                                <td>
                                    @if(isset($data->employee_id)!= null)
                                    {{ getLan() =='np' ? $data->employee->first_name_np :  $data->employee->first_name_en }}
                                    @else
                                    {{ getLan() =='np' ? $dcRegisterBook->patraReceiver->first_name_np :  $dcRegisterBook->patraReceiver->first_name_en }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($data->document_type_id) != null)
                                    {{getLan() == 'np'? $data->letterStatus->name_np: $data->letterStatus->name_en}}
                                    @else
                                    {{getLan() == 'np'? $dcRegisterBook->letterStatus->name_np: $dcRegisterBook->letterStatus->name_en}}
                                    @endif
                                </td>
                                <td>
                                    @if (isset($data->filepath))
                                    <a href="{{URL::to('/storage/'.$filePath.'/'.$data->filepath)}}" target="_blank" class="btn btn-secondary btn-xs rounded-pill" data-placement="top" title="{{trans('message.pages.common.viewFile')}}">
                                        <i class="fa fa-file"></i>
                                    </a>
                                    &nbsp;
                                    <a href="{{URL::to('/storage/'.$filePath.'/'.$data->filepath)}}" class="btn btn-danger btn-xs rounded-pill {{setFont()}}" download data-toggle="tooltip" title="Download File">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td></td>
                                <td>
                                    @if(allowShow())

                                    <a href="{{url('dcDocuments/'. hashIdGenerate( $data->id))}}" class="btn btn-primary btn-xs rounded-pill {{setFont()}}" title="{{trans('message.button.show')}}">
                                        <i class="fas fa-eye"></i>

                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                @endif
            </div>
        </div>

    </section>
    <!-- /.container-fluid -->
    <!-- /.content -->
</div>
@include('backend.edmis.dcDocument.addFile')
@include('backend.edmis.dcDocument.branch')
@include('backend.modal.technical-error-modal')
@include('backend.modal.data-submit-modal')

@endsection