<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{$page_title}}
                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.common.physical_year_id')}}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->physical_year_id }}"
                               readonly
                        >
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.common.type')}}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->type }}"
                               readonly
                        >
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.common.regd_no')}}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->regd_no }}"
                               readonly
                        >
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.common.organization')}}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->organization }}"
                               readonly
                        >
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.common.date')}}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->date_np }}"
                               readonly
                        >
                    </div>

                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.common.description')}}
                        </label>
                        <textarea class="form-control"
                                  rows="3"
                                  readonly
                        >{{ $data->description }}</textarea>
                    </div>

                    
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{setFont()}}"
                            data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
