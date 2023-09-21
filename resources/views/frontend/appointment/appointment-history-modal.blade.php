<div class="modal fade" id="appointHistoryTrack" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius ">
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'POST',
                    'url' => 'appointment-history',
                    'autocomplete' => 'off',
                ]) !!}
                <div class="input__grid">
                    <div class="input span2">
                        <label class="{{ setFont() }}">
                            {{ trans('appointment.mobile_no') }}
                        </label>
                        {!! Form::text('mobile_no', Request::get('mobile_no'), [
                            'class' => 'mobileNo',
                            'autocomplete' => 'off',
                        ]) !!}

                        @if ($errors->has('mobile_no'))
                            <span class="text-danger {{ setFont() }}">
                                {{ $errors->first('mobile_no') }}
                            </span>
                        @endif
                    </div>

                    <div class="input span2">
                        <label class="{{ setFont() }}">
                            {{ trans('appointment.email') }}
                        </label>
                        {!! Form::text('email', Request::get('email'), [
                            'autocomplete' => 'off',
                        ]) !!}

                        @if ($errors->has('email'))
                            <span class="text-danger {{ setFont() }}">
                                {{ $errors->first('email') }}
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
