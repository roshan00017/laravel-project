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

                    <div class="form-group col-md-6">
                        {!! Form::text('phone_number', Request::get('mobile_no'), [
                            'class' => 'form-control mobileNo',
                            'autocomplete' => 'off',
                            'width' => '100%',
                            'placeholder' => trans('employee.phone'),
                        ]) !!}
                    </div>


                    <div class="form-group col-md-6">
                        {!! Form::email('email', Request::get('email'), [
                            'class' => 'form-control',
                            'autocomplete' => 'off',
                            'width' => '100%',
                            'placeholder' => trans('employee.email'),
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
