<div class="modal fade" id="addModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.add') }}
                    <span style="font-size: 14px;"> {{ trans('validation.pages.common.mandatory_field_message') }}
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'post', 'id' => 'addForm', 'url' => 'basicDetails/privacyPolicies']) !!}
                <div class="row">

                    <div class="form-group col-md-12 {{ setFont() }}">
                        <label>
                            {{ trans('privacyPolicy.title') }}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                        {!! $errors->first('title', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-12 {{ setFont() }}">
                        <label>
                            {{ trans('privacyPolicy.content') }}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('content', null, ['class' => 'form-control', 'required']) !!}
                        {!! $errors->first('content', '<span class="text text-danger">:message</span>') !!}
                    </div>

                </div>

                <div class="modal-footer justify-content-center {{ setFont() }}">
                    @include('backend.components.buttons.addAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
