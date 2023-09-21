@php
    $name = setName()
@endphp

<div class="form-group col-md-4 {{setFont()}}" id="temp_province_code_block">
    <label for="inputName">
        {{trans('message.pages.common.province_name')}}
        <span class="text text-danger">
                            *
        </span>
    </label>
    {{Form::select('temp_province_code',
                    provinceList($value->temp_province_code)->pluck('name','id'),
                    Request::get('per_province_code'),
                    ['class'=>'form-control select2',
                    'required',
                    'id'=>'temp_province_code',
                    'style'=>'width: 100%;',
                    'placeholder'=> trans('message.pages.common.select_province_name')
                    ])
     }}
</div>
<div class="form-group col-md-4 {{setFont()}}" id="is_copy_temp_province_block" style="display: none">
    <label for=""> {{trans('message.pages.common.province_name')}} </label>
    <span class="required-field">
                            *
        </span>
    <input type="hidden" name="is_temp_copy_province_code" id="is_copy_province_code">
    <input type="text" class="form-control"  id="is_copy_province_name" readonly>
</div>



<div class="form-group col-md-4 {{setFont()}}" id="temp_district_code_block">
    <label for="inputName">
        {{trans('message.pages.common.district_name')}}
        <span class="text text-danger">
                            *
        </span>
    </label>
    <select class='form-control select2 selected'
            name='temp_district_code'
            required
            id="temp_district_code"
            style="width: 100%"
    >
        <option class='form control'
                value=''

        >
            {{trans('message.pages.common.district_name')}}
        </option>

        @foreach(districtListByCode($value->temp_province_code) as $val)
            <option value='{{ $val->code }}'
                    @if(isset($value->temp_district_code)) @if($val->code == $value->temp_district_code) selected @endif
            @else {{ old('district_code') == $value->temp_district_code ? "selected" :""}} @endif
            >
                {{ $val->name }}
            </option>

        @endforeach
    </select>
</div>
<div class="form-group col-md-4 {{setFont()}}" id="is_copy_temp_district_block" style="display: none">
    <label for="inputName">
        {{trans('message.pages.common.district_name')}}
        <span class="required-field">
                            *
        </span>
    </label>
    <input type="hidden" name="is_temp_copy_district_code" id="is_copy_district_code">
    <input type="text" class="form-control"  id="is_copy_district_name" readonly>
</div>



<div class="form-group col-md-4 {{setFont()}}" id="temp_local_body_code_block">
    <label for="inputName">
        {{trans('message.pages.common.local_body_name')}}
        <span class="text text-danger">
                            *
        </span>
    </label>
    <select class='form-control select2 selected'
            name='temp_local_body_code'
            style="width: 100%"
            id='temp_local_body_code'
            required
    >
        <option class='form control'
                value=''

        >
            {{trans('message.pages.common.local_body_name')}}
        </option>
        @foreach(localBodyListByCode($value->temp_district_code) as $val)
            <option value='{{ $val->code }}'
                    @if(isset($value->temp_local_body_code)) @if($val->code == $value->temp_local_body_code) selected @endif
            @else {{ old('temp_local_body_code') == $value->temp_local_body_code ? "selected" :""}} @endif
            >
                {{ $val->name }}
            </option>

        @endforeach
    </select>
</div>

<div class="form-group col-md-4 {{setFont()}}" id="is_copy_temp_local_body_block" style="display: none">
    <label for="">  {{trans('message.pages.common.local_body_name')}} </label>
    <span class="required-field">
                            *
        </span>
    <input type="hidden" name="is_temp_copy_local_body_code" id="is_copy_local_body_code">
    <input type="text" class="form-control"  id="is_copy_local_body_name" readonly>
</div>


<div class="form-group col-md-4 {{setFont()}}" id="temp_ward_no_block">
    <label for="inputName">
        {{trans('ward.ward_no')}}
        <span class="text text-danger">
                            *
                            </span>
    </label>
    <select class='form-control select2 selected'
            name='temp_ward_no'
            id="temp_ward_no"
            required
            style="width: 100%"
    >
        <option class='form control'
                value=''

        >
            {{trans('ward.ward_no')}}
        </option>
        @foreach(getWardListByLocalBodyCode($value->temp_local_body_code) as $val)
            <option value='{{$val}}'
                    @if(isset($value->temp_ward_no)) @if($val == $value->temp_ward_no) selected @endif @endif
            >
                {{ $val }}
            </option>

        @endforeach
    </select>
</div>

<div class="form-group col-md-4 {{setFont()}}" id="is_copy_temp_ward_no_block" style="display: none">
    <label for="">
        {{trans('ward.ward_no')}}
        <span class="required-field">
                            *
                            </span>
    </label>
    <input type="text" class="form-control" name="is_copy_temp_ward_no" id="is_copy_temp_ward_no">
</div>

<div class="form-group col-md-4 {{setFont()}}" id="temp_street_name_block">
    <label>
        {{ trans('common.street_name') }}
    </label>

    <label class="required-field">
        *
    </label>

    {!! Form::text('temp_street_name',null,
            ['class'=>'form-control',
            'id'=>'temp_street_name',
             'placeholder'=>trans('common.street_name'),
            'required'
            ])
    !!}
</div>