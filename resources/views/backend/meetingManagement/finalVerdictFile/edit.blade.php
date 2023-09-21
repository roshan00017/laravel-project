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
                    'route' => ['finalVerdictFile.update', $data->id],
                    'enctype' => 'multipart/form-data',
                    'autocomplete' => 'off',
                ]) !!}
                <div class="row">


                    <div class="form-group col-md-6  {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('meeting.common.meeting_code') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::select('meeting_id', $meetingList->pluck('code', 'id'), Request::get('meeting_id'), [
                            'class' => 'form-control select2',
                            'required',
                            'style' => 'width: 100%',
                            'placeholder' => trans('meeting.common.select_code'),
                        ]) }}
                    </div>


                    @if ($data->meeting_status_id != 5)
                        @if ($data->files != null)
                            <div class="form-group col-md-6">

                                <label for="image" class="{{ setFont() }}">
                                    {{ trans('meeting.final_verdict.file') }}
                                </label>
                                <br>
                                @php
                                    $fileNames = explode(',', $data->files);
                                @endphp
                                @foreach ($fileNames as $fileName)
                                    <a href="{{ URL::to('/storage/' . $filePath . '/' . $fileName) }}" target="_blank"
                                        class="btn btn-secondary btn-xs rounded-pill" data-placement="top"
                                        title="{{ trans('message.pages.common.viewFile') }}">
                                        <i class="fa fa-file"></i>
                                    </a>
                                    &nbsp;
                                    <a href="{{ URL::to('/storage/' . $filePath . '/' . $fileName) }}"
                                        class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" download
                                        data-toggle="tooltip" title="Download File">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    <br> <!-- Add line break between files -->
                                @endforeach
                            </div>
                        @else
                            N/A
                        @endif
                    @endif

                    <div class="form-group col-md-6">

                        <label for="image" class="{{ setFont() }}">
                            {{ trans('meeting.final_verdict.file') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        <input type="file" class="form-control-file profile-img"
                            accept=".jpg, .jpeg, .png, .pdf, .JPG, .JPEG, .PNG, .PDF" name="verdictFile">

                        @if ($errors->has('image') == null)
                            <span class="text text-danger {{ setFont() }}" style="font-size: 13px;color: #ff042c">
                                {{ trans('meeting.final_verdict.file_upload_message') }}
                            </span>
                        @endif
                    </div>

                    <!-- <div class="form-group col-md-12  {{ setFont() }}">
                            <label for="inputFeedback">
                                {{ trans('meeting.final_verdict.remarks') }}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {!! Form::textarea('feedback', Request::get('feedback'), [
                                'class' => 'form-control',
                                'placeholder' => trans('meeting.final_verdict.remarks'),
                                'rows' => '2',
                                'autocomplete' => 'off',
                                'required',
                            ]) !!}
                            {!! $errors->first('code', '<small class="text text-danger">:message</small>') !!}
                    </div> -->

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
