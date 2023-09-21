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
                            <a href="{{url($page_url)}}">
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
                                <div class="form-group col-md-2 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.Registration_no') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" name="regd_no" id="regd_no" placeholder=""
                                        value="{{ @$autoCodeGen['codeFormat'] }}" width="50%" readonly>
                                </div>
                                <div class="form-group col-md-2 {{ setFont() }}">
                                    <label for="inputName">

                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('regd_no',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('dartaKitab.dc_register_book.Registration_no'),
                                    'autocomplete'=>'off','readonly',

                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-4 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.invoice_no') }}

                                    </label>
                                    {!! Form::text('dispatch_no',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('dartaKitab.dc_register_book.invoice_no'),
                                    'autocomplete'=>'off',
                                    'required'
                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-4 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.letter_no') }}

                                    </label>
                                    {!! Form::text('letter_no',null,
                                    ['class'=>'form-control',
                                    'placeholder'=> trans('dartaKitab.dc_register_book.letter_no'),
                                    'autocomplete'=>'off',
                                    'required'
                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>


                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.subject_of_the_letter') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('letter_sub',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('dartaKitab.dc_register_book.subject_of_the_letter') ,
                                    'autocomplete'=>'off',
                                    'required'
                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>
                                @if($value->letter_upload !=null)
                                <div class="form-group col-md-2 {{setFont()}}">
                                    <label for="">
                                        {{ trans('suggestion.file') }}
                                    </label>
                                    <br>
                                    <a href="{{URL::to('/storage/'.$filePath.'/'.$value->letter_upload)}}"
                                        target="_blank" class="btn btn-secondary btn-xs rounded-pill"
                                        data-placement="top" title="{{trans('message.pages.common.viewFile')}}">
                                        <i class="fa fa-file"></i>
                                    </a>
                                    &nbsp;
                                    <a href="{{URL::to('/storage/'.$filePath.'/'.$value->letter_upload)}}"
                                        class="btn btn-danger btn-xs rounded-pill {{setFont()}}" download
                                        data-toggle="tooltip" title="Download File">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                                @endif

                                <div
                                    class="form-group col-md- @if($value->letter_upload !=null) 4 @else 6 @endif{{setFont()}}">

                                    <label for="file">
                                        {{ trans('dartaKitab.dc_register_book.letter_upload') }}
                                    </label>
                                    <input type="file" class="form-control-file " accept=".docx, .pdf , .xsls"
                                        name="letter_upload">
                                    {!! $errors->first('image', '<span class="text text-danger">:message</span>') !!}

                                    @if($errors->has('letter_upload') == null)
                                    <span class="text text-danger {{setFont()}}" style="font-size: 14px;color: #ff042c">
                                        {{trans('message.pages.users_management.file_upload_message')}}
                                    </span>
                                    @endif
                                </div>


                                <div class="form-group col-md-4 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.letter_receiving_depart') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {{ Form::select('to_branch_id',
                                            $branch_list->pluck('name','id'),
                                            Request::get('to_branch_id'),
                                            ['class'=>'form-control select2',

                                            'style'=>'width: 100%',
                                            'placeholder'=>trans('dartaKitab.dc_register_book.letter_receiving_depart_select')
                                            ])
                                        }}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ setFont() }}">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.letter_receiving_person') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {{ Form::select('first_person_id', $employee_list->pluck('name','id'), Request::get('first_person_id'), [
                                            'class' => 'form-control select2',
                                        
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('dartaKitab.dc_register_book.letter_receiving_person'),
                                        ]) }}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>
                                <div class="form-group col-md-4 {{setFont()}}">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.letter_status') }}

                                    </label>


                                    {{ Form::select('letter_status',
                                            $letter_status_list->pluck('name','id'),
                                            Request::get('letter_status'),
                                             ['class'=>'form-control select2',

                                            'style'=>'width: 100%',
                                            'placeholder'=> trans('dartaKitab.dc_register_book.letter_status_select')
                                            ])
                                        }}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>


                                <div class="form-group col-md-12 ">
                                    <br>
                                    <label>
                                        <span class="{{setFont()}}">
                                            {{trans('dartaKitab.dc_register_book.letter_sending_department_Person')}}
                                        </span>
                                    </label>
                                    <hr style="width: 100%;">
                                </div>

                                <div class="form-group col-md-12 {{setFont()}}">

                                    <input class="radio-button" type="radio" name="is_person" checked value="1"
                                        style="margin-top: 2px">
                                    {{ trans('dartaKitab.dc_register_book.person_button') }}

                                    <input class="radio-button" type="radio" name="is_person" value="0"
                                        style="margin-top: 2px">
                                    {{ trans('dartaKitab.dc_register_book.person_department') }}
                                </div>

                                <!-- Person Form -->


                                <div class="form-group col-md-3 personForm {{setFont()}}" id="personForm"
                                    style="display: block;">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.person_name') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('contact_person',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('dartaKitab.dc_register_book.person_name') ,
                                    'autocomplete'=>'off',

                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-3  personForm {{setFont()}}" id="personForm"
                                    style="display:  block;">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.address') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('contact_address',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('dartaKitab.dc_register_book.address') ,
                                    'autocomplete'=>'off',

                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-4 personForm  {{setFont()}}" id="personForm"
                                    style="display: block;">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.contact_no') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('contact_no',null,
                                    ['class'=>'form-control',
                                    'id'=>'office_contact_number',
                                    'placeholder'=>trans('dartaKitab.dc_register_book.contact_no') ,
                                    'autocomplete'=>'off',

                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <!-- department -->

                                <div class="form-group col-md-4 departmentForm {{setFont()}}" style="display: none;">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.office_name') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {{ Form::select('from_off_id',
                                            $office_list->pluck('name','id'),
                                            Request::get('from_off_id'),
                                             ['class'=>'form-control select2',

                                            'style'=>'width: 100%',
                                            'placeholder'=> trans('dartaKitab.dc_register_book.office_name')
                                            ])
                                        }}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-12 {{setFont()}}">
                                    <label>
                                        <span> {{trans('dartaKitab.dc_register_book.foreign')}} </span>
                                    </label>
                                </div>


                                <div class="form-group col-md-12 {{setFont()}}">

                                    <input class="radio-button" type="radio" name="is_foreign" value="1"
                                        style="margin-top: 2px">
                                    {{ trans('dartaKitab.dc_register_book.yes') }}

                                    <input class="radio-button" type="radio" name="is_foreign" checked value="0"
                                        style="margin-top: 2px">
                                    {{ trans('dartaKitab.dc_register_book.no') }}
                                </div>


                                <div class="form-group col-md-4 CountryForm {{setFont()}}" style="display: none;">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.country') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {{ Form::select('country_id',
                                            $country_list->pluck('name','id'),
                                            Request::get('country_id'),
                                             ['class'=>'form-control select2',

                                            'style'=>'width: 100%',
                                            'placeholder'=> trans('dartaKitab.dc_register_book.country')
                                            ])
                                        }}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                </div>

                                <div class="form-group col-md-12 {{setFont()}} ">
                                    <label>
                                        <span> {{trans('dartaKitab.dc_register_book.rate')}} </span>
                                    </label>
                                </div>

                                <div class="form-group col-md-12 {{setFont()}}">

                                    <input class="radio-button" type="radio" name="fee_applicable" value="1"
                                        style="margin-top: 2px">
                                    {{ trans('dartaKitab.dc_register_book.yes') }}

                                    <input class="radio-button" type="radio" name="fee_applicable" checked value="0"
                                        style="margin-top: 2px">
                                    {{ trans('dartaKitab.dc_register_book.no') }}
                                </div>


                                <div class="form-group col-md-4 RateForm {{setFont()}}" style="display: none;">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.receipt_no') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('reg_receipt',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('dartaKitab.dc_register_book.receipt_no') ,
                                    'autocomplete'=>'off',

                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}

                                </div>
                                <div class="form-group col-md-4 RateForm {{setFont()}}" style="display: none;">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.receipt_person') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('reg_name',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>trans('dartaKitab.dc_register_book.receipt_person') ,
                                    'autocomplete'=>'off',

                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}

                                </div>

                                <div class="form-group col-md-4 RateForm {{setFont()}}" style="display: none;">
                                    <label for="inputName">
                                        {{ trans('dartaKitab.dc_register_book.receipt_rate') }}
                                        <span class="text text-danger">
                                            *
                                        </span>
                                    </label>
                                    {!! Form::text('reg_fee',null,
                                    ['class'=>'form-control',
                                    'placeholder'=>'Rs' ,
                                    'autocomplete'=>'off',
                                    'pattern' => '[0-9]+(\.[0-9]+)?',

                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}

                                </div>

                                <div class="form-group col-md-12 ">
                                    <br>
                                    <label for="inputName">
                                        <span class="{{setFont()}}"> {{trans('dartaKitab.dc_register_book.comment')}}
                                        </span>
                                    </label>

                                </div>
                                <div class="form-group col-md-12 {{setFont()}}">

                                    {!! Form::textarea('notes',null,
                                    ['class'=>'form-control',
                                    'rows'=>4,
                                    'placeholder'=>trans('dartaKitab.dc_register_book.comment') ,
                                    'autocomplete'=>'off',

                                    ])
                                    !!}
                                    {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}

                                </div>


                            </div>
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
    </section>
    @endsection