<div class="input span2">
    <p class="text-danger {{ setFont() }}">
        {{ trans('appointment.personal_info_note') }}
        :&nbsp;{{ trans('appointment.personal_info_filter_message') }}
    </p>
</div>
<div class="input">
    {!! Form::text('mobile_num', $request->mobile_no, [
        'class' => 'mobileNo' . ' ' . setFont(),
        'id'=>'mobile_no',
        'autocomplete' => 'off',
        'placeholder' => trans('appointment.mobile_no'),
    ]) !!}
</div>


<div class="input">
    {!! Form::email('email_add', $request->email, [
        'autocomplete' => 'off',
        'class' => 'email' . ' ' . setFont(),
        'placeholder' => trans('appointment.email'),
    ]) !!}
</div>
