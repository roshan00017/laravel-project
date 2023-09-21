<div class="modal fade" id="handoverModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('appointment.appointment_handover') }}
                    <span style="font-size: 14px;"> {{ trans('validation.pages.common.mandatory_field_message') }}
                    </span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'post',  'url' => 'appointmentHandover']) !!}
                <input type="hidden" name="appointment_id" value="{{@$appointment->id}}">
                <div class="row">

                @if(getLan() =='np')
                    <div class="form-group col-md-4  {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('appointment.visiting_date') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('handover_date_bs', Request::get('handover_date_bs'), [
                                                    'class' => 'form-control nepaliDatePicker',
                                                    'placeholder' => trans('appointment.visiting_date'),
                                                    'autocomplete' => 'off',
                                      'id' => 'date_bs',
                                'required',
                          ]) !!}
                          <input type="hidden" name='handover_date_ad' id="date_ad" >
                    </div>
                @endif

                @if(getLan() =='en')
                    <div class="form-group col-md-4  {{ setFont() }}">
                        <label for="inputName">
                            {{ trans('appointment.visiting_date') }}
                            <span class="text text-danger">
                                *
                            </span>
                        </label>
                        {!! Form::text('handover_date_ad', Request::get('handover_date_ad'), [
                                                    'class' => 'form-control englishDatePicker',
                                                    'placeholder' => trans('appointment.visiting_date'),
                                                    'autocomplete' => 'off',
                                      'id' => 'date_ad',
                                'required',
                          ]) !!}
                          <input type="hidden" name='handover_date_bs' id="date_bs" >
                    </div>
                @endif

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="inputName">
                            {{trans('appointment.visiting_time')}}

                        </label>
                        {{ Form::time('handover_time', Request::get('time'), [
                            'class' => 'form-control startTime',
                            'style' => 'width: 100%',
                            'placeholder' => trans('meeting.meeting.time'),
                        ]) }}
                    </div>
                    <div class="form-group col-md-4 {{ setFont() }}">

                        <label for="inputName">
                            {{trans('appointment.visiting_department')}}
                            <span class="text text-danger">
                                                        *
                                                    </span>
                        </label>
                        {!! Form::select(
                            'handover_section',
                            appointmentDepartment(),
                            Request::get('handover_section'),
                            [
                                'class' => 'form-control',
                                'style' => 'width: 100%;',
                                'id'=>'department',
                                'placeholder' => trans('appointment.select_visiting_department'),
                            ],
                        ) !!}
                    </div>

                    {{-- OFFICE_PERSON---HR-DESIGNATION --}}
                    <div class="form-group col-md-4 {{ setFont() }}"
                         style="@if (@$appointment->visiting_to_emp_designation != null && @$appointment->visiting_section == 'om') display: block @else display: none @endif"
                         id="postBlock_office">
                        <label for="inputName">
                            {{ trans('appointment.post') }}
                            <span class="text text-danger">
                                                    *
                                                </span>
                        </label>
                        {!! Form::select(
                            'visiting_to_emp_designation',
                            $hrDesignationList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                              Request::get('visiting_to_emp_designation'),
                            [
                                'class' => 'form-control select2',
                                'style' => 'width: 100%;',
                                'id' => 'employee_designation',
                                'placeholder' => trans('appointment.select_post'),
                            ],
                        ) !!}
                    </div>

                    {{-- ELECTED_PERSON --MEMBER_TYPE --}}
                    <div class="form-group col-md-4 {{ setFont() }}"
                         style="@if (@$appointment->visiting_to_elected_designation != null && @$appointment->visiting_section == 'km') display: block @else display: none @endif"
                         id="postBlock_elected">
                        <label for="inputName">
                            {{ trans('appointment.post') }}
                            <span class="text text-danger">
                                                    *
                                                </span>
                        </label>
                        {!! Form::select(
                            'visiting_to_elected_designation',
                            $memberTypeList->pluck(getLan() == 'np' ? 'name_np' : 'name_en', 'id'),
                          Request::get('visiting_to_elected_designation'),
                            [
                                'class' => 'form-control select2 post',
                                'id' => 'elected_designation',
                                'style' => 'width: 100%;',
                                'placeholder' => trans('appointment.select_post'),
                            ],
                        ) !!}
                    </div>


                    {{-- EMPLOYEE_LIST --}}
                    <div class="form-group col-md-4 {{ setFont() }}" id="employeeBlock"
                         style="@if (@$appointment->visiting_section == 'om' && @$appointment->employee_id != null) display :block @else display:none @endif">
                        <label for="inputName">
                            {{ trans('appointment.employee') }}
                            <span class="text text-danger">
                                                    *
                                                </span>
                        </label>
                        <select class='form-control select2 selected' name='employee_id'
                                id='employee_id' style="width: 100%" disabled>
                            <option class='form control' value=''>
                                {{ trans('appointment.select_employee') }}
                            </option>
                        </select>
                    </div>

                    {{-- ELECTED_PERSON_LIST --}}
                    <div class="form-group col-md-4 {{ setFont() }}" id="electedPersonBlock"
                         style="@if (@$appointment->visiting_section == 'km' && @$appointment->elected_person_id != null) display :block @else display:none @endif">
                        <label for="inputName">
                            {{ trans('appointment.elected_person') }}

                            <span class="text text-danger">
                                                    *
                                                </span>
                        </label>
                        <select class='form-control select2 selected' name='elected_person_id'
                                id='elected_person_id' style="width: 100%" disabled>
                            <option class='form control'
                                    value=''>
                                {{ trans('appointment.select_elected_person') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-12  {{setFont()}}">
                        <label for="inputFeedback">
                            {{trans('appointment.handover_reason')}}
                            <span class="text text-danger">
                                                         *
                                                     </span>
                        </label>
                        {!! Form::textarea('handover_reason',  null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('appointment.handover_reason'),
                                'rows'=>'4',
                                'autocomplete'=>'off',
                                ])
                        !!}
                        {!! $errors->first('description', '<small class="text text-danger">:message</small>') !!}
                    </div>

                </div>

                <div class="modal-footer justify-content-center {{ setFont() }}">

                    <button type="submit"
                            class="btn btn-primary  rounded-pill"
                            id="btn-add"
                    >
                        <i class="fa fa-save"></i>
                        {{trans('message.button.save')}}
                    </button>
                    &nbsp; &nbsp;
                    <button type="button"
                            class="btn btn-danger  rounded-pill"
                            data-dismiss="modal"
                    >
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
