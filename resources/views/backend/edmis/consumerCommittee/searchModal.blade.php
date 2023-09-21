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
                        {!! Form::text('regd_no', Request::get('regd_no'), [
                        'class' => 'form-control',
                        'placeholder' => trans('consumerCommittee.consumer.regd_no'),
                        'autocomplete' => 'off',
                        'width'=>'100%',
                        ]) !!}
                    </div>

                    @include('backend.components.dateSearchComponent')

                    <div class="form-group col-md-4">
                        {!! Form::text('email', Request::get('email'), [
                        'class' => 'form-control',
                        'placeholder' => trans('consumerCommittee.consumer.email'),
                        'autocomplete' => 'off',
                        'width'=>'100%',
                        ]) !!}
                    </div>


                    <div class="form-group col-md-4">
                        {!! Form::text('contact_person_phone', Request::get('contact_person_phone'), [
                        'class' => 'form-control',
                        'placeholder' => trans('consumerCommittee.consumer.phone'),
                        'autocomplete' => 'off',
                        'width'=>'100%',
                        ]) !!}
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