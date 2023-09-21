<div class="modal fade" id="showModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ getLan() == 'en' ? $data->full_name : $data->full_name_np }}
                    {{ getLan() == 'np' ? 'कर्मचारी' : 'Employee' }} {{ trans('message.pages.roles.details') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('message.pages.common.code') }}
                        </label>
                        @if (isset($data->code))
                        <input type="text" class="form-control" value="{{ $data->code }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.name') }} [{{ trans('employee.nepali') }}]
                        </label>
                        @if (isset($data->first_name_np))
                        <input type="text" class="form-control" value="{{ $data->first_name_np }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.middle_name') }} [{{ trans('employee.nepali') }}]
                        </label>
                        @if (isset($data->middle_name_np))
                        <input type="text" class="form-control" value="{{ $data->middle_name_np }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.last_name') }} [{{ trans('employee.nepali') }}]
                        </label>
                        @if (isset($data->last_name_np))
                        <input type="text" class="form-control" value="{{ $data->last_name_np }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.name') }} [{{ trans('employee.english') }}]
                        </label>
                        @if (isset($data->first_name_en))
                        <input type="text" class="form-control" value="{{ $data->first_name_en }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.middle_name') }}[{{ trans('employee.english') }}]
                        </label>
                        @if (isset($data->middle_name_en))
                        <input type="text" class="form-control" value="{{ $data->middle_name_en }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.last_name') }}[{{ trans('employee.english') }}]
                        </label>
                        @if (isset($data->last_name_en))
                        <input type="text" class="form-control" value="{{ $data->last_name_en }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    @if(getLan()== 'np' )
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.date_of_birth_bs') }}
                        </label>
                        @if (isset($data->dob_bs))
                        <input type="text" class="form-control" value="{{ $data->dob_bs }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>
                    @endif

                    @if(getLan()=="en")
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.date_of_birth_ad') }}
                        </label>
                        @if (isset($data->dob_ad))
                        <input type="text" class="form-control" value="{{ $data->dob_ad }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>
                    @endif

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.phone') }}
                        </label>
                        @if (isset($data->phone_number))
                        <input type="text" class="form-control" value="{{ $data->phone_number }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.email') }}
                        </label>
                        @if (isset($data->email))
                        <input type="text" class="form-control" value="{{ $data->email }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.ward') }}
                        </label>
                        @if (isset($data->ward_no))
                        <input type="text" class="form-control" value="{{ $data->ward_no }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('employee.current_branch') }}
                        </label>
                        @if (isset($data->branch_id))
                        <input type="text" class="form-control" value="{{ $data->branch_id }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{ setFont() }}" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{ trans('message.button.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>