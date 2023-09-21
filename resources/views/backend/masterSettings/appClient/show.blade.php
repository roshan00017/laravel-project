@php
    $name = setName();
@endphp
<div class="modal fade" id="showModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    @if (isset($data->school))
                        {{ getLan() == 'en' ? $data->school->name_en : $data->school->name_np }}
                    @endif
                    {{ trans('appClient.title') }}

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="district">
                            {{ trans('message.pages.common.province_name') }}
                        </label>
                        @if (isset($data->province))
                            <input type="text" class="form-control"
                                value="{{ getLan() == 'np' ? $data->province->name_np : $data->province->name_en }}"
                                readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="district">
                            {{ trans('message.pages.common.district_name') }}
                        </label>
                        @if (isset($data->district))
                            <input type="text" class="form-control"
                                value="{{ getLan() == 'np' ? $data->district->name_np : $data->district->name_en }}"
                                readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="localBody">
                            {{ trans('message.pages.common.local_body_name') }}
                        </label>
                        @if (isset($data->localBody))
                            <input type="text" class="form-control"
                                value="{{ getLan() == 'np' ? $data->localBody->name_np : $data->localBody->name_en }}"
                                readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>


                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('appClient.web_url') }}
                        </label>
                        @if (isset($data->web_url))
                            <input type="text" class="form-control" value="{{ $data->web_url }}" readonly>
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
