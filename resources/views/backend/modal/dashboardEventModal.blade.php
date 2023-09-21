<div class="modal fade"
     id="eventModal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{ getLan() == 'np' ? 'ईभेन्ट' : 'Event'  }} {{trans('message.pages.roles.details')}}
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
                            {{trans('notice.title')}}
                        </label>
                        <input type="text"
                               class="form-control rounded-pill"
                               id="title"
                               readonly
                        >
                    </div>


                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{trans('event.start_date')}}
                        </label>
                        <input type="text"
                               class="form-control rounded-pill"
                               id="start_date"
                               readonly
                        >
                    </div>
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="">
                            {{trans('event.end_date')}}
                        </label>
                        <input type="text"
                               class="form-control rounded-pill"
                               id="end_date"
                               readonly
                        >
                    </div>
                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.roles.details')}}
                        </label>
                        <textarea class="form-control" id="details" rows="4" readonly></textarea>
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
