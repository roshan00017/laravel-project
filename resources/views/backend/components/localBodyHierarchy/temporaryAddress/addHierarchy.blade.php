<div class="form-group col-md-4 {{setFont()}}" id="temp_province_code_block">
    <label for="inputName">
        {{trans('message.pages.common.province_name')}}
        <span class="required-field">
                            *
        </span>
    </label>
    {{Form::select('temp_province_code',
                    provinceList()->pluck('name','id'),
                    Request::get('temp_province_code'),
                    ['class'=>'form-control select2',
                    'id'=>'temp_province_code',
                    'required',
                    'style'=>'width: 100%; border-radius:1rem',
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
        <span class="required-field">
                            *
        </span>
    </label>
    <select class='form-control select2 selected'
            name='temp_district_code'
            id='temp_district_code'
            required
            style="width: 100%"
            disabled
    >
        <option class='form control'
                value=''

        >
            {{trans('message.pages.common.district_name')}}
        </option>
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
        <span class="required-field">
                            *
        </span>
    </label>
    <select class='form-control select2 selected'
            name='temp_local_body_code'
            id='temp_local_body_code'
            style="width: 100%"
            disabled
            required
    >
        <option class='form control'
                value=''

        >
            {{trans('message.pages.common.local_body_name')}}
        </option>
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
        {{trans('common.ward_no')}}
        <span class="required-field">
                            *
                            </span>
    </label>
    <select class='form-control select2 selected'
            name='temp_ward_no'
            id='temp_ward_no'
            required
            disabled
            style="width: 100%"
    >
        <option class='form control'
                value=''

        >
            {{trans('common.ward_no')}}
        </option>
    </select>
</div>
<div class="form-group col-md-4 {{setFont()}}" id="is_copy_temp_ward_no_block" style="display: none">
    <label for="">
        {{trans('common.ward_no')}}
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