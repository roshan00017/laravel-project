<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                       {{ getLan() =='np' ? 'बैठक सदस्य' : 'Meeting Member' }} {{trans('message.pages.roles.details')}}
                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.meeting_member.meeting_code')}}
                        </label>
                        @if(isset($data->meeting->code))
                            <input type="text"
                                   class="form-control"
                                   value="{{  $data->meeting->code }}"
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
                            {{ trans('message.pages.common.name_en') }}
                        </label>
                        @if(isset($data->name_en))
                            <input type="text"
                                   class="form-control"
                                   value="{{ getLan() == 'en' ? $data->name_en : $data->name_np  }}"
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
                            {{ trans('message.pages.meeting_member.office') }}
                        </label>
                        @if(isset($data->office))
                            <input type="text"
                                   class="form-control"
                                   value="{{  $data->office  }}"
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
                            {{ trans('message.pages.common.designation') }}
                        </label>
                        @if(isset($data->post))
                            <input type="text"
                                   class="form-control"
                                   value="{{  $data->post  }}"
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
                            {{ trans('message.pages.meeting_member.contact_no') }}
                        </label>
                        @if(isset($data->contact_no))
                            <input type="text"
                                   class="form-control"
                                   value="{{  $data->contact_no  }}"
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
                            {{ trans('message.pages.meeting_member.email') }}
                        </label>
                        @if(isset($data->email))
                            <input type="text"
                                   class="form-control"
                                   value="{{  $data->email  }}"
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
                            {{trans('message.commons.invite')}}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->status == 1 ? trans('message.button.yes') : trans('message.button.no') }}"
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
