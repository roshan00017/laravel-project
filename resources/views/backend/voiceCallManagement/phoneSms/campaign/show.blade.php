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
                        @if($campaignDetails->campaign_status =='Not Started')
                            <button
                                    class="btn btn-secondary btn-sm float-right  rounded-pill {{ setFont() }}"
                                    data-toggle="modal" data-target="#runCampaign"
                                    title="{{ trans('voiceCallManagement.runCampaign') }}">
                                <i class="fa fa-random"></i>
                                {{ trans('voiceCallManagement.runCampaign') }}
                            </button>
                        @else
                            <button
                                    class="btn btn-success btn-sm float-right  rounded-pill {{ setFont() }}"
                                    data-toggle="modal" data-target="#runCampaign"
                                    title="{{ trans('voiceCallManagement.runCampaign') }}">
                                <i class="fas  fa-sync-alt"></i>
                                {{ trans('voiceCallManagement.reRunCampaign') }}
                            </button>
                        @endif
                        <input type="hidden" id="campaign_id" value="{{$campaignDetails->campaign_api_id}}">

                    </div>
                    <div class="card-body">
                        @php
                            $key = $campaignDetails->id;
                            $data = $campaignDetails;
                        @endphp
                        <div class="row">
                            <div class="col-md-4">

                                <button type="button"
                                        class="btn btn-secondary btn-xs float-left rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#editModal{{$key}}"
                                        data-placement="top"
                                        title="{{trans('message.button.edit')}}"
                                >
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <br>
                                <br>
                                <table class="table table-bordered">
                                    <tbody>

                                    <tr class="{{ setFont() }}">
                                        <td width="40%">
                                            {{ trans('voiceCallManagement.title') }}
                                        </td>

                                        <td>
                                            @if (isset($campaignDetails->campaign_name))
                                                {{ $campaignDetails->campaign_name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="{{ setFont() }}">
                                        <td width="40%">
                                            {{ trans('voiceCallManagement.service') }}
                                        </td>

                                        <td>
                                            @if (isset($campaignDetails->campaign_service))
                                                {{ tingTingService($campaignDetails->campaign_service) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="{{ setFont() }}">
                                        <td width="40%">
                                            {{ trans('message.pages.roles.details') }}
                                        </td>

                                        <td>
                                            @if (isset($campaignDetails->campaign_detail))
                                                {{ $campaignDetails->campaign_detail }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="{{ setFont() }}">
                                        <td width="40%">
                                            {{ trans('message.commons.status') }}
                                        </td>

                                        <td>
                                            @if (isset($campaignDetails->campaign_status))
                                                @if($campaignDetails->campaign_status =='Not Started')
                                                    <button class="btn btn-warning btn-xs rounded-pill">
                                                        {{ $campaignDetails->campaign_status }}

                                                    </button>
                                                @elseif($campaignDetails->campaign_status =='Completed')
                                                    <button class="btn btn-success btn-xs rounded-pill">
                                                        {{ $campaignDetails->campaign_status }}

                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary btn-xs rounded-pill">
                                                        {{ $campaignDetails->campaign_status }}

                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @if(isset($campaignDetails->createdBy))
                                        <tr class="{{ setFont() }}">
                                            <td width="40%">
                                                {{ trans('common.created_by') }}
                                            </td>

                                            <td>
                                                @php
                                                    $name = getLan() =='np'? 'full_name_np': 'full_name';
                                                @endphp
                                                    @php
                                                        if(userInfo()->id == $campaignDetails->created_by){
                                                           $user =  getLan() == 'np' ? 'तपाई' : 'You';
                                                        }else{
                                                            $user = $campaignDetails->createdBy->$name;
                                                        }
                                                    @endphp
                                                    {{ $user }}
                                                    <br>
                                                {{ getLan() == 'np' ? $campaignDetails->campaign_added_date_np : $campaignDetails->campaign_added_date_en }}
                                                {{ \Carbon\Carbon::parse($campaignDetails->created_at)->format('g:i A') }}
                                            </td>
                                        </tr>
                                    @endif

                                    @if(isset($campaignDetails->updatedBy))
                                        <tr class="{{ setFont() }}">
                                            <td width="40%">
                                                {{ trans('common.updated_by') }}
                                            </td>

                                            <td>
                                                @php
                                                    $name = getLan() =='np'? 'full_name_np': 'full_name';
                                                @endphp
                                                @php
                                                    if(userInfo()->id == $campaignDetails->updated_by){
                                                       $user =  getLan() == 'np' ? 'तपाई' : 'You';
                                                    }else{
                                                        $user = $campaignDetails->updatedBy->$name;
                                                    }
                                                @endphp
                                                {{ $user }}
                                                <br>
                                                {{ getLan() == 'np' ? $campaignDetails->campaign_added_date_np : $campaignDetails->campaign_added_date_en }}
                                                {{ \Carbon\Carbon::parse($campaignDetails->updated_at)->format('g:i A') }}
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                @include('backend.voiceCallManagement.phoneSms.campaign.edit')

                            </div>
                            <div class="col-md-8">
                                <button
                                        class="btn btn-primary btn-sm float-left  rounded-pill {{ setFont() }}"
                                        data-toggle="modal" data-target="#addMobile"
                                        title="{{ trans('voiceCallManagement.addMobileNo') }}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{ trans('voiceCallManagement.addMobileNo') }}
                                </button>
                                <button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}"
                                        data-toggle="modal"
                                        data-target="#searchModal"
                                        title="{{ trans('message.button.filter') }}">
                                    <i class="fas fa-filter"></i>
                                    {{ trans('message.button.filter') }}
                                </button>

                                @if( $request->number !=null

                                )

                                    <a href="{{url($page_url.'/'.hashIdGenerate($campaignDetails->id))}}"
                                       class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}"
                                       title="{{ trans('message.button.reload') }}"
                                    >
                                        <i class="fas  fa-undo"></i>
                                        {{ trans('message.button.reload') }}
                                    </a>

                                @endif
                                <br>
                                <br>
                                @include('backend.voiceCallManagement.phoneSms.number.index')
                            </div>

                        </div>
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
    @include('backend.voiceCallManagement.phoneSms.campaign.runCampaign')
    @include('backend.voiceCallManagement.phoneSms.campaign.reRunCampaign')
    @include('backend.voiceCallManagement.phoneSms.number.addMobileNo')
    @include('backend.voiceCallManagement.phoneSms.number.searchModal')
    @include('backend.modal.data-submit-modal')
@endsection
