<div class="modal fade"
     id="technical_error_modal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{env('APP_NAME')}}
                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    {{ Session::get('server_error') }}
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button"
                        class="btn btn-secondary rounded-pill"
                        data-dismiss="modal"
                >
                    <i class="fa fa-times-circle"></i>
                    {{trans('message.button.close')}}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
