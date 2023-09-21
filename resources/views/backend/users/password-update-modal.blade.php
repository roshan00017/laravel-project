<div class="modal fade" id="passwordUpdateModal" data-keyboard="false"
     data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{ trans('message.pages.users_management.password') }}  {{trans('message.commons.edit')}}
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="" class="{{setFont()}}">  {{ trans('message.pages.users_management.password') }}</label>
                            <button class="btn btn-primary btn-xs" id="btn">Generate</button>
                            <button  class="btn btn-secondary btn-xs" id="btncp">Copy</button>
                            <br>
                            {!! Form::open(['method'=>'post',
                                               'url'=>'updatePassword'])
                                       !!}
                            <input type="hidden" name="user_id" value="{{$data->id}}">
                            {!! Form::text('password',null,['class'=>'form-control','id'=>'new_password','required','readonly']) !!}
                        </div>



                        <div class="modal-footer justify-content-center {{setFont()}}">


                            @include('backend.components.buttons.updateAction')
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>