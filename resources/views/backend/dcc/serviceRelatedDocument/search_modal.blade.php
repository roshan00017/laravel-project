<div class="modal fade" id="searchModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill {{setFont()}}">
                <h4 class="modal-title">
                    <i class="fa fa-filter"></i>
                    {{trans('message.button.filter')}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'get',
                'url'=>$page_url,
                'autocomplete'=>'off'])
                !!}
                <div class="row {{setFont()}}">
             
                <div class="form-group col-md-4">
                        {{ Form::select('service_type_id',
                                           $serviceType->pluck('name','id'),
                                           Request::get('service_type_id'),
                                            ['class'=>'form-control select2',
                                           'style'=>'width: 100%',
                                           'placeholder'=> trans('service_related_document.common.service_type')
                                          ])
                          }}
                    </div>
                    <div class="form-group col-md-4">
                        {{ Form::select('service_id',
                                           $services->pluck('name','id'),
                                           Request::get('service_id'),
                                            ['class'=>'form-control select2',
                                           'style'=>'width: 100%',
                                           'placeholder'=> trans('service_related_document.common.service')
                                          ])
                          }}
                    </div>
                    <div class="form-group col-md-4">
                        {{ Form::select('department_id',
                                           $department->pluck('name','id'),
                                           Request::get('department_id'),
                                            ['class'=>'form-control select2',
                                           'style'=>'width: 100%',
                                           'placeholder'=> trans('service_related_document.common.department')
                                          ])
                          }}
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