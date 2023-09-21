<div class="modal fade"
     id="importModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog  modal-dialog-centered">
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

            <div class="modal-body">

                {!! Form::open(['method' => 'POST',
                        'enctype'=>'multipart/form-data',
                        //'id'=>'uploadForm',
                        'url'=>[$page_url.'/'.'importData']])
                !!}
                <div class="row">

                    <label class="{{setFont()}}">
                        {{trans('message.button.file')}}
                    </label>
                    @if(@$page_route =='schools')
                        <a href="{{asset('importFileTemplate/School Import Data Format Template.xlsx')}}"
                           download
                           class="text fa-pull-right text-primary {{setFont()}}"
                           data-placement="top"
                           title="{{trans('school.excel_template')}}{{trans('message.pages.common.viewFile')}}"
                           style="margin-left:30px"
                        >
                            <i class="fa fa-download"></i>
                            {{trans('school.excel_template')}}
                        </a>
                    @endif

                    @if(@$page_route =='students')
                        <a href="{{asset('importFileTemplate/Student Import Format Template.xlsx')}}"
                           download
                           class="text fa-pull-right text-primary {{setFont()}}"
                           data-placement="top"
                           title="{{trans('student.excel_template')}}{{trans('message.pages.common.viewFile')}}"
                           style="margin-left:30px"
                        >
                            <i class="fa fa-download"></i>
                            {{trans('student.excel_template')}}
                        </a>
                    @endif
                    @if(@$page_route =='teachers')
                        <a href="{{asset('importFileTemplate/Teacher Import Format Template.xlsx')}}"
                           download
                           class="text fa-pull-right text-primary {{setFont()}}"
                           data-placement="top"
                           title="{{trans('teacher.excel_template')}}{{trans('message.pages.common.viewFile')}}"
                           style="margin-left:30px"
                        >
                            <i class="fa fa-download"></i>
                            {{trans('teacher.excel_template')}}
                        </a>
                    @endif

                    @if(@$page_route =='parents')
                        <a href="{{asset('importFileTemplate/Parent Import Format Template.xlsx')}}"
                           download
                           class="text fa-pull-right text-primary {{setFont()}}"
                           data-placement="top"
                           title="{{trans('parent.excel_template')}}{{trans('message.pages.common.viewFile')}}"
                           style="margin-left:30px"
                        >
                            <i class="fa fa-download"></i>
                            {{trans('parent.excel_template')}}
                        </a>
                    @endif
                    <input type="file"
                           name="file"
                           required
                           class="form-control-file file-type"
                    >
                    {!! $errors->first('file', '<span class="text text-danger">:message</span>') !!}

                    @if($errors->has('file') == null)
                        <span class="text text-danger {{setFont()}}"
                              style="font-size: 14px;color: #ff042c; margin-top: 12px"
                        >
                              {{trans('message.pages.common.fileMessage')}}
                            </span>
                    @endif
                </div>
            </div>
            <div class="modal-footer justify-content-center {{setFont()}}">
                <button type="submit"
                        class="btn btn-success rounded-pill"
                >
                    <i class="fa fa-upload"></i>
                    {{trans('message.button.import_data')}}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>
