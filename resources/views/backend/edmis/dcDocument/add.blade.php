<div class="modal fade" id="addModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                'url'=>'edmis/dcDocument'])
                !!}
                <div class="row">

                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.code')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('code',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('code', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.document_no')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('document_no.dc_document',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('document_no', '<span class="text text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.document_type_id')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('document_type_id',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('document_type_id', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.to_section_id')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('to_section_id',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('to_section_id', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.from_section_id')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('from_section_id',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('from_section_id', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.filepath')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('filepath',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('filepath', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.employee_id')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('employee_id',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('employee_id', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.file_status_id')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('file_status_id',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('file_status_id', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.client_id')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('client_id',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('client_id', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.remarks')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('remarks',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('remarks', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            {{trans('dcDocument.dc_document.ward_no')}}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('ward_no',null,
                        ['class'=>'form-control','required'])
                        !!}
                        {!! $errors->first('ward_no', '<span class="text text-danger">:message</span>') !!}
                    </div>


                    <div class="form-group col-6 {{setFont()}}">
                        <label for="status">
                            {{trans('message.commons.status')}}
                        </label>
                        <br>
                        <div class="icheck-success d-inline">
                            <input type="radio" id="readio3" name="status" value="1" checked>
                            <label for="readio3">
                                {{trans('message.button.active')}}
                            </label>
                        </div>
                        &nbsp; &nbsp;
                        <div class="icheck-success d-inline">
                            <input type="radio" id="readio4" name="status" value="0">
                            <label for="readio4">
                                {{trans('message.button.inactive')}}
                            </label>
                        </div>
                    </div>


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