<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    @if(isset($data->client))
                        {{ getLan() =='np' ? $data->client->name_np : $data->client->name_en }}
                    @else
                        {{ trans('common.system_setting') }}

                    @endif
                        {{trans('message.pages.roles.details')}}
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
                    <div class="form-group col-md-6 {{setFont()}}">
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

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.system_setting.otp_setting.otp_limit')}}
                        </label>
                        @if(isset($data->otp_limit))
                            <input type="text"
                                   class="form-control"
                                   value="{{ $data->otp_limit }}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.system_setting.otp_setting.otp_duration')}}
                        </label>
                        @if(isset($data->otp_duration))
                            <input type="text"
                                   class="form-control"
                                   value="{{ $data->otp_duration }}"
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
