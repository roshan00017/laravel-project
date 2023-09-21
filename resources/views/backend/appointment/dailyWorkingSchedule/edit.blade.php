@extends('backend.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 {{setFont()}}">
                        {{$page_title}}
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
                            <a href="{{url('dcDispatchBook')}}">
                                {{$page_title}}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            {{trans('message.commons.edit')}}
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

                        {!! Form::model($value,
                        ['method'=>'PUT',
                        'route'=>[$page_route.'.'.'update',$value->id
                        ],
                        'enctype'=>'multipart/form-data',
                        'autocomplete'=>'off'
                        ])
                        !!}

                        <div class="card-header">
                            @include('backend.components.buttons.returnBack')
                            <h5 class="{{setFont()}}"><strong> {{trans('message.commons.edit')}}</strong>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="date_np" value="{{@$date_np}}">
                                <input type="hidden" name="date_en" value="{{@$date_en}}">
                                @if(userInfo()->user_module !='app')
                                <div class="form-group col-md-3 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('schedule.visiting_officer') }}
                                        <span class="text text-danger">*</span>
                                    </label>
                                    {!! Form::select('schedule_type', appointmentDepartment(),
                                    Request::get('schedule_type'), [
                                    'class' => 'form-control select2',
                                    'style' => 'width: 100%;',
                                    'id' => 'department',
                                    'placeholder' => trans('schedule.visiting_officer'),
                                    ]) !!}
                                </div>
                                @endif



                                {{-- Date fields to show or not --}}
                                <div id="dateFields" style="display: none;">
                                    <div class="row">
                                        @if(getLan() =='np')
                                        <div class="form-group col-md-6 {{setFont()}}">
                                            <label for="inputName">
                                                {{ trans('schedule.Date') }}
                                                <span class="text text-danger">*</span>
                                            </label>
                                            {!! Form::text('schedule_date_np', null, [
                                            'class' => 'form-control nepaliDatePicker',
                                            'placeholder' => trans('schedule.Date') ,
                                            'autocomplete' => 'off',
                                            'id' => 'date_from_bs',
                                            'required' => 'required', // Added 'required' attribute
                                            ]) !!}
                                            @if ($errors->has('schedule_date_np'))
                                            <small
                                                class="text text-danger">{{ $errors->first('schedule_date_np') }}</small>
                                            @endif
                                            <input type="hidden" name='schedule_date_en' id="date_from_ad">
                                        </div>
                                        @endif

                                        @if(getLan() =='en')
                                        <div class="form-group col-md-6 {{setFont()}}">
                                            <label for="inputName">
                                                {{ trans('schedule.Date') }}
                                                <span class="text text-danger">*</span>
                                            </label>
                                            {!! Form::text('schedule_date_en', null, [
                                            'class' => 'form-control englishDatePicker',
                                            'placeholder' => trans('schedule.Date') ,
                                            'autocomplete' => 'off',
                                            'id' => 'date_from_ad',
                                            'required' => 'required', // Added 'required' attribute
                                            ]) !!}
                                            @if ($errors->has('schedule_date_en'))
                                            <small
                                                class="text text-danger">{{ $errors->first('schedule_date_en') }}</small>
                                            @endif
                                            <input type="hidden" name='schedule_date_np' id="date_from_bs">
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <table class="table table-bordered dynamicAddRemove">
                                        <tr>
                                            <th colspan="4" class="{{ setFont() }}">
                                                {{trans('schedule.details')}}
                                            </th>
                                        </tr>

                                        <tr class="{{ setFont() }}">
                                            <th>
                                                {{trans('schedule.title')}}
                                            </th>

                                            <th>
                                                {{trans('schedule.start_time')}}
                                            </th>

                                            <th>
                                                {{trans('schedule.end_time')}}
                                            </th>

                                            <th>
                                                {{trans('schedule.location')}}
                                            </th>

                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <input type="text" required name="title" class="form-control"
                                                    value="{{ $value['title'] ?? '' }}" autocomplete="off" />
                                            </td>
                                            <td width="10%">
                                                <input type="time" required name="start_time" class="form-control"
                                                    value="{{ $value['start_time'] ?? '' }}" autocomplete="off" />
                                            </td>
                                            <td width="10%">
                                                <input type="time" required name="end_time" class="form-control"
                                                    value="{{ $value['end_time'] ?? '' }}" autocomplete="off" />
                                            </td>
                                            <td width="20%">
                                                <input type="text" required name="location" class="form-control"
                                                    value="{{ $value['location'] ?? '' }}" autocomplete="off" />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                {{-- Small Js field for show and add --}}
                                <script>
                                const addText = "{{ trans('meeting.meeting.add') }}";
                                const removeText = "{{ trans('schedule.remove') }}";
                                </script>


                            </div>


                            <div class="modal-footer justify-content-center {{setFont()}}">
                                @include('backend.components.buttons.updateAction')
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.container-fluid -->
    <!-- /.content -->
    @include('backend.modal.technical-error-modal')
    @include('backend.modal.check_data_modal')
</div>
@endsection
