<div class="modal fade"
     id="captchaModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog  modal-dialog-centered modal-content-radius">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title{{setFont()}}">
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
                        'class'=>'inline',
                        'url'=>[$status_url. '/'.$result['id']]])
            !!}
            <input type="hidden"
                   name="column_name"
                   value="login_captcha_required"
            >
            <div class="modal-body text-center {{setFont()}}">
                @if($result['login_captcha_required'] == 1)
                    <input type="hidden" name="status" value="0">
                    <h5>
                        {{trans('message.pages.system_setting.login_setting.are_you_sure_you_want_to_no')}}
                    </h5>
                @else
                    <input type="hidden" name="status" value="1">
                    <h5> {{trans('message.pages.system_setting.login_setting.are_you_sure_you_want_to_yes')}}</h5>
                @endif
            </div>
            <div class="modal-footer justify-content-center {{setFont()}}">
                <button type="submit"
                        class="btn btn-primary rounded-pill"
                >
                    <i class="fa fa-check-circle"></i>
                    {{trans('message.button.yes')}}
                </button> &nbsp; &nbsp;
                <button type="button"
                        class="btn btn-danger rounded-pill"
                        data-dismiss="modal"
                >
                    <i class="fa fa-times-circle"></i>
                    {{trans('message.button.no')}}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
