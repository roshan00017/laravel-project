<div class="modal fade"
     id="imageModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-radius"
             style="width: 400px"
        >
            <div class="modal-header btn-primary rounded-pill">
                <h6 class="modal-title {{setFont()}}">
                    <label>&nbsp;
                        {{trans('message.pages.system_setting.app_setting.change_app_logo')}}
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
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                        'url'=>$file_upload_url.'/'.$result['id'],
                        'enctype'=>'multipart/form-data'])
                !!}
                <div class="form-group {{setFont()}}">
                    <input type="hidden"
                           name="column_name"
                           value="app_logo"
                    >
                    {{--set file tile --}}
                    <input type="hidden"
                           name="file_title"
                           value="{{ getLan() == 'np' ? $result['app_name_np'] :  $result['app_name']}}"
                    >
                    <label>
                        {{trans('message.pages.system_setting.app_setting.app_logo')}}
                    </label>
                    <label  class="text-danger">
                        *
                    </label>
                    <br>
                    <input type="file"
                           name="update_file"
                           required
                    >
                    <br>
                    @if($errors->has('app_logo') == null)
                        <span class="text text-danger"
                              style="font-size: 13px;color: #ff042c;"
                        >
                                                             {{trans('message.pages.users_management.file_upload_message')}}

                                                        </span>
                    @endif
                </div>
            </div>
            <div class="modal-footer justify-content-center {{setFont()}}">
                <button type="submit"
                        class="btn btn-success rounded-pill"
                >
                    <i class="fa fa-check-circle"></i> {{trans('message.button.upload')}}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>