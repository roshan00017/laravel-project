@php
    $name = setName();
@endphp
<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    @if(isset($data->school))
                        {{ getLan() =='en' ? $data->school->name_en : $data->school->name_np }}
                    @else
                        {{ getLan() =='en' ? 'System' : 'प्रणाली' }}
                    @endif
                        {{ trans('complaintSource.title') }}

                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                        {{trans('faq.question_en')}}
                        </label>
                        @if(isset($data->question))
                        <textarea class="form-control" rows="4" readonly>{{$data->question}}
                           </textarea>
                        @else
                            <input type="textarea"
                                   class="form-control"
                                   value="" 
                                   readonly
                            >

                        @endif
                    </div>


                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                        {{trans('faq.question_np')}}
                        </label>
                        @if(isset($data->question_ne))
                        <textarea class="form-control" rows="4" readonly>{{$data->question_ne}}
                           </textarea>
                        @else
                            <input type="textarea"
                                   class="form-control"
                                   value="" 
                                   readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                        {{trans('faq.answer_en')}}
                        </label>
                        @if(isset($data->answer))
                        <textarea class="form-control" rows="4" readonly>{{$data->answer}}
                           </textarea>
                        @else
                            <input type="textarea"
                                   class="form-control"
                                   value="" 
                                   readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="">
                        {{trans('faq.answer_np')}}
                        </label>
                        @if(isset($data->answer_ne))
                        <textarea class="form-control" rows="4" readonly>{{$data->answer_ne}}
                           </textarea>
                        @else
                            <input type="textarea"
                                   class="form-control"
                                   value="" 
                                   readonly
                            >

                        @endif
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{setFont()}}"
                            data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>    
        </div>
    </div>
</div>
