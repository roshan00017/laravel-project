@php
    $name = setName()
@endphp
<div class="form-group col-md-4 {{setFont()}}">
    <label for="">
        {{trans('message.pages.common.province_name')}}
    </label>
    @if(isset($data->perProvince))
        <input type="text"
               class="form-control"
               value="{{ $data->perProvince->$name }}"
               readonly
        >
    @else
        <input type="text"
               class="form-control"
               value="" readonly
        >

    @endif
</div>

<div class="form-group col-md-4 {{setFont()}}">
    <label for="">
        {{trans('message.pages.common.district_name')}}
    </label>
    @if(isset($data->perDistrict))
        <input type="text"
               class="form-control"
               value="{{ $data->perDistrict->$name }}"
               readonly
        >
    @else
        <input type="text"
               class="form-control"
               value="" readonly
        >

    @endif
</div>

<div class="form-group col-md-4 {{setFont()}}">
    <label for="">
        {{trans('message.pages.common.local_body_name')}}
    </label>
    @if(isset($data->perLocalBody))
        <input type="text"
               class="form-control"
               value="{{ $data->perLocalBody->$name }}"
               readonly
        >
    @else
        <input type="text"
               class="form-control"
               value="" readonly
        >

    @endif
</div>
<div class="form-group col-md-4 {{setFont()}}">
    <label for="">
        {{trans('ward.ward_no')}}
    </label>
    @if(isset($data->per_ward_no))
        <input type="text"
               class="form-control"
               value="{{ $data->per_ward_no }}"
               readonly
        >
    @else
        <input type="text"
               class="form-control"
               value="" readonly
        >

    @endif
</div>

<div class="form-group col-md-4 {{setFont()}}">
    <label for="">
        {{ trans('common.street_name') }}
    </label>
    @if(isset($data->per_street_name))
        <input type="text"
               class="form-control"
               value="{{ $data->per_street_name }}"
               readonly
        >
    @else
        <input type="text"
               class="form-control"
               value="" readonly
        >

    @endif
</div>