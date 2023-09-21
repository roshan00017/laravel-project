@php
    $name = setName()
@endphp
<div class="form-group col-md-4 {{setFont()}}">
    <label for="">
        {{trans('message.pages.common.province_name')}}
    </label>
    @if(isset($data->temProvince))
        <input type="text"
               class="form-control"
               value="{{ $data->temProvince->$name }}"
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
    @if(isset($data->tempDistrict))
        <input type="text"
               class="form-control"
               value="{{ $data->tempDistrict->$name }}"
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
    @if(isset($data->tempLocalBody))
        <input type="text"
               class="form-control"
               value="{{ $data->tempLocalBody->$name }}"
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
    @if(isset($data->temp_ward_no))
        <input type="text"
               class="form-control"
               value="{{ $data->temp_ward_no }}"
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