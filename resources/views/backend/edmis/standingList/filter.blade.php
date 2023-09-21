<div class="modal fade" id="filterStandingListModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill {{setFont()}}">
                <h4 class="modal-title">
                    <i class="fa fa-filter"></i>
                    {{trans('message.button.filter')}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left">
                {!! Form::open(['method'=>'get', 'url'=>$page_url, 'autocomplete'=>'off']) !!}
                <div class="row {{setFont()}}">
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="from_date">{{ trans('calendar.from_date') }}</label>
                        {!! Form::text('from_date', Request::get('from_date'), [
                            'class' => 'form-control nepaliDatePicker',
                            'id' => 'from_date',
                            'autocomplete' => 'off',
                            'width' => '100%',
                            'placeholder' => trans('calendar.from_date')
                        ]) !!}
                    </div>

                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="to_date">{{ trans('calendar.to_date') }}</label>
                        {!! Form::text('to_date', Request::get('to_date'), [
                            'class' => 'form-control nepaliDatePicker',
                            'id' => 'to_date',
                            'autocomplete' => 'off',
                            'width' => '100%',
                            'placeholder' => trans('calendar.to_date')
                        ]) !!}
                    </div>


                    <div class="form-group col-md-6">
                        {!!Form::text('type',
                        Request::get('type'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('message.pages.common.type')])
                        !!}
                    </div>

                    <div class="form-group col-md-6">
                        {!!Form::text('organization',
                        Request::get('organization'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('message.pages.common.organization')])
                        !!}
                    </div>


                <div class=" justify-content-center {{setFont()}}">
                    <button type="submit" class="btn btn-primary rounded-pill {{setFont()}}">
                        {{ trans('message.button.filter') }}
                    </button>
                    <button type="button" class="btn btn-danger rounded-pill {{setFont()}}" data-dismiss="modal">
                        {{ trans('message.button.cancel') }}
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
