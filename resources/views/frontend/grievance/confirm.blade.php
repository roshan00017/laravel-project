@extends('frontend.layouts.welcome')
<?php $complaintHelper = new \App\Helpers\ComplaintHelper(); ?>
<style>
    .radio-button {
        display: inline-block;
        vertical-align: middle;
        margin-top: 0;
        padding: 0;
        width: 25px;
        height: 25px;
        background: rgb(255, 255, 255);
        border: none;
        cursor: pointer;
    }
</style>
@section('content')
    <section class="breadcrumbs">
        <div class="custom-container">
            <nav class="breadcrumbs__nav">
                <ul class="breadcrumbs__nav-menu">
                    <li>
                        <a href="{{url('/')}}" class="breadcrumb__link {{ setFont() }}">
                            <i class="fa-solid fa-home"></i>
                            {{ trans('frontendSuggestion.suggestion.home_page') }}
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0)" class="breadcrumb__link {{ setFont() }}">
                            {{$page_title}}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <div class="form__section">
        <div class="custom-container">
            <div class="form__section-content">
                <h2 class="section__title {{ setFont() }}">
                    {{trans('frontendSuggestion.complaintinfo.grev_form')}}
                </h2>

                @include('frontend.grievance.complaintHeader')
                {!! Form::open(['route' => 'postComplaintConfirm','method'=>'POST','class'=>'addFrom']) !!}
                <div class="input__grid">

                    <div>
                        <h5 class="{{setFont()}}">
                            <i class="fa fa-info"></i>
                            {{ trans('frontendSuggestion.confirm.grev_detail') }}
                        </h5>
                        <br>
                        <table class="table  table-bordered">
                            <tbody>

                            <tr>
                                <td class="{{setFont()}}">
                                    {{ trans('frontendSuggestion.confirm.grev_type') }}
                                </td>

                                <td width="60%">
                                    <strong class="{{setFont()}}">
                                        {{ $complaintHelper->compalintCategorty(@$complaint->form_category_id) }}

                                    </strong>
                                </td>
                            </tr>

                            <tr>
                                <td class="{{setFont()}}">
                                    {{ trans('frontendSuggestion.confirm.related_branch') }}
                                </td>

                                <td width="60%">
                                    <strong class="{{setFont()}}">
                                        {{ $complaintHelper->getOffice(@$complaint->office_id) }}

                                    </strong>
                                </td>
                            </tr>

                            <tr>
                                <td class="{{setFont()}}">
                                    {{ trans('frontendSuggestion.confirm.grev_depth') }}
                                </td>

                                <td width="60%">
                                    <strong class="{{setFont()}}">
                                        {{ $complaintHelper->getSeverityType(@$complaint->severity_type_id) }}

                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="{{setFont()}}">
                                    {{ trans('frontendSuggestion.confirm.document') }}
                                </td>

                                <td width="60%">
                                    <a class="text text-primary" href="{{ url('/') }}/storage/uploads/documents/complaints/{{ @$complaint->file_name }}"
                                       target="_blank"   title="{{trans('message.pages.common.viewFile')}}"> <i class="fa fa-file"> </i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="{{setFont()}}">
                                    {{ trans('frontendSuggestion.confirm.details') }}
                                </td>

                                <td width="60%">
                                    <strong class="{{setFont()}}">
                                        {{ @$complaint->description }}

                                    </strong>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>


                    <div>
                        <h5 class="{{setFont()}}">
                            <i class="fa fa-user"></i>
                            {{ trans('appointment.personal_details') }}
                        </h5>
                        <br>
                        <table class="table  table-bordered">
                            <tbody>

                            @if (@$complaint->name_ne)
                                <tr>
                                    <td class="{{setFont()}}">
                                        {{ trans('appointment.full_name') }}
                                    </td>

                                    <td width="60%" class="{{setFont()}}">
                                        {{ @$complaint->name_ne }}
                                    </td>
                                </tr>
                            @endif
                            @if (@$complaint->tole)
                                <tr>
                                    <td class="{{setFont()}}">
                                        {{ trans('appointment.address') }}
                                    </td>

                                    <td width="60%" class="{{setFont()}}">
                                        {{ $complaint->tole }}
                                    </td>
                                </tr>
                            @endif
                            @if (@$complaint->email)
                                <tr>
                                    <td class="{{setFont()}}">
                                        {{ trans('appointment.email') }}
                                    </td>

                                    <td width="60%" class="{{setFont()}}">
                                        {{ $complaint->email }}
                                    </td>
                                </tr>
                            @endif
                            @if (@$complaint->mobile_no)
                                <tr>
                                    <td class="{{setFont()}}">
                                        {{ trans('appointment.mobile_no') }}
                                    </td>

                                    <td width="60%" class="{{setFont()}}">
                                        {{ $complaint->mobile_no }}
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td colspan="2">
                                    <strong>
                                        <u class="{{setFont()}}">
                                            {{ trans('frontendSuggestion.confirm.points') }}
                                        </u>
                                    </strong>

                                    <p class="{{setFont()}}">
                                        {{ trans('frontendSuggestion.confirm.rule_i') }}<br>
                                        {{ trans('frontendSuggestion.confirm.rule_ii') }}
                                    </p>

                                    <div class="form-group {{setFont()}}">
                                        <input type="checkbox" class="radio-button" name="accept_terms"
                                               required>
                                        {{ trans('frontendSuggestion.confirm.accept') }}
                                        <div class="{{setFont()}}">
                                            {{ trans('frontendSuggestion.confirm.choose') }}
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>


                    <div class="button__group span2">
                        <a href="{{route('complaint-complainer')}}"
                           class="submit__btn form-prev">
                                        <span class="{{setFont()}}">
                                            <i class="fa-solid fa-chevron-left"></i>
                                          {{trans('appointment.previous')}}
                                        </span>
                        </a>

                        <button type="submit"
                                class="submit__btn form-next {{setFont()}}">
                                        <span class="{{setFont()}}">
                                             {{ trans('frontendSuggestion.suggestion.sent_file') }}
                                        <i class="fa-solid fa-paper-plane"></i>
                                        </span>
                        </button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
    @include('frontend.component.submitModal')
@endsection
