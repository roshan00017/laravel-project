<div class="modal fade" id="statusModal{{ $key }}" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    @if (systemSetting())
                        {{ getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
                    @else
                        {{ trans('message.pages.common.app_short_name') }}
                    @endif
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([
                'method' => 'POST',
                'class' => 'inline',
                'id' => 'statusUpdate',
                'url' => [$page_url . '/' . 'status/' . $data->id],
            ]) !!}

            <div class="modal-body">
                <div class="row">

                    @if ($data->status == 1)
                        <input type="hidden" name="status" value="2">
                        <h5 class="{{ setFont() }}">
                            {{ trans('complaints.are_you_sure_you_want_to_change') }}
                        </h5>
                    @elseif ($data->status == 2 || $data->status == 3 || $data->status == 6)
                        <div class="form-group col-md-12 {{ setFont() }}">

                            <label for="inputName">
                                {{ trans('complaints.grievance_status') }}
                                <span class="text text-danger">
                                    *
                                </span>
                            </label>
                            {{ Form::select('status', $complaintRepo->statusListByComplaint(), Request::get('status'), [
                                'class' => 'form-control select2 complaint_status ',
                                'style' => 'width: 100%',
                                'required',
                                'placeholder' => trans('complaints.select_status'),
                            ]) }}

                            <br>
                            <div class="form-group col-md-12 detailsBlock" style="display: none">
                                <label for="inputName" class="{{ setFont() }}">
                                    {{ trans('complaints.progress_information') }}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::textarea('description', null, [
                                    'class' => 'form-control details',
                                    'autocomplete' => 'off',
                                
                                    'rows' => '4',
                                ]) !!}
                                {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                            </div>

                            <div class="form-group col-md-12 officeBlock" style="display: none">
                                <label for="inputName" class="{{ setFont() }}">
                                    {{ trans('complaints.responding_office') }}
                                    <span class="text text-danger">
                                        *
                                    </span>
                                </label>
                                {!! Form::text('responding_office office', null, [
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                ]) !!}
                            </div>
                        </div>
                    @elseif ($data->status == 8)
                        <input type="hidden" name="status" value="8">
                        <h5 class="{{ setFont() }}">
                            {{ trans('complaints.are_you_sure_you_want_to_change') }}
                        </h5>
                    @endif
                </div>

            </div>
            <div class="modal-footer justify-content-center {{ setFont() }}">
                <button type="submit" class="btn btn-primary rounded-pill">
                    <i class="fa fa-check-circle"></i>
                    {{ trans('message.button.yes') }}
                </button> &nbsp; &nbsp;
                <button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal">
                    <i class="fa fa-times-circle"></i>
                    {{ trans('message.button.no') }}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
