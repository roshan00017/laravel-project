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

                {!! Form::open(['method' => 'get', 'url' => $page_url, 'autocomplete' => 'off', 'id' => 'searchForm']) !!}


                <div class="row {{ setFont() }}">
                    @include('backend.components.fiscalYear')
                    @include('backend.components.dateSearchComponent')

                    <div class="form-group col-md-4">
                        {!! Form::text('name', Request::get('name'), [
                            'class' => 'form-control',
                            'autocomplete' => 'off',
                            'width' => '100%',
                            'placeholder' => trans('incidentReport.name'),
                        ]) !!}
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::text('mobile', Request::get('mobile'), [
                            'class' => 'form-control',
                            'autocomplete' => 'off',
                            'width' => '100%',
                            'placeholder' => trans('incidentReport.mobile_no'),
                        ]) !!}

                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::text('title', Request::get('title'), [
                            'class' => 'form-control',
                            'autocomplete' => 'off',
                            'width' => '100%',
                            'placeholder' => trans('incidentReport.incident_title'),
                        ]) !!}
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
