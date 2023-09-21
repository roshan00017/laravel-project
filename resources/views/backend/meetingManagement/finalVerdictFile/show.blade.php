<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-m">
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
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.meeting_member.meeting_code')}}
                        </label>
                        @if(isset($data->meeting->code))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->meeting->code}}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" 
                                   readonly
                            >

                        @endif
                    </div>

                    
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                            {{trans('meeting.final_verdict.file')}}
                        </label>
                        @if(isset($data->file))
                                @if($data->image !=null)
                                                        <div class="form-group col-md-4 {{setFont()}}">
                                                            <label for="">
                                                                {{ trans('message.pages.users_management.user_image') }}
                                                            </label>
                                                            <br>
                                                            <img src="{{asset('/storage/'.$filePath.'/'.$data->image)}}"
                                                                alt="User"
                                                                class="rounded-pill"
                                                                style="width: 60px; height: 60px"
                                                            >
                                                            <a href="{{URL::to('/storage/'.$filePath.'/'.$data->image)}}"
                                                            target="_blank"
                                                            class="btn btn-secondary btn-xs rounded-pill"
                                                            data-placement="top" title="{{trans('message.pages.common.viewFile')}}"
                                                            style="margin: 10px 0 0 10px;"
                                                            >
                                                                <i class="fa fa-eye"></i>
                                                            </a>

                                                            <a
                                                                    href="javascript:void(0)"
                                                                    style="margin: 10px 0 0 10px;"
                                                                    class="btn btn-danger btn-xs rounded-pill deleteFile"
                                                                    data-id="{{ $data->id }}"
                                                                    data-widget="{{ $page_url }}"
                                                                    title="{{trans('message.pages.common.deleteFile')}}"
                                                            >
                                                                <i class="fa fa-trash">
                                                                </i>
                                                            </a>
                                                        </div>
                                    @endif
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="N/A" 
                                   readonly
                            >

                        @endif
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
