<!DOCTYPE html>
<div class="modal fade" id="addFileModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.add')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                'id'=>'addForm',
                'enctype' => 'multipart/form-data',
                'url'=>'dcDocument'])
                !!}
                <input type="hidden" name="document_no" value="{{$dcRegisterBook->regd_no}}">
                <input type="hidden" name="from_section_id" value="{{$dcRegisterBook->to_branch_id}}">
                <div class="row">
                    <div id="target" class="form-group col-md-12">
                        <label for="level" style="padding-left: 10px">
                            {{trans('dcDocument.dc_document.add_file')}}</label>
                        <div class="input-group control-group increment" style="margin-top:10px; margin-left:10px; margin-bottom:10px; margin-right:10px;">
                            <input type="file" name="soms_doc[]" class="form-control file-upload" data-parsley-max-file-size="42" required>
                            <div class="input-group-btn">
                                <button class="btn btn-success add-edu-cert" type="button" onclick="addNew()"><i class="glyphicon glyphicon-plus"></i>
                                    {{trans('dcDocument.dc_document.add_more')}}
                                </button>
                            </div>
                        </div>
                        <div id="files" class="clone hide del_edu_cert">
                            <div class="control-group input-group" style="margin-top:10px; margin-left:10px; margin-bottom:10px; margin-right:10px;">
                                <input type="file" name="soms_doc[]" class="form-control file-upload" data-parsley-max-file-size="42" required>
                                <div class="input-group-btn">
                                    <button onclick="removeLastElem()" class="btn btn-danger del_edu_cert" type="button"><i class="glyphicon glyphicon-remove"></i>
                                        {{trans('dcDocument.dc_document.remove')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="text text-danger {{setFont()}}" style="font-size: 14px;color: #ff042c">
                        {{trans('dartaKitab.dc_register_book.file_upload_message')}}
                    </span>
                </div>
                <div class="modal-footer justify-content-center {{setFont()}}">
                    @include('backend.components.buttons.addAction')

                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>