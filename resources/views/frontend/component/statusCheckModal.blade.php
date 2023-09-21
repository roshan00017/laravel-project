<div class="form__section-content ">
    <div class="modal fade" id="statusModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-body">
                {!! Form::open([
                    'method' => 'POST',
                    'route' => 'frontEnd.token-status-info',
                    'autocomplete' => 'off',
                ]) !!}
                <div class="input__grid">

                    <div class="input span2">
                        <label class="required {{ setFont() }}" for="full-name">
                            {{ trans('frontEndDashboard.token_type') }}
                        </label>
                        {!! Form::select('type', tokenType(), Request::get('type'), [
                          'class' => 'type-select'.' '.setFont(),
                          'required',
                          'placeholder' => trans('frontendSuggestion.complaintinfo.choose_any'),
                      ]) !!}
                    </div>
                    @if ($errors->has('type'))
                        <span class="text-danger {{ setFont() }}">
                                {{ $errors->first('type') }}
                            </span>
                    @endif
                    <div class="input span2">
                        <label class="required {{ setFont() }}" for="full-name">
                            {{ trans('frontendSuggestion.track_complaint.ticket_no') }}
                        </label>
                        {!! Form::text('token_no', Request::get('token_no'), [
                            'autocomplete' => 'off',
                            'required',
                        ]) !!}

                        @if ($errors->has('token_no'))
                            <span class="text-danger {{ setFont() }}">
                                {{ $errors->first('token_no') }}
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
                <button type="button"
                        class="btn btn-secondary rounded-pill {{ setFont() }}"
                        data-dismiss="modal"
                >
                    <i class="fa fa-times"></i>
                    {{ trans('message.button.close') }}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
</div>
