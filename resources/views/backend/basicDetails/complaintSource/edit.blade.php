<div class="modal fade" id="editModal{{ $key }}" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('message.commons.edit') }}
                    <span style="font-size: 14px;"> {{ trans('validation.pages.common.mandatory_field_message') }}
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::model($data, [
                    'method' => 'PUT',
                    'route' => ['complaintSource.update', $data->id],
                    'enctype' => 'multipart/form-data',
                    'autocomplete' => 'off',
                ]) !!}
                <div class="row">


                    <div class="form-group col-md-6  {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('message.pages.common.code') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('code', Request::get('code'), [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.common.code'),
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                    </div>



                    <div class="form-group col-md-12  {{ setFont() }}">
                        <label for="inputFeedback">
                            {{ trans('complaintSource.name') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name', Request::get('name'), [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.common.name_np'),
                            'rows' => '4',
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-12  {{ setFont() }}">
                        <label for="inputFeedback">
                            {{ trans('complaintSource.name_en') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('name_ne', Request::get('name_ne'), [
                            'class' => 'form-control',
                            'placeholder' => trans('message.pages.common.name_en'),
                            'rows' => '4',
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('name_ne', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-12  {{ setFont() }}">
                        <label for="inputFeedback">
                            {{ trans('complaintSource.depth') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('depth', Request::get('depth'), [
                            'class' => 'form-control',
                            'placeholder' => trans('complaintSource.depth'),
                            'rows' => '4',
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('depth', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-12  {{ setFont() }}">
                        <label for="inputFeedback">
                            {{ trans('complaintSource.social_media_link') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('social_media_link', Request::get('social_media_link'), [
                            'class' => 'form-control',
                            'placeholder' => trans('complaintSource.social_media_link'),
                            'rows' => '4',
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}
                        {!! $errors->first('social_media_link', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    @include('backend.components.commonEditStatus')
                </div>

                <div class="modal-footer justify-content-center {{ setFont() }}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>
