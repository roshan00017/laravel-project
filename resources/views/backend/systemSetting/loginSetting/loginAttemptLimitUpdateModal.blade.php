<div class="modal fade"
     id="loginAttemptLimitModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title">
                    @if(systemSetting())
                        {{getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
                    @else
                        {{trans('message.pages.common.app_short_name')}}
                    @endif
                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['method' => 'POST',
                    'class'=>'inline', 'url'=>[$status_url. '/'.$result['id']]])
            !!}
            <div class="modal-body">
                <input type="hidden"
                       name="column_name"
                       value="login_attempt_limit"
                >

                <input type="hidden"
                       name="column_name1"
                       value="login_attempt_required"
                >
                <input type="hidden"
                       name="column1_value"
                       value="1"
                >
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>
                            {{trans('message.pages.system_setting.login_setting.login_attempt_required')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>
                        <input type="number"
                               class="form-control"
                               name="status"
                               value="{{$result['login_attempt_limit']}}"
                               required min="1"
                        >
                        {!! $errors->first('login_attempt_limit', '<span class="text text-danger">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center {{setFont()}}">
                <button type="submit"
                        class="btn btn-success rounded-pill"
                >
                    <i class="fa fa-check-circle"></i>
                    {{trans('message.button.update')}}
                </button> &nbsp; &nbsp;
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>