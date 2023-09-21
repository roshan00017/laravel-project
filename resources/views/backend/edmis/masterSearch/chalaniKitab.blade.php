{!! Form::open(['method'=>'get',
        'url'=>'masterSearch'])
!!}
<input type="hidden"
        name="filter_module"
        value="chalaniKitab"
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
    {{ trans('dispatch.dispatch_data.dispatch_no') }}

</label>
{!! Form::text('dispatch_no',null,
        ['class'=>'form-control',
        'placeholder'=>trans('dartaKitab.dc_register_book.invoice_no'),
        'autocomplete'=>'off',
        

        
        ])
!!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="form-group col-md-4 {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.dispatch_date_bs') }}
    
</label>
{!! Form::text('dispatch_date_bs', null, [
    'class'=>'form-control nepaliDatePicker',
    'placeholder' => trans('dispatch.dispatch_data.dispatch_date_bs'),
    'autocomplete' => 'off',
    'id'=>'ddate_from_bs',
    
]) !!}
{!! $errors->first('dispatch_date_bs', '<small class="text text-danger">:message</small>') !!}
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

    <div class="form-group col-md-4 {{setFont()}}">
    <label for="inputName">
        {{ trans('dispatch.dispatch_data.letter_no') }}
        
    </label>
    {!! Form::text('letter_no',  currentFy()->code, [
        'class' => 'form-control ',
        'placeholder' => trans('dispatch.dispatch_data.letter_no'),
        'autocomplete' => 'off',
        

    ]) !!}
    {!! $errors->first('letter_no', '<small class="text text-danger">:message</small>') !!}
    </div>




<div class="form-group col-md-4 {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.sent_medium') }}
    
</label>
{{Form::select('sent_medium_id',
    $letterSendingMediumList->pluck('name','id'),
    Request::get('meeting_category_id'),
    ['class'=>'form-control select2',
    'style'=>'width: 100%',
    'placeholder'=> trans('dispatch.dispatch_data.sent_medium')
    ]) }}
{!! $errors->first('sent_medium_id', '<small class="text text-danger">:message</small>') !!}
</div>


<div class="form-group col-md-4 {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.letter_date_bs') }}
    
</label>
{!! Form::text('letter_date_bs', null, [
    'class' => 'form-control nepaliDatePicker',
    'placeholder' => trans('dispatch.dispatch_data.letter_date_bs'),
    'autocomplete' => 'off',
    'id'=>'ddate_to_bs',
    
]) !!}
{!! $errors->first('letter_date_bs', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="form-group col-md-4 {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.letter_status') }}
    
</label>
{{Form::select('letter_status',
    $statusList->pluck('name','id'),
    Request::get('letter_status'),
    ['class'=>'form-control select2',
    'style'=>'width: 100%',
    'placeholder'=> trans('dispatch.dispatch_data.letter_status'),
    
    ]) }}
{!! $errors->first('letter_status', '<small class="text text-danger">:message</small>') !!}
</div>


<div class="form-group col-md-4 {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.file_type') }}
    
</label>
{{Form::select('file_type',
    $documentTypes->pluck('name','id'),
    Request::get('file_type'),
    ['class'=>'form-control select2',
    'style'=>'width: 100%',
    'placeholder'=> trans('dispatch.dispatch_data.file_type'),

]) }}
{!! $errors->first('file_type', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="form-group col-md-4  {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.from_branch_id') }}
    
</label>
{{Form::select('from_branch_id',
    $department->pluck('name','id'),
    Request::get('from_branch_id'),
    ['class'=>'form-control select2',
    'style'=>'width: 100%',
    'placeholder'=> trans('dispatch.dispatch_data.from_branch_id'),
    
    ]) }}
{!! $errors->first('from_branch_id', '<small class="text text-danger">:message</small>') !!}
</div>


<div class="form-group col-md-12">
<div style="clear: both;"></div>
<div style="float: left; margin-right: 10px;">
    {{ Form::radio('status', '1', false, ['class' => 'radio-button', 'style' => 'margin-top: 2px', 'id' => 'person-radio']) }}
    {{ Form::label('status', trans('dispatch.dispatch_data.person')) }}
</div>
<div style="clear: left;"></div>
<div style="float: left;">
    {{ Form::radio('status', '0', false, ['class' => 'radio-button', 'style' => 'margin-top: 2px', 'id' => 'office-radio']) }}
    {{ Form::label('status', trans('dispatch.dispatch_data.office')) }}
</div>
<div style="clear: both;"></div>
</div>

<div class="row col-md-12" id="person-details">
<div class="col-md-4 {{setFont()}}">
    <label for="inputName" class="{{setFont()}}">
        {{ trans('dispatch.dispatch_data.person_name') }}
        
    </label>
    {!! Form::text('contact_person', null, [
        'class' => 'form-control',
       
        'placeholder' => trans('dispatch.dispatch_data.person_name'),
        'autocomplete' => 'off',
        'requried',
    ]) !!}
    {!! $errors->first('person_name', '<small class="text text-danger">:message</small>') !!}
</div>
<div class="col-md-4 {{setFont()}}">
    <label for="inputName" class="{{setFont()}}">
        {{ trans('dispatch.dispatch_data.address') }}
        
    </label>
    {!! Form::text('contact_address', null, [
        'class' => 'form-control',
        'placeholder' => trans('dispatch.dispatch_data.address'),
        'autocomplete' => 'off',
        'requried',
    ]) !!}
    {!! $errors->first('contact_address', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="col-md-4 {{setFont()}}">
    <label for="inputName" class="{{setFont()}}">
        {{ trans('dispatch.dispatch_data.contact') }}
    </label>
    {!! Form::text('contact_no', null, [
        'class' => 'form-control',
        'id' => 'contact_number',
        'placeholder' => trans('dispatch.dispatch_data.contact'),
        'autocomplete' => 'off',
    ]) !!}
    {!! $errors->first('contact_no', '<small class="text text-danger">:message</small>') !!}
</div>

</div>


<div class="row col-md-12" id="office-details">



<div class="col-md-3 {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.to_office_name') }}
    
</label>
{!! Form::select('to_office_id', 
$office->pluck('name','id'),
    Request::get('to_office_id'), 
[
    'class' => 'form-control ',
    'placeholder' => trans('dispatch.dispatch_data.to_office_name'),
    'autocomplete' => 'off',
    'requried',
]) !!}
{!! $errors->first('to_office_id', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="col-md-3 {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.office_contact_person') }}
    
</label>
{!! Form::text('office_contact_person', null, [
    'class' => 'form-control',
    'placeholder' => trans('dispatch.dispatch_data.office_contact_person'),
    'autocomplete' => 'off',
    'requried',
]) !!}
{!! $errors->first('office_contact_person', '<small class="text text-danger">:message</small>') !!}
</div>
<div class="col-md-3 {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.office_address') }}
    
</label>
{!! Form::text('to_office_address', null, [
    'class' => 'form-control',
    'placeholder' => trans('dispatch.dispatch_data.office_address'),
    'autocomplete' => 'off',
    'requried',
]) !!}
{!! $errors->first('to_office_address', '<small class="text text-danger">:message</small>') !!}
</div>
<div class="col-md-3 {{setFont()}}">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.office_contact') }}

</label>
{!! Form::text('to_office_contact', null, [
    'class' => 'form-control',
    'placeholder' => trans('dispatch.dispatch_data.office_contact'),
    'autocomplete' => 'off',
    'id'=>'to_office_contact',
]) !!}
{!! $errors->first('to_office_contact', '<small class="text text-danger">:message</small>') !!}
</div>
</div>

&nbsp;
<div class="form-group col-md-12 {{ setFont() }}">
<p style="font-weight: bold; font-size: 17px; display: block;">
{{ trans('dispatch.dispatch_data.send_abroad') }}
<span class="text text-danger">*</span>
</p>
<div style="display: inline-block ; " class="col-md-6">
{{ Form::radio('send_abroad', '1', false, ['class' => 'radio-button', 'style' => 'margin-top: 2px', 'id' => 'status-thik']) }}
{{ Form::label('status-thik', trans('dispatch.dispatch_data.yes')) }}
</div>
<div style="display: inline-block ; " class="col-md-6">
{{ Form::radio('send_abroad', '0', true, ['class' => 'radio-button', 'style' => 'margin-top: 2px', 'id' => 'status-xaina']) }}
{{ Form::label('status-xaina', trans('dispatch.dispatch_data.no')) }}
</div>

<div class="form-group col-md-3 {{ setFont() }}" id="country-id-wrapper"
    style="display: none;">
<label for="inputName">
    {{ trans('dispatch.dispatch_data.country_id') }}
    
</label>
{!! Form::select('country_id',
    $country->pluck('name','id'),
    Request::get('country_id'),
    ['class' => 'form-control',
    'placeholder' => trans('dispatch.dispatch_data.country_id'),
    'autocomplete' => 'off',
]) !!}
{!! $errors->first('country_id', '<small class="text text-danger">:message</small>') !!}
</div>
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