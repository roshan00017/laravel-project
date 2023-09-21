@extends('frontend.layouts.welcome')
@section('content')
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
                            {{ trans('frontendSuggestion.suggestion.your_suggestion') }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <div class="form__section">
        <div class="custom-container">
            <div class="form__section-content">
                <h2 class="section__title {{setFont()}}">
                    {{ trans('frontendSuggestion.suggestion.pro_suggestion') }}
                </h2>

                {!! Form::open([
                   'method' => 'POST',
                   'route' => 'suggestion.store',
                   'enctype' => 'multipart/form-data',
                   'autocomplete' => 'off',
               ]) !!}
                <div class="input__grid">
                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('frontendSuggestion.suggestion.name') }}
                        </label>
                        {!! Form::text('name',  Request::get('name'), [
                           'autocomplete' => 'off',
                           'required'
                        ]) !!}

                        @if ($errors->has('name'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('name') }}
                                </span>
                        @endif
                    </div>

                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="mobile-number">
                            {{ trans('frontendSuggestion.suggestion.mobile_no') }}
                        </label>


                        {!! Form::text('mobile',  Request::get('mobile'), [
                            'class' => 'mobileNo',
                         'autocomplete' => 'off',
                         'required',
                         'id'=>'mobile',
                        ]) !!}
                        @if ($errors->has('mobile'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('mobile') }}
                                </span>
                        @endif
                    </div>

                    <div class="input">
                        <label class="{{setFont()}}"
                               for="email">
                            {{ trans('frontendSuggestion.suggestion.email') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::email('email',  Request::get('email'), [
                        'autocomplete' => 'off',
                       ]) !!}
                        @if ($errors->has('email'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('email') }}
                                </span>
                        @endif
                    </div>

                    <div class="input">
                        <label class="required {{setFont()}}"
                               for="type">{{trans('frontendSuggestion.suggestion.types')}}
                        </label>

                        <select class="type-select" name="suggestion_category_id"
                                data-error="सुझाबको प्रकार अनिवार्य छ |" required>
                            <option value="">
                                {{trans('frontendSuggestion.suggestion.choose_any')}}
                            </option>
                            @foreach($category as $ct)
                                <option value="{{ $ct->id }}"
                                        @if($ct->id == @$complaint->suggestion_category_id) selected @endif>
                                    @if(app()->getLocale() == 'ne')
                                        {{ $ct->name_ne }}
                                    @else
                                        {{ $ct->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('suggestion_category_id'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('suggestion_category_id') }}
                                </span>
                        @endif
                    </div>

                    <div class="input span2">
                        <label class="required {{setFont()}}"
                               for="description">
                            {{trans('frontendSuggestion.suggestion.document')}}
                        </label>
                        {!! Form::textarea('suggestions', Request::get('suggestions'), [
                            'rows' => '4',
                            'autocomplete' => 'off',
                        ]) !!}
                        @if ($errors->has('suggestions'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('suggestions') }}
                                </span>
                        @endif
                    </div>



                 <div class="input span2">
                        <label class="{{setFont()}}" for="phone-upload">
                            {{trans('frontendSuggestion.suggestion.suggestion_file_upload')}}
                        </label>
                        <div class="photo__uploader">
                            <input
                                    type="file"
                                    id="imageUploadInput"
                                    class="File"
                                    name="suggestion_file"
                                    accept=".JPG, .PNG, .JPEG, .PDF, .jpg,.png,.jpeg"
                                    value="{{{ @$suggestion->files ?? '' }}}"
                                    onchange="previewFile(this)"
                            />
                            <button id="uploadToggler" type="button">
                                <span class="{{setFont()}}">
                                    <i class="fa-solid fa-photo-film"></i>
                                    {{ trans('message.pages.users_management.file_upload_message') }}
                                </span>
                            </button>
                             <span class="requirements {{setFont()}}">
                                {{ trans('message.pages.users_management.file_upload_message') }}
                            </span>
                            <img id="imagePreview" src="#" alt="Uploaded File" style="display: none;  max-width: 27%; max-height: 100px;" />
                            <p id="pdfName" style="display: none;"></p> 
                            @if ($errors->has('suggestion_file'))
                            <div class="alert alert-danger">
                                {{ $errors->first('suggestion_file') }}
                            </div>
                            @endif
                            </div>
                        
                                     </div>


                    <div class="button__group span2">
                        <button type="submit"
                                class="submit__btn">
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
    @include('frontend.component.checkDataModal')
@endsection