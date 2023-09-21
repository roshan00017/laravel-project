<div class="modal fade"
     id="searchModal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    <i class="fa fa-filter"></i>
                    {{trans('message.button.filter')}}
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'get',
                     'url'=>$page_url,
                     'autocomplete'=>'off'])
                !!}
                @if(systemAdmin() == true)
                    <div class="row {{setFont()}}">
                        <div class="form-group col-md-12 {{setFont()}}">
                            {!!Form::select('client_id',   appClientList()->pluck('name','id'),
                                Request::get('client_id'),
                                ['class'=>'form-control select2',
                                'style'=>'width: 100%;','placeholder'=>
                                trans('common.select_local_body')])
                            !!}
                        </div>
                        @endif

                        <div class="form-group col-md-6">
                            {!!Form::select('role_id',
                                    $roleList->pluck('name','id'),
                                    Request::get('role_id'),
                                    ['class'=>'form-control select2 selected',
                                    'style'=>'width: 100%;','placeholder'=>trans('message.pages.role_access.select_user_type')])
                            !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!!Form::select('status',dataStatus(),
                                Request::get('status'),
                                ['class'=>'form-control select2 selected',
                                'style'=>'width: 100%;','placeholder'=>
                                trans('message.pages.users_management.select_user_status')])
                            !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!!Form::email('email',
                                Request::get('email'),
                                ['class'=>'form-control',
                                'autocomplete'=>'off',
                                'width'=>'100%',
                                'placeholder'=>trans('message.pages.users_management.login_email_address')])
                                !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!!Form::text('login_user_name',
                                Request::get('login_user_name'),
                                ['class'=>'form-control',
                                'autocomplete'=>'off',
                                'width'=>'100%',
                                'placeholder'=>trans('message.pages.users_management.login_user_name')])
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
