<div class="modal fade" id="showModal{{$key}}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{ getLan() =='en' ? $data->code : $data->code }}
                    {{ getLan() =='np' ? trans('message.pages.fiscal_year.details_np'): trans('message.pages.fiscal_year.details')}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.fiscal_year.code')}}

                        </label>
                        @if(isset($data->code))
                        <input type="text" class="form-control" value="{{$data->code}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.fiscal_year.date_from_bs')}}

                        </label>
                        @if(isset($data->date_from_bs))
                        <input type="text" class="form-control" value="{{$data->date_from_bs}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.fiscal_year.date_to_bs')}}

                        </label>
                        @if(isset($data->date_to_bs))
                        <input type="text" class="form-control" value="{{$data->date_to_bs}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.fiscal_year.date_from_ad')}}

                        </label>
                        @if(isset($data->date_from_ad))
                        <input type="text" class="form-control" value="{{$data->date_from_ad}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.fiscal_year.date_to_ad')}}

                        </label>
                        @if(isset($data->date_to_ad))
                        <input type="text" class="form-control" value="{{$data->date_to_ad}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.commons.status')}}
                        </label>
                        <input type="text" class="form-control" value="{{ $data->status == 1 ? trans('message.button.active') : trans('message.button.inactive') }}" readonly>
                    </div>
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.fiscal_year.description')}}

                        </label>
                        @if(isset($data->description))
                        <input type="text" class="form-control" value="{{$data->description}}" readonly>
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