@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                            {{ $page_title }}   {{trans('message.pages.roles.details')}}
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
                            <tbody>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.Registration_no') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->regd_no))
                                       {{  $dcRegisterBook->regd_no}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.invoice_no') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->dispatch_no))
                                        {{  $dcRegisterBook->dispatch_no}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.letter_no') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->letter_no))
                                        {{  $dcRegisterBook->letter_no}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.Date_of_Registration_np') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->regd_date_bs))
                                        {{getLan() =='np' ? $dcRegisterBook->regd_date_bs :  $dcRegisterBook->regd_date_ad}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.letter_date_ad') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->letter_date_bs))
                                        {{getLan() =='np' ? $dcRegisterBook->letter_date_bs :  $dcRegisterBook->regd_date_ad}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.subject_of_the_letter') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->letter_sub))
                                        {{ $dcRegisterBook->letter_sub }}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.letter_receiving_depart') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcRegisterBook->office->name_np))
                                        {{ getLan() =='np' ? $dcRegisterBook->office->name_np :  $dcRegisterBook->office->name_en }}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.letter_receiving_person') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcRegisterBook->patraReceiver->first_name_np))
                                        {{ getLan() =='np' ? $dcRegisterBook->patraReceiver->first_name_np :  $dcRegisterBook->patraReceiver->first_name_en }}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.person_name') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcRegisterBook->contact_person))
                                        {{$dcRegisterBook->contact_person}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.address') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcRegisterBook->contact_address))
                                        {{$dcRegisterBook->contact_address}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.contact_no') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcRegisterBook->contact_no))
                                        {{$dcRegisterBook->contact_no}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.country') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcRegisterBook->country->name_en))
                                        {{ getLan() =='np' ? $dcRegisterBook->country->name_np : $dcRegisterBook->country->name_en}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.receipt_no') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcRegisterBook->reg_receipt))
                                        {{$dcRegisterBook->reg_receipt}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.receipt_rate') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcRegisterBook->reg_fee))
                                        {{$dcRegisterBook->reg_fee}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.comment') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcRegisterBook->notes))
                                        {{$dcRegisterBook->notes}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('suggestion.file') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcRegisterBook->letter_upload))
                                        <a href="{{URL::to('/storage/'.$filePath.'/'.$dcRegisterBook->letter_upload)}}"
                                           target="_blank"
                                           class="btn btn-secondary btn-xs rounded-pill"
                                           data-placement="top"
                                           title="{{trans('message.pages.common.viewFile')}}"
                                        >
                                            <i class="fa fa-file"></i>
                                        </a>
                                        &nbsp;
                                        <a href="{{URL::to('/storage/'.$filePath.'/'.$dcRegisterBook->letter_upload)}}"
                                           class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                                           download
                                           data-toggle="tooltip"
                                           title="Download File"
                                        >
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

                            <a href="{{url(@$index_page_url)}}"
                               class="btn btn-danger  rounded-pill {{setFont()}}"
                               title="{{trans('message.button.close')}}"
                            >
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
@endsection
