<div class="modal fade"
     id="showHolidayModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{$page_title}}
                    
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
                            {{ trans('calendar.name_np') }}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->name_np }}"
                               readonly
                        >
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{ trans('calendar.name_en') }}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->name_en }}"
                               readonly
                        >
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('calendar.holiday_type') }}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->holiday_type }}"
                               readonly
                        >
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('calendar.holiday_date') }}
                        </label>
                        <input type="text"
                               class="form-control"
                               value="{{ $data->date_np }}"
                               readonly
                        >
                    </div>
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('message.commons.status') }}
                        </label>
                        <input type="text" class="form-control"
                               value="{{ $data->status == 1 ? trans('message.button.active') : trans('message.button.inactive') }}"
                               readonly>
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
                        {{ trans('message.button.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
