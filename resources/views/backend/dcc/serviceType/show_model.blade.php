<div class="modal fade" id="showModal{{$key}}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{ getLan() =='en' ? $data->code : $data->code }}
                    {{ getLan() =='np' ? trans('serviceType.serviceType.serviceType'): trans('serviceType.serviceType.serviceType')}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('serviceType.serviceType.code')}}

                        </label>
                        @if(isset($data->code))
                        <input type="text" class="form-control" value="{{$data->code}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('serviceType.serviceType.name_np')}}

                        </label>
                        @if(isset($data->name_np))
                        <input type="text" class="form-control" value="{{$data->name_np}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('serviceType.serviceType.name_en')}}

                        </label>
                        @if(isset($data->name_en))
                        <input type="text" class="form-control" value="{{$data->name_en}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.commons.status')}}
                        </label>
                        <input type="text" class="form-control"
                            value="{{ $data->status == 1 ? trans('message.button.active') : trans('message.button.inactive') }}"
                            readonly>
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