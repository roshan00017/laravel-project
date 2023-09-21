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
                    <table class="table table-bordered table-striped">
                        <tbody class="{{setFont()}}">

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dcDocument.dc_document.registration_number') }}
                                </td>

                                <td width="80%">
                                    @if (isset($result->document_no))
                                    {{ $result->document_no}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dcDocument.dc_document.Date_of_Registration_np') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->regd_date_bs))
                                    {{getLan() =='np' ? $dcRegisterBook->regd_date_bs :  $dcRegisterBook->regd_date_ad}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dcDocument.dc_document.letter_date_ad') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->letter_date_bs))
                                    {{getLan() =='np' ? $dcRegisterBook->letter_date_bs :  $dcRegisterBook->regd_date_ad}}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dcDocument.dc_document.letter_status') }}
                                </td>

                                <td width="80%">
                                    @if($result->document_type_id != null)
                                    @if (isset($result->document_type_id))
                                    {{getLan() =='np' ? $result->letterStatus->name_np :  $result->letterStatus->name_en}}
                                    @endif
                                    @else
                                    {{getLan() =='np' ? $dcRegisterBook->letterStatus->name_np :  $dcRegisterBook->letterStatus->name_en}}
                                    @endif

                                </td>
                            </tr>
                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dcDocument.dc_document.subject_of_the_letter') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->letter_sub))
                                    {{ $dcRegisterBook->letter_sub }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dcDocument.dc_document.letter_receiving_depart') }}
                                </td>
                                <td width="80%">

                                    @if(isset($result->to_section_id) != null)
                                    {{ getLan() =='np' ? $result->toSection->name_np :  $result->toSection->name_en }}
                                    @else
                                    {{ getLan() =='np' ? $dcRegisterBook->office->name_np :  $dcRegisterBook->office->name_en }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dcDocument.dc_document.letter_receiving_person') }}
                                </td>

                                <td width="80%">
                                    @if(isset($result->employee_id)!=null)
                                    {{ getLan() =='np' ? $result->employee->first_name_np :  $result->employee->first_name_en }}
                                    @else
                                    {{ getLan() =='np' ? $dcRegisterBook->patraReceiver->first_name_np :  $dcRegisterBook->patraReceiver->first_name_en }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dcDocument.dc_document.fiscal_year') }}
                                </td>
                                <td width="80%">
                                    {{$dcRegisterBook->fiscalYear->code}}
                                </td>
                            </tr>
                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dcDocument.dc_document.comment') }}
                                </td>
                                <td width="80%">
                                    @if(isset($result->remarks) != null)
                                    {{$result->remarks}}
                                    @else
                                    {{$dcRegisterBook->notes}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('suggestion.file') }}
                                </td>
                                <td width="80%">
                                    @if (isset($result->filepath) != null)
                                    <a href="{{URL::to('/storage/'.$filePath.'/'.$result->filepath)}}" target="_blank" class="btn btn-secondary btn-xs rounded-pill" data-placement="top" title="{{trans('message.pages.common.viewFile')}}">
                                        <i class="fa fa-file"></i>
                                    </a>
                                    &nbsp;
                                    <a href="{{URL::to('/storage/'.$filePath.'/'.$result->filepath)}}" class="btn btn-danger btn-xs rounded-pill {{setFont()}}" download data-toggle="tooltip" title="Download File">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @elseif(isset($dcRegisterBook->letter_upload))
                                    <a href="{{URL::to('/storage/'.$filePath.'/'.$dcRegisterBook->letter_upload)}}" target="_blank" class="btn btn-secondary btn-xs rounded-pill" data-placement="top" title="{{trans('message.pages.common.viewFile')}}">
                                        <i class="fa fa-file"></i>
                                    </a>
                                    &nbsp;
                                    <a href="{{URL::to('/storage/'.$filePath.'/'.$dcRegisterBook->letter_upload)}}" class="btn btn-danger btn-xs rounded-pill {{setFont()}}" download data-toggle="tooltip" title="Download File">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @else
                                    N/A
                                    @endif
                                </td>
                            </tr>


                        </tbody>
                    </table>
                    <div class="modal-footer justify-content-center {{setFont()}}">

                        <a href="{{url(@$index_page_url)}}" class="btn btn-danger  rounded-pill {{setFont()}}" title="{{trans('message.button.close')}}">
                            <i class="fa fa-times-circle"></i>
                            {{trans('message.button.close')}}
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.container-fluid -->
    <!-- /.content -->
</div>
@include('backend.modal.technical-error-modal')
@endsection