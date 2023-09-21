<div class="modal fade"
     id="searchModal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
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
                     'url'=>$page_url,
                     'autocomplete'=>'off','id' => 'searchForm'])
                !!}
                <div class="row {{setFont()}}">
                    @include('backend.components.fiscalYear')
                    @include('backend.components.dateSearchComponent')
                    <div class="form-group col-md-4  {{setFont()}}">
                        {!! Form::text('token_no',Request::get('token_no'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('tokenManagement.tokenNo'),
                                'autocomplete'=>'off',

                                ])
                        !!}
                    </div>
                     <div class="form-group col-md-4 ">
                        {!!Form::select('module_name',   moduleName(),
                               Request::get('module_name'),
                               ['class'=>'form-control select2',
                               'style'=>'width: 100%;','placeholder'=>
                               trans('voiceCallManagement.moduleName')])
                           !!}
                    </div>
                    <div class="form-group col-md-4 ">
                        {!!Form::select('module_service_name',   moduleServiceName(),
                               Request::get('module_service_name'),
                               ['class'=>'form-control select2',
                               'style'=>'width: 100%;','placeholder'=>
                               trans('tokenManagement.service')])
                           !!}
                    </div>
                </div>


            </div>


            <div class="modal-footer justify-content-center {{setFont()}}">
                @include('backend.components.buttons.filterAction')
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>
