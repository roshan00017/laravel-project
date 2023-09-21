<div class="modal fade" id="showModal{{$key}}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('meeting.meeting.page_title')}} {{trans('message.pages.common.code')}} {{ $data->code }}
                    {{ getLan() =='np' ? 'को ' :'' }} {{ trans('message.pages.roles.details') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        <input type="text" class="form-control"
                            value="{{ getLan() =='np' ? $data->client->name_np : $data->client->name_en }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    @endif
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('meeting.meeting.meeting_category')}}
                        </label>
                        @if(isset($data->category))
                        <input type="text" class="form-control"
                            value="{{ getLan() =='np' ? $data->category->name_np : $data->category->name_en }}"
                            readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.common.code')}}
                        </label>
                        @if(isset($data->code))
                        <input type="text" class="form-control" value="{{ $data->code}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    @if(getLan() =='np')
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.proposed_date_bs') }}
                        </label>
                        @if(isset($data->proposed_date_bs))
                        <input type="text" class="form-control" value="{{  $data->proposed_date_bs  }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                        @if ($errors->has('proposed_date_bs'))
                        <!-- Check if there is an error message for 'proposed_date_bs' field -->
                        <small class="text text-danger">{{ $errors->first('proposed_date_bs') }}</small>
                        <!-- Display the error message -->
                        @endif
                        <input type="hidden" name='proposed_date_ad' id="proposed_date_ad">
                    </div>
                    @endif
                    @if(getLan() =='en')
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.proposed_date_ad') }}
                        </label>
                        @if(isset($data->proposed_date_ad))
                        <input type="text" class="form-control" value="{{  $data->proposed_date_ad  }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                        {!! $errors->first('proposed_date_ad', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <input type="hidden" name='proposed_date_bs' id="proposed_date_bs">
                    @endif
                    @if(getLan() =='np')
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.meeting_date_bs') }}
                        </label>
                        @if(isset($data->meeting_date_bs))
                        <input type="text" class="form-control" value="{{  $data->meeting_date_bs  }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                        <input type="hidden" name='meeting_date_ad' id="meeting_date_ad">
                    </div>
                    @endif
                    @if(getLan() =='en')
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.meeting_date_ad') }}
                        </label>
                        @if(isset($data->meeting_date_ad))
                        <input type="text" class="form-control" value="{{  $data->meeting_date_ad  }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>
                    <input type="hidden" name='proposed_date_ad' id="proposed_date_ad">
                    @endif

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.time') }}
                        </label>
                        @if(isset($data->meeting_time))
                        <input type="text" class="form-control"
                            value="{{ \Carbon\Carbon::parse($data->meeting_time)->format('g:i A') }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.meeting_venue') }}
                        </label>
                        @if(isset($data->meeting_venue))
                        <input type="text" class="form-control" value="{{$data->meeting_venue}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.agendaFinalized') }}
                        </label>
                        @php
                        if($data->agenda_finalized == 1)
                        {
                        $status = trans('message.button.yes');
                        }else{
                        $status = trans('message.button.no');
                        }
                        @endphp
                        @if(isset($data->proposed_date_bs))
                        <input type="text" class="form-control" value="{{  $status  }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.title') }}
                        </label>
                        @if(isset($data->title))
                        <input type="text" class="form-control" value="{{$data->title}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>


                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.meeting_status') }}
                        </label>
                        <br>
                        @if($data->meeting_status_id == 1)
                        <button type="button" class="btn btn-warning btn-xs rounded-pill {{setFont()}}"
                            title="{{trans('message.button.invite_update')}}">
                            {{trans('meeting.status.pending')}}
                        </button>
                        @elseif($data->meeting_status_id == 2)
                        <button type="button" class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                            title="{{trans('message.button.invite_update')}}">
                            {{trans('meeting.status.canceled')}}
                        </button>
                        @elseif($data->meeting_status_id == 3)
                        <button type="button" class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                            title="{{trans('message.button.invite_update')}}">
                            {{trans('meeting.status.postponed')}}
                        </button>
                        @elseif($data->meeting_status_id == 4)
                        <button type="button" class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                            title="{{trans('message.button.invite_update')}}">
                            {{trans('meeting.status.preponed')}}
                        </button>
                        @elseif($data->meeting_status_id == 5)
                        <button type="button" class="btn btn-success btn-xs rounded-pill {{setFont()}}"
                            title="{{trans('message.button.invite_update')}}">
                            {{trans('meeting.status.execute')}}
                        </button>
                        @endif
                    </div>
                    <div class="form-group col-md-3 {{setFont()}}">
                        <label for="inputDescription">
                            {{trans('meeting.meeting.meeting_mode')}}
                        </label>
                        <br>
                        <input class="radio-button" type="radio" @if($data->meeting_mode =='offline') checked @else
                        disabled @endif
                        >
                        {{ trans('meeting.meeting.offline') }}

                        <input class="radio-button" type="radio" name="mode" style="margin-top: 2px"
                            @if($data->meeting_mode =='online') checked @else disabled @endif
                        >
                        {{ trans('meeting.meeting.online') }}
                    </div>


                    @if($data->meeting_mode =='online' && $data->meeting_status_id != 5)
                    <div class="form-group col-md-6 {{setFont()}} ">
                        <label for="inputName">
                            {{trans('meeting.meeting.meeting_url')}}
                        </label>
                        <input type="text" class="form-control" value="{{$data->meeting_url}}" readonly>
                    </div>
                    <div class="form-group col-md-2 {{setFont()}} ">
                        <br>
                        <a href="{{$data->meeting_url}}" target="_blank" class="btn btn-sm btn-primary rounded-pill"
                            style="margin-top: 10px">Join Now</a>
                    </div>
                    @endif

                    @if($data->meeting_mode =='online')
                    <div class="form-group col-md-3 {{setFont()}}">
                        <label for="inputDescription">
                            {{ trans('meeting.meeting.meeting_password_gen') }}
                        </label>
                        <br>
                        <input class="radio-button" type="radio" @if($data->meeting_password_available ==true) checked
                        @else disabled @endif
                        >
                        {{ trans('meeting.meeting.yes') }}

                        <input class="radio-button" type="radio" style="margin-top: 2px"
                            @if($data->meeting_password_available ==false) checked @else disabled @endif
                        >
                        {{ trans('meeting.meeting.no') }}
                    </div>

                    @endif
                    @if($data->meeting_password_available ==true)
                    <div class="form-group col-md-3 {{setFont()}}">
                        <label for="inputDescription">
                            {{ trans('meeting.meeting.password') }}
                        </label>
                        <br>
                        <input class="form-control" type="text" readonly value="{{$data->meeting_password}}">
                    </div>

                    @endif
                    <div class="form-group col-md-3 {{setFont()}}">
                        <label for="inputDescription">
                            {{ trans('meeting.meeting.meeting_public') }}
                        </label>
                        <br>
                        <input class="radio-button" type="radio" @if($data->is_public ==true) checked @else disabled
                        @endif
                        >
                        {{ trans('meeting.meeting.yes') }}

                        <input class="radio-button" type="radio" style="margin-top: 2px" @if($data->is_public ==false)
                        checked @else disabled @endif
                        >
                        {{ trans('meeting.meeting.no') }}
                    </div>


                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                            {{ trans('meeting.meeting.description') }}
                        </label>
                        @if(isset($data->description))

                        <textarea class="form-control" rows="4" readonly>{{$data->description}}
                           </textarea>
                        @else
                        <input type="textarea" class="form-control" value="" readonly>

                        @endif
                    </div>
                    @php
                    $audioFileInfo = $meetingRepo->getAudioFileByMeeting($data->code);
                    @endphp
                    @if(isset($audioFileInfo))
                    <div class="form-group col-md-12 {{setFont()}}">
                        एजेन्डा अडियो फाइल
                        <audio controls>
                            <source src="{{@$audioFileInfo->audio_file}}" type="audio/mpeg">
                        </audio>
                    </div>
                    @endif

                    <div class="form-group col-md-3 {{setFont()}}">
                        @if($data->meeting_status_id ==2 || $data->meeting_status_id ==5 )
                        <button class="btn btn-secondary btn-sm rounded-pill" data-toggle="modal"
                            data-target="#agendaListModal{{ $key }}" data-placement="top"
                            title="{{ trans('message.button.show') }}" data-dismiss="modal">
                            <i class="fa fa-eye"></i>
                            {{trans('meeting.meeting.view_agenda_list')}}

                        </button>
                        @else
                            <a href="{{url('/agendaDetailsByMeeting/'.hashIdGenerate($data->id))}}"
                               class="btn btn-secondary btn-sm rounded-pill {{ setFont() }}"
                               title="{{ trans('message.button.show') }}">
                                <i class="fa fa-eye"></i>
                                {{trans('meeting.meeting.view_agenda_list')}}
                            </a>

                        @endif
                    </div>

                    <div class="form-group col-md-3 {{setFont()}}">
                        @if($data->meeting_status_id ==2 || $data->meeting_status_id ==5 )
                            <button class="btn btn-secondary btn-sm rounded-pill" data-toggle="modal"
                                    data-target="#memberListModal{{ $key }}" data-placement="top"
                                    title="{{ trans('meeting.meeting.view_member_list') }}" data-dismiss="modal">
                                <i class="fa fa-eye"></i>
                                {{trans('meeting.meeting.view_member_list')}}

                            </button>
                        @else
                            <a href="{{url('/memberDetailsByMeeting/'.hashIdGenerate($data->id))}}"
                               class="btn btn-secondary btn-sm rounded-pill {{ setFont() }}"
                               title="{{ trans('message.button.show') }}">
                                <i class="fa fa-eye"></i>
                                {{trans('meeting.meeting.view_member_list')}}
                            </a>

                        @endif
                    </div>
                        
                    @if($data->campaign_id !=null)
                    <div class="form-group col-md-3 {{setFont()}}">
                        <a href="{{route('phoneSmsManagement.show', hashIdGenerate( $data->campaign_id))}}"
                            class="btn btn-secondary btn-sm rounded-pill {{setFont()}}"
                            title="{{trans('message.button.show')}}">
                            <i class="fas fa-eye"></i>
                            {{ getLan() =='np' ? 'Campaign विवरण हेर्नुहोस' : 'Campaign Details' }}
                        </a>


                    </div>
                    @endif

                </div>


                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{setFont()}}" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.meetingManagement.meeting.agendaDetails.agendaListModal')
@include('backend.meetingManagement.meeting.memberDetails.membersListModal')
@include('backend.meetingManagement.meeting.verdictDetails.finalVerdictListModal')