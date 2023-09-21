<div class="form-group col-md-4 {{ setFont() }}">
    <label for="inputName">
        {{ trans('message.pages.common.province_name') }}
        <span class="text text-danger">
            *
        </span>
    </label>
    {{ Form::select('per_province_code', provinceList()->pluck('name', 'id'), Request::get('per_province_code'), [
        'class' => 'form-control select2',
        'id' => 'province_code',
        'required',
        'style' => 'width: 100%; border-radius:1rem',
        'placeholder' => trans('message.pages.common.select_province_name'),
    ]) }}
</div>


<div class="form-group col-md-4 {{ setFont() }}">
    <label for="inputName">
        {{ trans('message.pages.common.district_name') }}
        <span class="text text-danger">
            *
        </span>
    </label>
    <select class='form-control select2 selected' name='per_district_code' id='district_code' required style="width: 100%"
        disabled>
        <option class='form control' value=''>
            {{ trans('message.pages.common.district_name') }}
        </option>
    </select>
</div>


<div class="form-group col-md-4 {{ setFont() }}">
    <label for="inputName">
        {{ trans('message.pages.common.local_body_name') }}
        <span class="text text-danger">
            *
        </span>
    </label>
    <select class='form-control select2 selected' name='per_local_body_code' id='local_body_code' style="width: 100%"
        disabled required>
        <option class='form control' value=''>
            {{ trans('message.pages.common.local_body_name') }}
        </option>
    </select>
</div>
<div class="form-group col-md-4 {{ setFont() }}">
    <label for="inputName">
        {{ trans('ward.ward_no') }}
        <span class="text text-danger">
            *
        </span>
    </label>
    <select class='form-control select2 selected' name='per_ward_no' id='ward_no' required disabled
        style="width: 100%">
        <option class='form control' value=''>
            {{ trans('ward.ward_no') }}
        </option>
    </select>
</div>

<div class="form-group col-md-4 {{ setFont() }}">
    <label>
        {{ trans('common.street_name') }}
    </label>

    <label class="text text-danger">
        *
    </label>

    {!! Form::text('per_street_name', null, [
        'class' => 'form-control',
        'id' => 'per_street_name',
        'placeholder' => trans('common.street_name'),
        'required',
    ]) !!}
</div>
