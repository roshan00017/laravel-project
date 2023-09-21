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
                        {!!Form::select('fiscal_year_id',fiscalYearList()->pluck('code','id'),
                        Request::get('fiscal_year_id'),
                        ['class'=>'form-control select2',
                        'style'=>'width: 100%;','placeholder'=>
                        trans('dispatchreport.dc_dispatch_book.fiscal_year')])
                        !!}
                    </div>
                   @include('backend.components.dateSearchComponent')
                    <div class="form-group col-md-4">
                        {!!Form::text('dispatch_no',
                        Request::get('dispatch_no'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('dartaKitab.dc_register_book.invoice_no')])
                        !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!!Form::text('regd_no',
                        Request::get('regd_no'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('dartaKitab.dc_register_book.Registration_no')])
                        !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!!Form::text('letter_no',
                        Request::get('letter_no'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('dartaKitab.dc_register_book.letter_no')])
                        !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!!Form::text('letter_sub',
                        Request::get('letter_sub'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('dartaKitab.dc_register_book.subject_of_the_letter')])
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