<div class="modal fade"
     id="deleteFileModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}"> {{trans('message.pages.common.app_short_name')}}</h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::model($result,['method'=>'DELETE',
                'route'=>[$page_route.'.'.'destroy',$result['id']]])
             !!}
            <div class="modal-body text-center">
                <input type="hidden"
                       name="column_name"
                       value="app_logo"
                >
                <p class="{{setFont()}}">
                    {{trans('message.pages.system_setting.app_setting.are_you_sure_you_want_to_delete_logo')}}
                </p>
            </div>
            <div class="modal-footer justify-content-center {{setFont()}}">
                <button type="submit"
                        class="btn btn-primary rounded-pill"
                >
                    <i class="fa fa-check-circle"></i>
                    {{trans('message.button.yes')}}
                </button> &nbsp; &nbsp;
                <button type="button"
                        class="btn btn-danger rounded-pill"
                        data-dismiss="modal"
                >
                    <i class="fa fa-times-circle"></i>
                    {{trans('message.button.no')}}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
