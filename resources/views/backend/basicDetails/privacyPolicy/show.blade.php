@php
    $name = setName();
@endphp
<div class="modal fade" id="showModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    @if (isset($data->school))
                        {{ getLan() == 'en' ? $data->school->name_en : $data->school->name_np }}
                    @endif
                    {{ trans('privacyPolicy.page_title') }}

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="form-group col-md-12 {{ setFont() }}">
                        <label for="">
                            {{ trans('privacyPolicy.title') }}
                        </label>
                        @if (isset($data->title))
                            <input type="text" class="form-control" value="{{ $data->title }}" readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>


                    <div class="form-group col-md-12 {{ setFont() }}">
                        <label for="">
                            {{ trans('privacyPolicy.content') }}
                        </label>
                        @if (isset($data->content))
                            <input type="text" class="form-control" value="{{ $data->content }}" readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{ setFont() }}"
                        data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{ trans('message.button.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
