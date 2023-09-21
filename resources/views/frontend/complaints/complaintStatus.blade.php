@extends('frontend.layouts.welcome')
<?php $createdAt = strtotime($complaint->created_at);
?>
@section('content')
<style>
    @media print {
        /* Hide header */
        header {
            display: none;
        }

        /* Hide footer */
        footer {
            display: none;
        }

        /* Hide breadcrumbs */
        .breadcrumbs {
            display: none;
        }

        /* Hide print button */
        .print-button {
            display: none;
        }
    }
</style>
    <section class="breadcrumbs">
        <div class="custom-container">
            <nav class="breadcrumbs__nav">
                <ul class="breadcrumbs__nav-menu">
                    <li>
                        <a href="{{url('/')}}"
                           class="breadcrumb__link {{setFont()}}">
                            <i class="fa-solid fa-home"></i>
                            {{ trans('frontendSuggestion.suggestion.home_page') }}
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0)"
                           class="breadcrumb__link {{setFont()}}">
                            {{trans('complaintstatus.title')}}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <div class="form__section">
        <div class="custom-container">
            <div class="form__section-content">
                <h4 class="section__title {{setFont()}}">
                    {{ trans('complaintstatus.title') }}
                </h4>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table  table-bordered">
                                <tbody>

                                <tr>
                                    <td width="28%" class="{{setFont()}}">
                                        {{ trans('complaints.ticket_no') }}
                                    </td>

                                    <td class="{{setFont()}}">
                                        {{  @$complaint->complaint_no }}
                                    </td>
                                </tr>

                                <tr>
                                    <td width="28%" class="{{setFont()}}">
                                        {{ trans('complaintstatus.unsign') }}
                                    </td>

                                    <td class="{{setFont()}}">
                                        {{ getLan() == 'np' ? @$complaint->office->name_ne : @$complaint->office->name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td width="28%" class="{{setFont()}}">
                                        {{ trans('complaintstatus.date') }}
                                    </td>
                                    <td class="{{ setfont() }}">
                                        <span class="">
                                            {{ getLan() == 'np' ? @$complaint->complaint_date_np : @$complaint->complaint_date_en }}
                                        </span>

                                        <span class="nepali-font">
                                            {{ date('H:i A', $createdAt) }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="28%" class="{{setFont()}}">
                                        {{ trans('complaintstatus.condition') }}
                                    </td>
                                    <td class="{{setFont()}}">
                                        {{ getLan() == 'np' ? @$complaint->complaintStatus->name_ne : @$complaint->complaintStatus->name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td width="28%" class="{{setFont()}}">
                                        {{ trans('complaintstatus.seriousness') }}
                                    </td>
                                    <td class="{{setFont()}}">
                                        {{ getLan() == 'np' ? @$complaint->complaintPriority->name_ne : @$complaint->complaintPriority->name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td width="28%" class="{{setFont()}}">
                                        {{ trans('complaintstatus.complaint_source') }}
                                    </td>
                                    <td class="{{setFont()}}">
                                        {{ getLan() == 'np' ? @$complaint->complaintSource->name_ne : @$complaint->complaintSource->name }}
                                    </td>
                                </tr>


                                <tr>
                                    <td class="{{setFont()}}">
                                        {{ trans('complaintstatus.description') }}
                                    </td>
                                    <td class="{{setFont()}}">
                                        {{ $complaint->description }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size: 1.15em;" class="{{setFont()}}">
                                        {{ trans('complaints.related_works') }}
                                    </td>
                                    <td>
                                        <div class="tracking-list {{ setFont() }} " style="border: none;">
                                            @forelse (@$progress as $pg)
                                                <div class="tracking-item">
                                                    <div class="tracking-icon status-intransit">
                                                        <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true"
                                                             data-prefix="fas" data-icon="circle" role="img"
                                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                             data-fa-i2svg="">
                                                        </svg>
                                                    </div>
                                                    <div class="tracking-date">
                                                        <div class="{{setFont()}}">
                                                            {{ getLan() == 'np' ? $dateHelper->eng_to_nep($pg->created_at, true) : date('l, jS F, Y', strtotime($pg->created_at)) }}
                                                        </div>

                                                    </div>
                                                    <div class="tracking-content">

                                                        <span class="h6 mb-0 {{setFont()}}">
                                                            {{ $pg->description }}
                                                        </span>

                                                        <span class="{{setFont()}}">
                                                            {{ @$pg->responding_office }}
                                                        </span>

                                                        <span class="{{setFont()}}">
                                                            -
                                                            {{ getLan() == 'np' ? @$pg->userInfo->full_name_np : @$pg->userInfo->full_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @empty
                                                {{ trans('complaintstatus.comment') }}
                                            @endforelse
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="print-button" style="color: white; text-align: center;">
                <a href="javascript:void(0)" onclick="window.print();" title="Print" class="btn btn-primary">
                    <i class="fa fa-print"></i>
                    {{ trans('complaintstatus.print') }}
                </a>
            </div>

        </div>
    </div>
@endsection