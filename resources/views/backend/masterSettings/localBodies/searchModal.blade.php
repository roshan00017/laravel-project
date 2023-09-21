<div class="modal fade" id="searchModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    <i class="fa fa-filter"></i>
                    {{trans('message.button.filter')}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'get',
                'url'=>$page_url,
                'autocomplete'=>'off'])
                !!}
                 <div class="row {{setFont()}}">
                    <div class="form-group col-md-6">
                        {{Form::select('province_code',
                        $provinceList->pluck('name_en','id'),
                        Request::get('province_code'),
                        ['class'=>'form-control select2 select2-danger',
                        'id'=>"province_code",
                         'style'=>'width: 100%',
                        'placeholder'=> trans('localbody.select_province_name')
                        ])
         }}
                    </div>
                <div class="form-group col-md-6">
                    {{Form::select('district_code',
                    $districtList->pluck('name_en','code'),
                    Request::get('district_code'),
                    ['class'=>'form-control select2 select2-danger',
                    'id'=>"district_code",
                    'style'=>'width: 100%',
                    'placeholder'=> trans('localbody.select_district_name')
                    ])
     }}
                </div>
            </div>
                <div class="row {{setFont()}}">
                 <div class="form-group col-md-6">
                        {!!Form::select('status',dataStatus(),
                        Request::get('status'),
                        ['class'=>'form-control select2 selected',
                        'style'=>'width: 100%;','placeholder'=>
                        trans('message.commons.status')])
                        !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!!Form::text('name_en',
                        Request::get('name_en'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('localbody.local_body_name')])
                        !!}
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