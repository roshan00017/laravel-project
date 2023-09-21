<div class="form__section-content ">
    <div class="modal fade"
         id="registerModal"
         data-keyboard="false"
         data-backdrop="static"
    >
        <div class="modal-dialog   modal-dialog-centered">
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
                            {!! Form::select('type', registerType(), Request::get('type'), [
                              'class' => 'type-select'.' '.setFont(),
                              'id'=>'type',
                              'placeholder' => trans('frontendSuggestion.complaintinfo.choose_any'),
                          ]) !!}
                        </div>

                    </div>
                    {!! Form::close() !!}
                    <div class=" justify-content-center">
                        <br>
                        <button type="button"
                                class="btn btn-secondary rounded-pill {{ setFont() }}"
                                data-dismiss="modal"
                        >
                            <i class="fa fa-times"></i>
                            {{ trans('message.button.close') }}
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>
