
<div class="modal fade"
     id="tokenStatus{{ $key }}"
     data-keyboard="false"
     data-backdrop="static"
>
<div class="modal-dialog  modal-dialog-centered">    
    <div class="modal-content text-center modal-content-radius">
            <div class="modal-body">
                
                <div class="input__grid row">
                   
                    <div class="input span2 col-md-6">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('message.pages.common.date') }}
                        </label>
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->date_en}}"
                                   readonly
                            >
                       
                    </div>

                    <div class="input span2 col-md-6">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('message.commons.status') }}
                        </label>
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->token_no}}"
                                   readonly
                            >
                       
                    </div>
                  
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button"
                        class="btn btn-secondary rounded-pill {{setFont()}}"
                        data-dismiss="modal"
                >
                    <i class="fa fa-times"></i>
                    {{trans('message.button.close')}}
                </button>
            </div>
        </div>
    </div>   
</div>
