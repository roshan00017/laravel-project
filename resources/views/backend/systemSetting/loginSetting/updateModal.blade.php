<div class="modal fade"
     id="editModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.edit')}}
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                                                    <span aria-hidden="true"
                                                          data-toggle="tooltip"
                                                          title="Close"
                                                    >&times;
                                                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($result,['method'=>'PUT',
                        'route'=>[$page_route.'.'.'update',$result['id']],
                        'enctype'=>'multipart/form-data',
                        'autocomplete'=>'off'])
                !!}
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>
                            {{trans('message.pages.system_setting.login_setting.login_title')}} [ English]
                        </label>
                        <label class="text text-danger">
                            *
                        </label>
                        {!! Form::text('login_title',null,
                                ['class'=>'form-control',
                                'required','min'=>'1'])
                        !!}
                        {!! $errors->first('login_title', '<span class="text text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-12">
                        <label>
                            {{trans('message.pages.system_setting.login_setting.login_title')}} [Nepali]
                        </label>
                        <label class="text text-danger">
                            *
                        </label>
                        {!! Form::text('login_title_np',null,
                                ['class'=>'form-control',
                                'required','min'=>'1'])
                        !!}
                        {!! $errors->first('login_title_np', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="status">
                            {{trans('message.pages.system_setting.login_setting.captcha_required')}}
                        </label>
                        <br>
                        <div class="icheck-success d-inline">
                            <input type="radio"
                                   id="readio1"
                                   name="login_captcha_required"
                                   value="1"
                                   @if($result['login_captcha_required']=='1') checked @endif
                            >
                            <label for="readio1">
                                {{trans('message.button.yes')}}
                            </label>
                        </div>

                        &nbsp; &nbsp;
                        <div class="icheck-success d-inline">
                            <input type="radio"
                                   id="readio2"
                                   name="login_captcha_required"
                                   value="0"
                                   @if($result['login_captcha_required']=='0') checked @endif
                            >
                            <label for="readio2">
                                {{trans('message.button.no')}}
                            </label>
                        </div>

                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="status">
                            {{trans('message.pages.system_setting.login_setting.forgot_password_required')}}
                        </label>
                        <br>
                        <div class="icheck-primary d-inline">
                            <input type="radio"
                                   id="readio3"
                                   name="forget_password_required"
                                   value="1"
                                   @if($result['forget_password_required']=='1') checked @endif
                            >
                            <label for="readio3">
                                {{trans('message.button.yes')}}
                            </label>
                        </div>

                        &nbsp; &nbsp;
                        <div class="icheck-primary d-inline">
                            <input type="radio"
                                   id="readio4"
                                   name="forget_password_required"
                                   value="0"
                                   @if($result['forget_password_required']=='0') checked @endif
                            >
                            <label for="readio4">
                                {{trans('message.button.no')}}
                            </label>
                        </div>

                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="status">
                            {{trans('message.pages.system_setting.login_setting.login_attempt_limit')}}
                        </label>
                        <br>
                        <input class="radio-button"
                               type="radio"
                               name="login_attempt_required"
                               onclick="attemptYes();"
                               value="1"
                               style="margin-top: 2px"
                               @if($result['login_attempt_required']=='1') checked @endif
                        >
                        {{trans('message.button.yes')}}
                        &nbsp; &nbsp;
                        <input class="radio-button"
                               type="radio"
                               name="login_attempt_required"
                               onclick="attemptNo()"
                               value="0" style="margin-top: 2px"
                               @if($result['login_attempt_required']=='0') checked @endif
                        >
                        {{trans('message.button.no')}}


                    </div>
                    <div class="form-group col-md-6"
                         style="@if($result['login_attempt_required']=='1') display: block @else display: none @endif "
                         id="loginAttempt"
                    >
                        <label>
                            {{trans('message.pages.system_setting.login_setting.login_attempt_limit')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::number('login_attempt_limit',null,
                                    ['class'=>'form-control',
                                    'required','min'=>'1'])
                         !!}
                        {!! $errors->first('login_attempt_limit', '<span class="text text-danger">:message</span>') !!}
                    </div>
                </div>

                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.updateAction')
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
