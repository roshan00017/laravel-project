<div class="modal fade"
     id="imageViewModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-sm  modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill {{setFont()}}">
                <h6 class="modal-title">
                    <label>
                        &nbsp;       {{trans('message.pages.system_setting.app_setting.uploaded_app_logo')}}
                    </label>
                </h6>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                                                <span aria-hidden="true"
                                                      data-toggle="tooltip"
                                                      title="Close"
                                                >
                                                    &times;
                                                </span>
                </button>
            </div>
            <div class="modal-body  text-center">
                <img src="{{asset('/storage/uploads/files/'.$result['app_logo'])}}"
                     class="rounded-pill"
                     width="100" height="100"
                >
                <div class="modal-footer" style="text-align: center">
                    <a href="{{URL::to('storage/uploads/files/'.$result['app_logo'])}}"
                       class="btn btn-danger btn-xs rounded-pill {{setFont()}}" download
                       data-toggle="tooltip"
                       title="Download File"
                    >
                        <i class="fa fa-download"></i>
                        {{trans('message.pages.system_setting.app_setting.download')}}
                    </a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>