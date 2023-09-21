<div class="modal fade"
     id="editModal{{$key}}"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.edit')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::model($data,['method'=>'PUT',
                        'route'=>['faqs.update',$data->id],
                        'enctype'=>'multipart/form-data',
                        'autocomplete'=>'off'])
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

                    @include('backend.components.commonEditStatus')
                </div>

                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.updateAction')
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>
