<div class="modal fade"
     id="addModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.add')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true"
                          data-toggle="tooltip"
                          title="Close"
                    >   &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                               'id'=>'addForm',
                              'url'=>$page_url
                              ])
                      !!}
                <div class="row">
                   

                <div class="form-group col-md-12  {{setFont()}}">
                        <label for="inputName">
                            {{trans('faq.question_en')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::textarea('question',Request::get('question'),
                                ['class'=>'form-control',
                                'placeholder'=>trans('faq.question_en'),
                                'rows'=>4,
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('question', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    

                    <div class="form-group col-md-12  {{setFont()}}">
                        <label for="inputFeedback">
                        {{trans('faq.question_np')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::textarea('question_ne',Request::get('question_ne'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('faq.question_np'),
                                'rows'=>'4',
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('question_ne', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-12  {{setFont()}}">
                        <label for="inputFeedback">
                        {{trans('faq.answer_en')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::textarea('answer',Request::get('answer'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('faq.answer_en'),
                                'rows'=>'4',
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('answer', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-12  {{setFont()}}">
                        <label for="inputFeedback">
                        {{trans('faq.answer_np')}}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::textarea('answer_ne',Request::get('answer_ne'),
                                ['class'=>'form-control',   
                                'placeholder'=>trans('faq.answer_np'),
                                'rows'=>'4',
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('answer_ne', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    @include('backend.components.commonAddStatus')
                        </div>


                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.addAction')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
                            