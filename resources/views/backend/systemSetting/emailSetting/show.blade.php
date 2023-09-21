@php
    $name = setName();
@endphp
<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    @if(isset($data->school))
                        {{ getLan() =='en' ? $data->school->name_en : $data->school->name_np }}
                    @else
                        {{ getLan() =='en' ? 'System' : 'प्रणाली' }}
                    @endif
                    {{$page_title}}  {{trans('message.pages.roles.details')}}
                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if(systemAdmin() ==true)
                        <div class="form-group col-md-4 {{setFont()}}">
                            <label for="">
                                {{trans('common.local_body')}}

                            </label>
                            @if(isset($data->client))
                                <input type="text"
                                       class="form-control"
                                       value="{{ getLan() =='np' ? $data->client->name_np : $data->client->name_en }}"
                                       readonly
                                >
                            @else
                                <input type="text"
                                       class="form-control"
                                       value="{{ trans('common.system_setting') }}" readonly
                                >

                            @endif
                        </div>
                    @endif

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.system_setting.mail_setting.mail_from_address')}}
                        </label>
                        @if(isset($data->mail_from_address))
                            <input type="text"
                                   class="form-control"
                                   value="{{ $data->mail_from_address }}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.system_setting.mail_setting.mail_driver')}}
                        </label>
                        @if(isset($data->mail_driver))
                            <input type="text"
                                   class="form-control"
                                   value="{{ $data->mail_driver }}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.system_setting.mail_setting.mail_host_name')}}
                        </label>
                        @if(isset($data->mail_host_name))
                            <input type="text"
                                   class="form-control"
                                   value="{{ $data->mail_host_name }}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.system_setting.mail_setting.mail_port_number')}}
                        </label>
                        @if(isset($data->mail_port))
                            <input type="text"
                                   class="form-control"
                                   value="{{ $data->mail_port }}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.system_setting.mail_setting.mail_user_name')}}
                        </label>
                        @if(isset($data->mail_user_name))
                            <input type="text"
                                   class="form-control"
                                   value="{{ $data->mail_user_name }}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.system_setting.mail_setting.mail_password')}}
                        </label>
                        @if(isset($data->mail_password))
                            <input type="text"
                                   class="form-control"
                                   value="{{ $data->mail_password }}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.system_setting.mail_setting.mail_encryption')}}
                        </label>
                        @if(isset($data->mail_encryption))
                            <input type="text"
                                   class="form-control"
                                   value="{{ $data->mail_encryption }}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.commons.status')}}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->status == 1 ? trans('message.button.active') : trans('message.button.inactive') }}"
                               readonly
                        >
                    </div>


                </div>


                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{setFont()}}"
                            data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
