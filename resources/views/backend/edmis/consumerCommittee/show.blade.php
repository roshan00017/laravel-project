@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 {{ setFont() }}">
                        {{ $page_title }} {{ trans('message.pages.roles.details') }}
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
                            {{ trans('message.pages.roles.details') }}
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
                    <table class="table table-bordered">
                        <tbody>

                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('message.pages.common.code') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->code))
                                    {{ $value->code }}
                                    @endif
                                </td>
                            </tr>



                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.form_date_bs') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->form_date_bs))
                                    {{ getLan() == 'np' ? $value->form_date_bs : $value->form_date_ad }}
                                    @endif

                                </td>
                            </tr>

                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.ward_no') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->ward_no))
                                    {{ $value->ward_no }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('message.commons.status') }}
                                </td>

                                <td width="80%">

                                    {{ $value->status == 1 ? trans('message.button.active') : trans('message.button.inactive') }}

                                </td>
                            </tr>


                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.bank') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->bank))
                                    {{ $value->bank }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.bank_acc_num') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->bank_acc_num))
                                    {{ $value->bank_acc_num }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.bank_address') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->bank_address))
                                    {{ $value->bank_address }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.present_number') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->present_number))
                                    {{ $value->present_number }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.member_number') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->members_number))
                                    {{ $value->members_number }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.witness_name') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->witness_name))
                                    {{ $value->witness_name }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.full_name') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->full_name))
                                    {{ $value->full_name }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.name') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->name))
                                    {{ $value->name }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.consumer_committee_type') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->consumer_committee_type))
                                    {{ $value->consumer_committee_type }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.regd_no') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->regd_no))
                                    {{ $value->regd_no }}
                                    @endif
                                </td>
                            </tr>


                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.form_date_bs') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->regd_date_bs))
                                    {{ getLan() == 'np' ? $value->regd_date_bs : $value->regd_date_ad }}
                                    @endif

                                </td>
                            </tr>

                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.office') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->office))
                                    {{ $value->office }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.other_details') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->other_details))
                                    {{ $value->other_details }}
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.per_province') }}
                                </td>
                                <td width="80%">
                                    @if (isset($value->province))
                                    {{ getLan() == 'np' ? $value->province->name_np : $value->province->name_en }}
                                    @else
                                    <input type="text" class="form-control" value="" readonly>
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.per_district') }}
                                </td>
                                <td width="80%">
                                    @if (isset($value->district))
                                    {{ getLan() == 'np' ? $value->district->name_np : $value->district->name_en }}
                                    @else
                                    <input type="text" class="form-control" value="" readonly>
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.per_localbody') }}
                                </td>
                                <td width="80%">

                                    @if (isset($value->localBody))
                                    {{ getLan() == 'np' ? $value->localBody->name_np : $value->localBody->name_en }}
                                    @else
                                    <input type="text" class="form-control" value="" readonly>
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.per_ward_no') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->per_ward_no))
                                    {{ $value->per_ward_no }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.per_street') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->per_street_name))
                                    {{ $value->per_street_name }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.temp_province') }}
                                </td>
                                <td width="80%">
                                    @if (isset($value->tempProvince))
                                    {{ getLan() == 'np' ? $value->tempProvince->name_np : $value->tempProvince->name_en }}
                                    @else
                                    <input type="text" class="form-control" value="" readonly>
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.temp_district') }}
                                </td>
                                <td width="80%">
                                    @if (isset($value->tempDistrict))
                                    {{ getLan() == 'np' ? $value->tempDistrict->name_np : $value->tempDistrict->name_en }}
                                    @else
                                    <input type="text" class="form-control" value="" readonly>
                                    @endif
                                </td>

                            </tr>

                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.temp_localbody') }}
                                </td>
                                <td width="80%">

                                    @if (isset($value->tempLocalBody))
                                    {{ getLan() == 'np' ? $value->tempLocalBody->name_np : $value->tempLocalBody->name_en }}
                                    @else
                                    <input type="text" class="form-control" value="" readonly>
                                    @endif
                                </td>
                            </tr>

                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.temp_ward_no') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->temp_ward_no))
                                    {{ $value->temp_ward_no }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.temp_street') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->temp_street_name))
                                    {{ $value->temp_street_name }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.full_name') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->full_name))
                                    {{ $value->full_name }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.name') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->name))
                                    {{ $value->name }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.designation') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->contact_person_designation))
                                    {{ $value->contact_person_designation }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.phone') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->contact_person_phone))
                                    {{ $value->contact_person_phone }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.mobile') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->contact_person_mobile))
                                    {{ $value->contact_person_mobile }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="detail-section {{ setFont() }}">
                                <td class="section-header" width="20%" style="font-size: 1.15em;">
                                    {{ trans('consumerCommittee.consumer.email') }}
                                </td>

                                <td width="80%">
                                    @if (isset($value->email))
                                    {{ $value->email }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </br>


                </div>

            </div>
        </div>


</div>
</section>
<!-- /.container-fluid -->
<!-- /.content -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle button click event
        $('.openFormButton').click(function() {
            $('.myForm').toggle();
        });
    });
</script>
@endsection