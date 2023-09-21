
<div class="modal fade" id="editModal{{ $key }}" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.edit') }}
                    <span style="font-size: 14px"> {{ trans('validation.pages.common.mandatory_field_message') }} </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($data, ['method' => 'PUT', 'route' => [$page_route . '.' . 'update', $data->id]]) !!}
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
                    <div class="modal-footer justify-content-center {{ setFont() }}">

                        @include('backend.components.buttons.updateAction')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
