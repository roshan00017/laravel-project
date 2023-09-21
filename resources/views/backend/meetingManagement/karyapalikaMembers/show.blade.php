<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                       {{getLan() == 'np' ? 'कार्यपालिका सदस्य' : 'Karyapalika Members'}} {{trans('message.pages.roles.details')}}
                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.common.name_np') }}
                        </label>
                        @if(isset($data->name_np))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->name_np}}"
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

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.common.name_en') }}
                        </label>
                        @if(isset($data->name_en))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->name_en}}"
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

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.common.designation') }}
                        </label>
                        @if(isset($data->designation))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->designation}}"
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

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.meeting_member.email') }}
                        </label>
                        @if(isset($data->email))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->email}}"
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

                    
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.meeting_member.contact_no') }}
                        </label>
                        @if(isset($data->mobile))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->mobile}}"
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

                            
                        </div>
                    @endif

                    

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
