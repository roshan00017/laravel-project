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
                                        {{ trans('complaints.ticket_no') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($complaint->complaint_no))
                                            {{ $complaint->complaint_no }}
                                        @endif
                                    </td>
                                </tr>



                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.province') }}
                                    </td>
                                    <td width="80%">
                                        @if (isset($complaint->province))
                                            {{ getLan() == 'np' ? $complaint->province->name_np : $complaint->province->name_en }}
                                        @endif

                                    </td>

                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.district') }}
                                    </td>
                                    <td width="80%">

                                        @if (isset($complaint->district))
                                            {{ getLan() == 'np' ? $complaint->district->name_np : $complaint->district->name_en }}
                                        @endif

                                    </td>

                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('message.pages.common.local_body_name') }}
                                    </td>
                                    <td width="80%">

                                        @if (isset($complaint->localBody))
                                            {{ getLan() == 'np' ? $complaint->localBody->name_np : $complaint->localBody->name_en }}
                                        @endif
                                    </td>

                                </tr>


                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.ward') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($complaint->ward))
                                            {{ $complaint->ward }}
                                        @endif
                                    </td>
                                </tr>


                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.date') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($complaint->complaint_date_np))
                                            {{ getLan() == 'np' ? $complaint->complaint_date_np : $complaint->complaint_date_en }}
                                        @endif
                                        <i class="fa fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($complaint->created_at)->format('g:i A') }}
                                    </td>
                                </tr>


                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.complaint_type') }}
                                    </td>
                                    <td width="80%">
                                        @if (isset($complaint->complaintType))
                                            {{ getLan() == 'np' ? $complaint->complaintType->name_ne : $complaint->complaintType->name }}
                                        @endif
                                    </td>

                                </tr>
                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.name_of_complainant') }}
                                    </td>
                                    <td width="80%">
                                        @if (isset($complaint->name_ne))
                                            {{ getLan() == 'np' ? $complaint->name_ne : $complaint->name_en }}
                                        @endif
                                    </td>

                                </tr>
                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.gender') }}
                                    </td>
                                    <td width="80%">
                                        @if (isset($complaint->gender))
                                            {{ getLan() == 'np' ? $complaint->gender->name_np : $complaint->gender->name_en }}
                                        @endif
                                    </td>

                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.complaint_severity') }}
                                    </td>
                                    <td width="80%">
                                        @if (isset($complaint->complaintSeverityType))
                                            {{ getLan() == 'np' ? $complaint->complaintSeverityType->name_ne : $complaint->complaintSeverityType->name }}
                                        @else
                                            <input type="text" class="form-control" value="" readonly>
                                        @endif
                                    </td>

                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.complaint_source') }}
                                    </td>
                                    <td width="80%">
                                        @if (isset($complaint->complaintSource))
                                            {{ getLan() == 'np' ? $complaint->complaintSource->name_ne : $complaint->complaintSource->name }}
                                        @else
                                            <input type="text" class="form-control" value="" readonly>
                                        @endif
                                    </td>

                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.grievance_status') }}
                                    </td>
                                    <td width="80%">
                                        @if ($complaint->status)
                                            {{ getLan() == 'np' ? $complaint->complaintStatus->name_ne : $complaint->complaintStatus->name }}
                                        @endif
                                    </td>

                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.brief_description') }}
                                    </td>
                                    <td width="80%">
                                        @if ($complaint->description)
                                            {{ getLan() == 'np' ? $complaint->description : $complaint->description }}
                                        @endif
                                    </td>

                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('complaints.need_to_follow_up') }}
                                    </td>
                                    <td width="80%">
                                        @if (isset($complaint->require_follow_up))
                                            {{ trans('message.button.yes') }} &nbsp;&nbsp;||&nbsp;&nbsp;
                                            {{ trans('complaints.follow_up_date') }}
                                            {{ getLan() == 'np' ? $complaint->follow_up_date_bs : $complaint->follow_up_date_ad }}
                                        @else
                                            {{ trans('message.button.no') }}
                                        @endif
                                    </td>

                                </tr>

                                <tr class="detail-section {{ setFont() }}">
                                    <td class="section-header" width="20%" style="font-size: 1.15em;">
                                        {{ trans('suggestion.file') }}
                                    </td>

                                    <td width="80%">
                                        @if (isset($complaint->file_name))
                                            <a href="{{ URL::to('/storage/' . $filePath . '/' . $complaint->file_name) }}"
                                                target="_blank" class="btn btn-secondary btn-xs rounded-pill"
                                                data-placement="top"
                                                title="{{ trans('message.pages.common.viewFile') }}">
                                                <i class="fa fa-file"></i>
                                            </a>
                                            &nbsp;
                                            <a href="{{ URL::to('/storage/' . $filePath . '/' . $complaint->file_name) }}"
                                                class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" download
                                                data-toggle="tooltip" title="Download File">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 1.15em;" class="{{ setFont() }}">
                                        {{ trans('complaints.related_works') }}
                                    </td>
                                    <td>
                                        <div class="tracking-list {{ setFont() }}">
                                            @foreach ($progress as $pg)
                                                <div class="tracking-item">
                                                    <div class="tracking-icon status-intransit">
                                                        <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true"
                                                            data-prefix="fas" data-icon="circle" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                            data-fa-i2svg="">
                                                            {{-- <path fill="currentColor"
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path> --}}
                                                        </svg>
                                                        {{-- <i class="fas fa-circle"></i> --}}
                                                    </div>
                                                    <div class="tracking-date">
                                                        <div>
                                                            {{ getLan() == 'np' ? $dateHelper->eng_to_nep($pg->created_at, true) : date('l, jS F, Y', strtotime($pg->created_at)) }}
                                                        </div>

                                                    </div>
                                                    <div class="tracking-content">
                                                        <span class="h6 mb-0 ">{{ $pg->description }}</span>
                                                        <span>
                                                            {{ @$pg->responding_office }}</span>
                                                        <span>-
                                                            {{ getLan() == 'np' ? @$pg->userInfo->full_name_np : @$pg->userInfo->full_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                        </br>
                        @if ($complaint->status == '8')
                            <button class="{{ setFont() }} btn btn-danger btn-sm float-left rounded-pill">
                                <i class="fa fa-info"></i>

                                {{ getLan() == 'np' ? ' गुनासो  बन्द भई सकेको ' : 'Closed' }}
                            </button>

                            &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                            <?php
                            $key = $complaint->id;
                            $data = $complaint;
                            ?>
                            <button class="{{ setFont() }}  btn btn-secondary btn-sm text-center  rounded-pill"
                                style="margin-left: 40px" data-toggle="modal"
                                data-target="#statusModal{{ $key }}">
                                <i class="fa fa-info-circle"></i>

                                {{ getLan() == 'np' ? ' पुन: खोल्नुहोस् ' : 'Reopen ?' }}
                            </button>
                            @include('backend.grevience.complaints.statusModel')
                        @else
                            <button
                                class="openFormButton {{ setFont() }} btn btn-primary btn-sm float-left rounded-pill boxButton">
                                <i class="fa fa-plus-circle"></i>
                                {{ trans('complaints.add_button') }}
                            </button>
                        @endif


                        <button class="btn btn-primary btn-sm float-right rounded-pill boxButton {{ setFont() }}"
                            onclick="window.print();" id="printBtn" title="Print"
                            class="btn btn-primary  rounded-pill"><i class="fa fa-print"></i>
                            {{ trans('complaintstatus.print') }}
                        </button>
                    </div>

                </div>
            </div>
            <div class="container-fluid myForm" style="display: none;">
                {!! Form::open([
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                    'id' => 'addMore',
                    'route' => 'complaint.progress',
                ]) !!}
                <input type="hidden" name="complaint_id" id="" value="{{ $complaint->id }}">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="margin: 10px">
                            <div class="col-md-12">
                                <h4 class="{{ setFont() }}">
                                    {{ trans('complaints.new_work') }}
                                </h4>
                                <hr>

                            </div>

                            <div class="form-group col-md-4 {{ setFont() }}">
                                <label for="inputName">
                                    {{ trans('complaints.grievance_status') }}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                <br>
                                {{ Form::select('complaint_status', $complaintStatuses->pluck('name', 'id'), Request::get('complaint_status'), [
                                    'class' => 'form-control select2 complaint_status',
                                
                                    'style' => 'width: 100%',
                                    'placeholder' => trans('complaints.select_status'),
                                ]) }}
                            </div>

                            <div class="form-group col-md-12 detailsBlock" style="display: none">
                                <label for="inputName" class="{{ setFont() }}">
                                    {{ trans('complaints.progress_information') }}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::textarea('description', null, [
                                    'class' => 'form-control details',
                                    'autocomplete' => 'off',
                                
                                    'rows' => '4',
                                ]) !!}
                                {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group col-md-12 officeBlock" style="display: none">
                                <label for="inputName" class="{{ setFont() }}">
                                    {{ trans('complaints.responding_office') }}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('responding_office', null, [
                                    'class' => 'form-control office',
                                    'autocomplete' => 'off',
                                ]) !!}
                            </div>


                        </div>



                        <div class="modal-footer justify-content-center {{ setFont() }}">
                            <button type="submit" class="btn btn-primary  rounded-pill" id="btn-add">
                                <i class="fa fa-save"></i>
                                {{ trans('message.button.save') }}
                            </button>

                            <button type="button" class="btn btn-danger closeButton rounded-pill" data-dismiss="modal">
                                <i class="fa fa-times-circle"></i>
                                {{ trans('message.button.close') }}
                            </button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.openFormButton').click(function() {
                $('.myForm').toggle();
            });
        });
    </script>
    <script>
        document.querySelector('.closeButton').addEventListener('click', function() {

            document.querySelector('.myForm').style.display = 'none';
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.confirmButton').click(function() {
                $('.confirmModal').modal('show');
            });
        });
    </script>
@endsection
