@php
    $name = setName()
@endphp

<div class="form-group col-md-4 {{setFont()}}">
    <label for="inputName">
        {{trans('message.pages.common.province_name')}}
        <span class="text text-danger">
                            *
        </span>
    </label>
    {{Form::select('per_province_code',
                    provinceList($data->per_province_code)->pluck('name','id'),
                    Request::get('per_province_code'),
                    ['class'=>'form-control select2',
                    'required',
                    'id'=>'per_province_code',
                    'style'=>'width: 100%;',
                    'placeholder'=> trans('message.pages.common.select_province_name')
                    ])
     }}
</div>


<div class="form-group col-md-4 {{setFont()}}">
    <label for="inputName">
        {{trans('message.pages.common.district_name')}}
        <span class="text text-danger">
                            *
        </span>
    </label>
    <select class='form-control select2 selected'
            name='per_district_code'
            required
            id="per_district_code"
            style="width: 100%"
    >
        <option class='form control'
                value=''

        >
            {{trans('message.pages.common.district_name')}}
        </option>

        @foreach(districtListByCode($data->per_province_code) as $val)
            <option value='{{ $val->code }}'
                    @if(isset($data->per_district_code)) @if($val->code == $data->per_district_code) selected @endif
            @else {{ old('district_code') == $data->per_district_code ? "selected" :""}} @endif
            >
                {{ $val->name }}
            </option>

        @endforeach
    </select>
</div>


<div class="form-group col-md-4 {{setFont()}}">
    <label for="inputName">
        {{trans('message.pages.common.local_body_name')}}
        <span class="text text-danger">
                            *
        </span>
    </label>
    <select class='form-control select2 selected'
            name='per_local_body_code'
            style="width: 100%"
            id="per_local_body_code"
            required
    >
        <option class='form control'
                value=''

        >
            {{trans('message.pages.common.local_body_name')}}
        </option>
        @foreach(localBodyListByCode($data->per_district_code) as $val)
            <option value='{{ $val->code }}'
                    @if(isset($data->local_body_code)) @if($val->code == $data->local_body_code) selected @endif
            @else {{ old('local_body_code') == $data->local_body_code ? "selected" :""}} @endif
            >
                {{ $val->name }}
            </option>

        @endforeach
    </select>
</div>


<div class="form-group col-md-4 {{setFont()}}">
    <label for="inputName">
        {{trans('ward.ward_no')}}
        <span class="text text-danger">
                            *
                            </span>
    </label>
    <select class='form-control select2 selected'
            name='per_ward_no'
            required
            id='per_ward_no'
            style="width: 100%"
    >
        <option class='form control'
                value=''

        >
            {{trans('ward.ward_no')}}
        </option>
        @foreach(getWardListByLocalBodyCode($data->per_local_body_code) as $val)
            <option value='{{$val}}'
                    @if(isset($data->per_ward_no)) @if($val == $data->per_ward_no) selected @endif @endif
            >
                {{ $val }}
            </option>

        @endforeach
    </select>
</div>

<div class="form-group col-md-4 {{setFont()}}">
    <label>
        {{ trans('common.street_name') }}
    </label>

    <label class="text text-danger">
        *
    </label>

    {!! Form::text('per_street_name',null,
            ['class'=>'form-control',
            'id'=>'per_street_name',
             'placeholder'=>trans('common.street_name'),
            'required'
            ])
    !!}
</div>
