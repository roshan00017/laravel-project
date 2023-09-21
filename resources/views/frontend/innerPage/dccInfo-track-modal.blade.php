<div class="modal fade"
     id="tokenStatusTrack"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-body">
                {!! Form::open([
                 'method' => 'POST',
                 'autocomplete' => 'off',
             ]) !!}
                <div class="input__grid">
                    <div class="input span2">
                        <label class="required {{setFont()}}"
                               for="full-name">
                            {{ trans('dccFrontEnd.dcc.token') }}
                        </label>
                        <?php
                            // Retrieve the token number from the 'tokens' table based on your logic or query
                            $tokenNumber = App\Models\TokenManagement\Token::orderBy('id', 'desc')->value('token_no');
                          ?>
                            {!! Form::text('token_no', $tokenNumber, [
                            'autocomplete' => 'off',
                            'required'
                        ]) !!}

                        @if ($errors->has('name'))
                            <span class="text-danger {{setFont()}}">
                                    {{ $errors->first('name') }}
                                </span>
                        @endif
                    </div>

                    <div class="button__group span2">
                        <button 
                            class="submit__btn" 
                            data-toggle="modal"
                            data-target="#tokenStatus{{ $key }}" 
                            title="{{ trans('message.button.show') }}" 
                            data-dismiss="modal">
                           <span class="{{setFont()}}">
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
                        class="btn btn-secondary rounded-pill {{setFont()}}"
                        data-dismiss="modal"
                >
                    <i class="fa fa-times"></i>
                    {{trans('message.button.close')}}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
        
    </div>
</div>
