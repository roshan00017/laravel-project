<div class="modal fade"
     id="check_data_modal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-body">
                <p style="color: red" class="{{setFont()}}"
                   id="error"
                >

                </p>
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
        <!-- /.modal-content -->
    </div>
</div>
