<div class="modal fade" id="addModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.add') }}
                    <span style="font-size: 14px;"> {{ trans('validation.pages.common.mandatory_field_message') }}
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'post', 'id' => 'addSmsForm', 'url' => $page_url]) !!}

                <div class="row">
                    @if (systemAdmin() == true)
                        <div class="form-group col-md-6 {{ setFont() }}">

                            <label for="inputName">
                                {{ trans('common.local_body') }}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::select('client_id', appClientList()->pluck('name', 'id'), Request::get('client_id'), [
                                'class' => 'form-control select2 clientInfo',
                                'style' => 'width: 100%;',
                                'placeholder' => trans('common.select_local_body'),
                            ]) !!}
                        </div>
                    @endif
                    <div class="form-group col-md-6 {{ setFont() }}">

                        <label for="inputName">
                            {{ trans('common.sms_provider_name') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::select('sms_provider_name', smsServiceProvider(), Request::get('sms_provider_name'), [
                            'class' => 'form-control select2 clientInfo',
                            'style' => 'width: 100%;',
                            'placeholder' => trans('common.select_sms_provider_name'),
                        ]) !!}
                    </div>
                    <div class="form-group col-md-6  {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('common.sms_url') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('sms_url', Request::get('sms_url'), [
                            'class' => 'form-control',
                            'placeholder' => trans('common.sms_url'),
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('sms_token', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6  {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.system_setting.sms_setting.sms_from') }}
                            <span class="text text-danger">
                                *
                            </span>

                        </label>
                        {!! Form::text('sms_from', Request::get('sms_from'), [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.system_setting.sms_setting.sms_from'),
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('sms_from', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-12  {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.system_setting.sms_setting.sms_token') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::textarea('sms_token', null, [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.system_setting.sms_setting.sms_token'),
                            'rows' => '4',
                            'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('sms_token', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    @include('backend.components.commonAddStatus')
                </div>

                <div class="modal-footer justify-content-center {{ setFont() }}">

                    @include('backend.components.buttons.addAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
