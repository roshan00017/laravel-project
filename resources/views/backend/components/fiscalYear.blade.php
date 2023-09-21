<div class="form-group col-md-4">
    {!!Form::select('fy_id',fiscalYearList()->pluck('code','id'),
    Request::get('fy_id'),
    ['class'=>'form-control select2',
    'style'=>'width: 100%;','placeholder'=>
    trans('dispatchreport.dc_dispatch_book.fiscal_year')])
    !!}
</div>