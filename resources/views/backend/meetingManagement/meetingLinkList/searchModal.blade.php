<div class="modal fade" id="searchModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill {{ setFont() }}">
                <h4 class="modal-title">
                    <i class="fa fa-filter"></i>
                    {{ trans('message.button.filter') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method' => 'get', 'url' => $page_url, 'autocomplete' => 'off']) !!}


                <div class="row {{ setFont() }}">
                    @include('backend.components.fiscalYear')
                    <div class="form-group col-md-4">
                        {!!Form::text('from_date',
                                   Request::get('from_date'),
                                   ['class'=>'form-control' .' ' .setDatePicker()['dateClass'],
                                   'id'=>setDatePicker()['from_date'],
                                   'autocomplete'=>'off',
                                   'width'=>'100%','placeholder'=> trans('message.commons.from_date')])
                           !!}
                    </div>

                    <div class="form-group col-md-4">
                        {!!Form::text('to_date',
                              Request::get('to_date'),['class'=>'form-control' .' ' .setDatePicker()['dateClass'],
                              'id'=>setDatePicker()['to_date'],
                              'autocomplete'=>'off',
                              'width'=>'100%','placeholder' =>trans('message.commons.to_date')])
                      !!}
                    </div>
                    <div class="form-group col-md-4 {{ setFont() }}">
                        {{ Form::select('code', $meetingCodeList->pluck('code', 'code'), Request::get('code'), [
                            'class' => 'form-control select2',

                            'style' => 'width: 100%',
                            'placeholder' => trans('meeting.common.select_code'),
                        ]) }}

                        {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!!Form::text('title',
                        Request::get('title'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('meeting.meeting.title')])
                        !!}
                    </div>

                </div>


                <div class="modal-footer justify-content-center {{ setFont() }}">
                    @include('backend.components.buttons.filterAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>