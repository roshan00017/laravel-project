<div class="modal fade" id="appointStatusTrack" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'POST',
                    'url' => 'appointment-status',
                    'autocomplete' => 'off',
                ]) !!}
                <div class="input__grid">
                    <div class="input span2">
                        <label class="required {{ setFont() }}" for="full-name">
                            {{ trans('frontendSuggestion.track_complaint.ticket_no') }}
                        </label>
                        {!! Form::text('appointment_no', Request::get('appointment_no'), [
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}

                        @if ($errors->has('name'))
                            <span class="text-danger {{ setFont() }}">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>

                    <div class="button__group span2">
                        <button type="submit" class="submit__btn rounded-pill">
                            <span class="{{ setFont() }}">
                                {{ trans('frontendSuggestion.suggestion.sent_file') }}
                                <i class="fa-solid fa-paper-plane"></i>
                            </span>
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary rounded-pill {{ setFont() }}" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    {{ trans('message.button.close') }}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
