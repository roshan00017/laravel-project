
{!! Form::open(['method'=>'get',
                                                'url'=>'masterSearch'])
                                        !!}
                                        <input type="hidden"
                                                 name="filter_module"
                                               value="document"
                                        >
                                        <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>
                                            {{trans('dartaKitab.dc_register_book.ward_No')}}
                                            </label>
                                            

                                            {!! Form::text('ward_no',null,
                                                        ['class'=>'form-control',])
                                            !!}
                                            {!! $errors->first('ward_no', '<span class="text text-danger">:message</span>') !!}
                                        </div>


                                        <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('dartaKitab.dc_register_book.Registration_no') }}

                                        </label>
                                        {!! Form::text('reg_id',null,
                                                ['class'=>'form-control',
                                                'placeholder'=>'',
                                                'autocomplete'=>'off',
                                                

                                                
                                                ])
                                        !!}
                                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('dartaKitab.dc_register_book.letter_receiving_person') }}
                                           
                                        </label>
                                        {{ Form::select('first_person_id', $employee_list->pluck('name','id'), Request::get('first_person_id'), [
                                            'class' => 'form-control select2',
                                        
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('dartaKitab.dc_register_book.letter_receiving_person'),
                                        ]) }}
                                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                    
                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('dartaKitab.dc_register_book.letter_status') }}

                                        </label>


                                        {{ Form::select('letter_status', $letter_status_list->pluck('name','id'), Request::get('letter_status'), [
                                            'class' => 'form-control select2',
                                        
                                            'style' => 'width: 100%',
                                            'placeholder' => trans('dartaKitab.dc_register_book.letter_status_select'),
                                        ]) }}
                                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                    </div>


                                    <div class="form-group col-md-4 {{ setFont() }}">
                                        <label for="inputName">
                                            {{ trans('dartaKitab.dc_register_book.letter_receiving_depart') }}
                                            
                                        </label>
                                        {{ Form::select('to_branch_id',
                                            $branch_list->pluck('name','id'),
                                            Request::get('to_branch_id'),
                                            ['class'=>'form-control select2',

                                            'style'=>'width: 100%',
                                            'placeholder'=>trans('dartaKitab.dc_register_book.letter_receiving_depart_select')
                                            ])
                                        }}
                                        {!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
                                    </div>

                                        </div>
                                        <div class="modal-footer justify-content-center {{setFont()}}">
                                        <button type="submit" id="btn-search" class="btn btn-info  rounded-pill">
                                            <i class="fa fa-search"></i>
                                            {{ trans('message.button.filter') }}
                                        </button>
                                        &nbsp;
                                        <button type="button" class="btn btn-secondary  rounded-pill" onclick="resetForm(event,$(this))";>
                                            <i class="fas  fa-sync-alt"></i>
                                            {{ trans('message.button.reset') }}
                                        </button>
                                </div>
                                
                                        
                                     

                                       
                                        {!! Form::close() !!}