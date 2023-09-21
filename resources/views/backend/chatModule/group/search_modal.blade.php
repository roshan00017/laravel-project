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
                        {!!Form::text('name',
                        Request::get('name'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('chat.group_name')])
                        !!}
                 </div>

                 <div class="form-group col-md-4">
                        {!!Form::text('details',
                        Request::get('details'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('chat.group_description')])
                        !!}
                 </div>

                 <div class="form-group col-md-4">
                        {!!Form::number('total_members',
                        Request::get('total_members'),
                        ['class'=>'form-control',
                        'autocomplete'=>'off',
                        'width'=>'100%',
                        'placeholder'=>trans('chat.total_member')])
                        !!}
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