<div class="modal fade"
     id="searchModal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill {{setFont()}}">
                <h4 class="modal-title">
                    <i class="fa fa-filter"></i>
                    {{trans('message.button.filter')}}
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'get',
                     'url'=>$page_url.'/'.hashIdGenerate($campaignDetails->id),
                     'autocomplete'=>'off','id' => 'searchForm'])
                !!}
                <div class="row {{setFont()}}">

                    <div class="form-group col-md-12  {{setFont()}}">
                        {!! Form::text('number',Request::get('number'),
                                ['class'=>'form-control mobileNo',
                                'placeholder'=>trans('voiceCallManagement.mobileNo'),
                                'autocomplete'=>'off',
                                 'required'
                                ])
                        !!}
                    </div>
                </div>


            </div>


            <div class="modal-footer justify-content-center {{setFont()}}">
                <button type="submit" id="btn-search" class="btn btn-info  rounded-pill">
                    <i class="fa fa-search"></i>
                    {{ trans('message.button.filter') }}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

