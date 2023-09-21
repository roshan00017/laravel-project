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
                                    {{ trans('dispatch.dispatch_data.dispatch_no') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcDispatchBook->dispatch_no))
                                        {{  $dcDispatchBook->dispatch_no}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.letter_no') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcDispatchBook->letter_no))
                                        {{  $dcDispatchBook->letter_no}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.dispatch_date') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcDispatchBook->dispatch_date_bs))
                                        {{getLan() =='np' ? $dcDispatchBook->dispatch_date_bs :  $dcDispatchBook->dispatch_date_ad}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.letter_date') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcDispatchBook->letter_date_bs))
                                        {{getLan() =='np' ? $dcDispatchBook->letter_date_bs :  $dcDispatchBook->letter_date_ad}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.letter_sub') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcDispatchBook->letter_sub))
                                        {{ $dcDispatchBook->letter_sub }}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.from_branch_id') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcDispatchBook->branch->name_en))
                                        {{ getLan() =='np' ? $dcDispatchBook->branch->name_np :  $dcDispatchBook->branch->name_en }}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.person_name') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcDispatchBook->contact_person))
                                        {{$dcDispatchBook->contact_person}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dartaKitab.dc_register_book.address') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcDispatchBook->contact_address))
                                        {{$dcDispatchBook->contact_address}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.contact_person_no') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcDispatchBook->contact_no))
                                        {{$dcDispatchBook->contact_no}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.office_contact_no') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcDispatchBook->to_office_contact))
                                        {{$dcDispatchBook->to_office_contact}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.country_id') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcDispatchBook->country->name_en))
                                        {{ getLan() =='np' ? $dcDispatchBook->country->name_np : $dcDispatchBook->country->name_en}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.letter_status') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcDispatchBook->status->name_np))
                                    {{getLan() == 'np' ? $dcDispatchBook->status->name_np : $dcDispatchBook->status->name_en}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.file_type') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcDispatchBook->file->name_np))
                                    {{ getLan() =='np' ? $dcDispatchBook->file->name_np : $dcDispatchBook->file->name_en}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('dispatch.dispatch_data.comment') }}
                                </td>

                                <td width="80%">
                                    @if(isset($dcDispatchBook->notes))
                                        {{$dcDispatchBook->notes}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{setFont()}}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('suggestion.file') }}
                                </td>

                                <td width="80%">
                                    @if (isset($dcDispatchBook->letter_upload))
                                        <a href="{{URL::to('/storage/'.$filePath.'/'.$dcDispatchBook->letter_upload)}}"
                                           target="_blank"
                                           class="btn btn-secondary btn-xs rounded-pill"
                                           data-placement="top"
                                           title="{{trans('message.pages.common.viewFile')}}"
                                        >
                                            <i class="fa fa-file"></i>
                                        </a>
                                        &nbsp;
                                        <a href="{{URL::to('/storage/'.$filePath.'/'.$dcDispatchBook->letter_upload)}}"
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
