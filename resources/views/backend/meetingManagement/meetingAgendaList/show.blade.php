<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                       {{ getLan() =='np' ? 'बैठक एजेन्डा' : 'Agenda Member' }} {{trans('message.pages.roles.details')}}
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
                            {{trans('meeting.meeting.title')}}
                        </label>
                        @if(isset($data->meeting->title))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->meeting->title}}"
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
                        {{trans('meeting.meeting_agenda_list.title')}}
                        </label>
                        @if(isset($data->title))
                            <input type="textarea"
                                   class="form-control"
                                   value="{{ $data->title}}"
                                   readonly
                            >
                        @else
                            <input type="textarea"
                                   class="form-control"
                                   value="" 
                                   readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                        {{trans('meeting.meeting_agenda_list.description')}}
                        </label>
                        @if(isset($data->description))
                        <textarea class="form-control" rows="4" readonly>{{$data->description}}
                           </textarea>
                        @else
                            <input type="textarea"
                                   class="form-control"
                                   value="" 
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
