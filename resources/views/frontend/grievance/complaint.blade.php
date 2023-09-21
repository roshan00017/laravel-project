@extends('frontend.layouts.welcome')
<?php $appointmentHelper = new \App\Helpers\AppointmentHelper();
?>
<style>
    .select2-selection__rendered {
        line-height: 48px !important;
    }

    .select2-search__field {
        height: 44px !important;
    }

    .select2-selection__arrow b {
        top: 84% !important;
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
                {!! Form::open(['route' => 'postComplaint',
                         'enctype' => 'multipart/form-data',
                         'autocomplete' => 'off',
                        'method'=>'POST']) !!}
                <div class="input__grid formActive">
                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="type">
                            {{trans('frontendSuggestion.complaintinfo.grev_type')}}
                        </label>
                        <select
                                class="type-select {{setFont()}}"
                                name="form_category_id"
                                required>
                            <option value="" class="{{setFont()}}">
                                {{trans('frontendSuggestion.complaintinfo.choose_any')}}
                            </option>
                            @foreach ($category as $ct)
                                <option value="{{ $ct->id }}" @if ($ct->id ==
                                                        @$complaint->form_category_id) selected @endif>
                                    {{ $ct->name_ne }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('form_category_id'))
                            <span class="text-danger {{setFont()}}">
                                            {{ $errors->first('form_category_id') }}
                                        </span>
                        @endif

                    </div>
                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="type">
                            {{trans('frontendSuggestion.complaintinfo.related_branch')}}
                        </label>
                        <select
                                class="type-select {{setFont()}}"
                                name="office_id" required>

                            <option value="" class="{{setFont()}}">
                                {{trans('frontendSuggestion.complaintinfo.choose_any')}}
                            </option>
                            @foreach ($office as $ct)
                                <option value="{{ $ct->id }}" @if ($ct->id ==
                                                        @$complaint->office_id) selected @endif>
                                    {{ $ct->name_ne }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('office_id'))
                            <span class="text-danger {{setFont()}}">
                                            {{ $errors->first('office_id') }}
                                    </span>
                        @endif
                    </div>
                    <div class="input span1">
                        <label class=" {{ setFont() }}" for="type">
                            {{trans('frontendSuggestion.complaintinfo.grev_details')}}
                        </label>
                        {!! Form::textarea('description', @$complaint->description, [
                            'autocomplete' => 'off',
                        ]) !!}
                    </div>
                    <div class="input span1">
                        <label class="{{setFont()}}" for="phone-upload">
                            {{ trans('frontEndComplaint.file_upload') }}
                        </label>
                        <div class="photo__uploader">
                            <input 
                            type="file"
                             id="imageUploadInput"
                             class="File"
                             name="file_name" 
                             accept=".JPG, .PNG, .JPEG, .PDF, .jpg, .png, .jpeg"  
                             value="{{{ @$complaint->files ?? '' }}}"
                             onchange="previewFile(this)"
                             />
                            <button id="uploadToggler" type="button">
                                    <span>
                                        <i class="fa-solid fa-photo-film {{setFont()}}"></i>
                                        {{trans('frontendSuggestion.suggestion.file_upload')}}
                                    </span>
                            </button>
                            <span class="requirements {{setFont()}}">
                                    {{trans('frontendSuggestion.complaintinfo.file_type')}}
                                </span>
                            <img id="imagePreview" src="#" alt="Uploaded File" style="display: none;max-width: 27%; max-height: 100px;" />
                            <p id="pdfName" style="display: none;"></p>

                            @if ($errors->has('file_name'))
                            <div class="alert alert-danger">
                                {{ $errors->first('file_name') }}
                            </div>
                            @endif
                        
                        </div>
                        @if(@$complaint->file_name)
                        <br>
                        <label class="{{setFont()}}">   {{ trans('frontEndComplaint.uploaded_file') }}</label>
                        <a class="text text-primary"
                           href="{{ url('/') }}/storage/uploads/documents/complaints/{{ @$complaint->file_name }}"
                           target="_blank"
                                title="{{trans('message.pages.common.viewFile')}}">
                            <i class="fa fa-file"> </i>
                        </a>
                        @endif
                    </div>
                    
                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="type">
                            {{trans('frontendSuggestion.complaintinfo.grev_depth')}}
                        </label>
                        <select
                                class="type-select {{setFont()}}"
                                name="severity_type_id" required>

                            <option value="" class="{{setFont()}}">
                                {{trans('frontendSuggestion.complaintinfo.choose_any')}}
                            </option>
                            @foreach ($severity as $ct)
                                <option value="{{ $ct->id }}" @if (@$complaint->severity_type_id ==
                                                    $ct->id) selected @endif>
                                    {{ $ct->name_ne }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('severity_type_id'))
                            <span class="text-danger {{setFont()}}">
                                            {{ $errors->first('severity_type_id') }}
                                    </span>
                        @endif
                    </div>


                    <div class="button__group span2">
                        <button
                                type="submit"
                                class="submit__btn form-next"
                        >
                                <span class="{{setFont()}}">
                                        {{ trans('appointment.next') }}
                                   <i class="fa-solid fa-chevron-right"></i>
                                </span>
                        </button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
    @include('frontend.component.checkDataModal')
@endsection
