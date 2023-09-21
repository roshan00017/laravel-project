<div class="modal fade" id="branchModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.add')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                'id'=>'addForm',
                'url'=>'dcDocument',
                'enctype'=>'multipart/form-data',
                'autocomplete'=>'off'])
                !!}
                <input type="hidden" name="document_no" value="{{$dcRegisterBook->regd_no}}">
                <input type="hidden" name="from_section_id" value="{{$dcRegisterBook->to_branch_id}}">
                <div class="row">
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('dartaKitab.dc_register_book.letter_receiving_depart') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::select('to_section_id',
                                            $branch_list->pluck('name','id'),
                                            Request::get('to_section_id'),
                                            ['class'=>'form-control select2',

                                            'style'=>'width: 100%',
                                            'placeholder'=>trans('dartaKitab.dc_register_book.letter_receiving_depart_select'),
                                            'required'
                                            ])
                                        }}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('dartaKitab.dc_register_book.letter_receiving_person') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {{ Form::select('employee_id', $employee_list->pluck('name','id'), Request::get('employee_id'), [
                                            'class' => 'form-control select2',
                                        
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('dartaKitab.dc_register_book.letter_receiving_person'),
                                            'required'
                                        ]) }}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('dartaKitab.dc_register_book.letter_status') }}

                        </label>
                        {{ Form::select('document_type_id', $letter_status_list->pluck('name','id'), Request::get('document_type_id'), [
                                            'class' => 'form-control select2',
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('dartaKitab.dc_register_book.letter_status_select'),'required'
                                        ]) }}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                    </div>
                    <div class="form-group col-md-12 ">
                        <br>
                        <label for="inputName">
                            <span class="{{ setFont() }}">
                                {{ trans('dartaKitab.dc_register_book.comment') }} </span>
                        </label>

                    </div>
                    <div class="form-group col-md-12 {{ setFont() }}">

                        {!! Form::textarea('remarks', null, [
                        'class' => 'form-control',
                        'rows'=>4,
                        'placeholder' => trans('dartaKitab.dc_register_book.comment'),
                        'autocomplete' => 'off',
                        ]) !!}
                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}

                    </div>
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