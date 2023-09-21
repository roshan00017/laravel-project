@php
$name = setName();
@endphp
<div class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    @if(isset($data->school))
                    {{ getLan() =='en' ? $data->school->name_en : $data->school->name_np }}
                    @else
                    {{ getLan() =='en' ? 'Document' : 'टिप्पणी ' }}
                    @endif
                    {{$page_title}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.code')}}
                        </label>
                        @if(isset($data->code))
                        <input type="text" class="form-control" value="{{ $data->code }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.document_no')}}
                        </label>
                        @if(isset($data->document_no))
                        <input type="text" class="form-control" value="{{ $data->document_no }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.document_type_id')}}
                        </label>
                        @if(isset($data->document_type_id))
                        <input type="text" class="form-control" value="{{ $data->document_type_id }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.to_section_id')}}
                        </label>
                        @if(isset($data->to_section_id))
                        <input type="text" class="form-control" value="{{ $data->to_section_id }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.from_section_id')}}
                        </label>
                        @if(isset($data->from_section_id))
                        <input type="text" class="form-control" value="{{ $data->from_section_id }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.filepath')}}
                        </label>
                        @if(isset($data->filepath))
                        <input type="text" class="form-control" value="{{ $data->filepath }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.employee_id')}}
                        </label>
                        @if(isset($data->employee_id))
                        <input type="text" class="form-control" value="{{ $data->employee_id }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.file_status_id')}}
                        </label>
                        @if(isset($data->file_status_id))
                        <input type="text" class="form-control" value="{{ $data->file_status_id }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.client_id')}}
                        </label>
                        @if(isset($data->client_id))
                        <input type="text" class="form-control" value="{{ $data->client_id }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.remarks')}}
                        </label>
                        @if(isset($data->remarks))
                        <input type="text" class="form-control" value="{{ $data->remarks }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.dc_document.ward_no')}}
                        </label>
                        @if(isset($data->ward_no))
                        <input type="text" class="form-control" value="{{ $data->ward_no }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{setFont()}}" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>