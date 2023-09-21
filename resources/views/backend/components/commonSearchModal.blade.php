<div class="modal fade" id="searchModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
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
            <div class="modal-body">

                {!! Form::open(['method'=>'get',
                'url'=>$page_url,
                'autocomplete'=>'off'])
                !!}
                <div class="row {{setFont()}}">
                    <div class="form-group col-md-4">
                        {!!Form::text('name',
                        Request::get('name'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('message.pages.roles.name')])
                        !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!!Form::select('status',dataStatus(),
                        Request::get('status'),
                        ['class'=>'form-control select2',
                        'style'=>'width: 100%;','placeholder'=>
                        trans('message.commons.selectStatus')])
                        !!}
                    </div>
                    @if(@$is_mobile_search == true)
                    <div class="form-group col-md-4">
                        {!!Form::text('mobile_no',
                        Request::get('mobile_no'),
                        ['class'=>'form-control mobileNo',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('teacher.phone_no')])
                        !!}
                    </div>
                    @endif
                    @if(@$is_email_search == true)
                    <div class="form-group col-md-4">
                        {!!Form::email('email',
                        Request::get('email'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('message.pages.users_management.login_email_address')])
                        !!}
                    </div>
                    @endif
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