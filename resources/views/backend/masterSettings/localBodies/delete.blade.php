<div class="modal fade"
     id="deleteModal{{$key}}"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog {{getLan() =='np' ? 'modal-dialog-centered': 'modal-sm modal-dialog-centered'}}">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    @if(systemSetting())
                        {{getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
                    @else
                        {{trans('message.pages.common.app_short_name')}}
                    @endif
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php
                $teacherId = $data->teacher_id;
                $studentId = @$data->student_id;
                $parentId = @$data->parent_id;
                if(isset($teacherId)){
                    $id = $teacherId;
                }elseif(isset($studentId)){
                     $id = $studentId;
                }elseif(isset($parentId)){
                     $id = $parentId;
                }else{
                     $id = $data->id;
                }

            @endphp
            {!! Form::open(['method' => 'DELETE',
                    'route'=>['localBodies.destroy',$id]])
            !!}

            <div class="modal-body">
                <h5 class="{{setFont()}}">
                    {{trans('message.commons.are_you_sure_you_want_to_delete')}}
                </h5>
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
</div>
