<div class="modal fade"
     id="success_modal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-body">
                <h5 class="{{setFont()}}">
                    <strong>
                        <i class="fa fa-check text-success" style="font-size: 60px"></i><br>
                    </strong>
                   {{ \Illuminate\Support\Facades\Session::get('success') }}
                </h5>
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
