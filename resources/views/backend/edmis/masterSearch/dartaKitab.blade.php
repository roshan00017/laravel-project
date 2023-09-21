
{!! Form::open(['method'=>'get',
        'url'=>'masterSearch'])
!!}
<input type="hidden"
        name="filter_module"
        value="dartaKitab"
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
    {{ trans('dartaKitab.dc_register_book.invoice_no') }}

</label>
{!! Form::text('dispatch_no',null,
        ['class'=>'form-control',
        'placeholder'=>trans('dartaKitab.dc_register_book.invoice_no'),
        'autocomplete'=>'off',
        

        
        ])
!!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>


<div class="form-group col-md-4 {{ setFont() }}">

<label for="inputName">
    {{ trans('dartaKitab.dc_register_book.Date_of_Registration_np') }}
    
</label>
{!! Form::text('regd_date_bs',null,
        ['class'=>'form-control nepaliDatePicker',
        'placeholder'=>trans('dartaKitab.dc_register_book.Date_of_Registration_np'),
        'autocomplete'=>'off',
        'id'=>'date_from_bs',
        
        ])
!!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="form-group col-md-4 {{ setFont() }}">
<label for="inputName">
    {{ trans('dartaKitab.dc_register_book.letter_no') }}

</label>
{!! Form::text('letter_no',currentFy()->code,
        ['class'=>'form-control',
        'placeholder'=> trans('dartaKitab.dc_register_book.letter_no'),
        'autocomplete'=>'off',
        

        
        ])
!!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>
<div class="form-group col-md-4 {{ setFont() }}">
<label for="inputName">
    {{ trans('dartaKitab.dc_register_book.subject_of_the_letter') }}
    
</label>
{!! Form::text('letter_sub',null,
        ['class'=>'form-control',
        'placeholder'=>trans('dartaKitab.dc_register_book.subject_of_the_letter') ,
        'autocomplete'=>'off',
        
        ])
!!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="form-group col-md-4 {{ setFont() }}">
<label for="inputName">
    {{ trans('dartaKitab.dc_register_book.letter_date_ad') }}
    
</label>
{!! Form::text('letter_date_bs',null,
['class'=>'form-control nepaliDatePicker',
'placeholder'=>trans('dartaKitab.dc_register_book.letter_date_bs') ,
'autocomplete'=>'off',
'id'=>'date_to_bs',

])
!!}
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





<div class="form-group col-md-12 {{ setFont() }}">

<input class="radio-button" type="radio" name="is_person" checked value="1"
style="margin-top: 2px">
{{ trans('dartaKitab.dc_register_book.person_button') }}

<input class="radio-button" type="radio" name="is_person" value="0"
style="margin-top: 2px">
{{ trans('dartaKitab.dc_register_book.person_department') }}
</div>

<div class="form-group col-md-3 personForm {{ setFont() }}" id="personForm"
    style="display: block;">
<label for="inputName">
    {{ trans('dartaKitab.dc_register_book.person_name') }}
    
</label>
{!! Form::text('contact_person', null, [
    'class' => 'form-control',
    'placeholder' => trans('dartaKitab.dc_register_book.person_name'),
    'autocomplete' => 'off',
]) !!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="form-group col-md-3  personForm {{ setFont() }}" id="personForm"
    style="display:  block;">
<label for="inputName">
    {{ trans('dartaKitab.dc_register_book.address') }}
    
</label>
{!! Form::text('contact_address', null, [
    'class' => 'form-control',
    'placeholder' => trans('dartaKitab.dc_register_book.address'),
    'autocomplete' => 'off',
]) !!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="form-group col-md-4 personForm  {{ setFont() }}" id="personForm"
    style="display: block;">
<label for="inputName">
    {{ trans('dartaKitab.dc_register_book.contact_no') }}
    
</label>
{!! Form::text('contact_no', null, [
    'class' => 'form-control',
    'id'=>'contact_no',
    'placeholder' => trans('dartaKitab.dc_register_book.contact_no'),
    'autocomplete' => 'off',
]) !!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>

<!-- department -->

<div class="form-group col-md-4 departmentForm {{ setFont() }}"
    style="display: none;">
<label for="inputName">
    {{ trans('dartaKitab.dc_register_book.office_name') }}
    
</label>
{{ Form::select('from_off_id',
    $office_list->pluck('name','id'),
    Request::get('from_off_id'),
        ['class'=>'form-control select2',
    'style'=>'width: 100%',
    'placeholder'=> trans('dartaKitab.dc_register_book.office_name')
    ])
}}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>
<div class="form-group col-md-12 {{ setFont() }}">
<label>
    <span> {{ trans('dartaKitab.dc_register_book.foreign') }} </span>
</label>
</div>


<div class="form-group col-md-12 {{ setFont() }}">

<input class="radio-button" type="radio" name="is_foreign" value="1"
        style="margin-top: 2px">
{{ trans('dartaKitab.dc_register_book.yes') }}

<input class="radio-button" type="radio" name="is_foreign" checked
        value="0" style="margin-top: 2px">
{{ trans('dartaKitab.dc_register_book.no') }}
</div>


<div class="form-group col-md-4 CountryForm {{ setFont() }}"
    style="display: none;">
<label for="inputName">
    {{ trans('dartaKitab.dc_register_book.country') }}
    
</label>
{{ Form::select('country_id', $country_list->pluck('name','id'), Request::get('country_id'), [
    'class' => 'form-control select2',

    'style' => 'width: 100%',
    'placeholder' => trans('dartaKitab.dc_register_book.country'),
]) }}
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
