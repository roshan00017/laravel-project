<div class="form-group col-md-4">
    {!!Form::text('from_date',
               Request::get('from_date'),
               ['class'=>'form-control' .' ' .setDatePicker()['dateClass'],
               'id'=>setDatePicker()['from_date'],
               'autocomplete'=>'off',
               'width'=>'100%','placeholder'=> trans('message.commons.from_date')])
       !!}
</div>

<div class="form-group col-md-4">
    {!!Form::text('to_date',
          Request::get('to_date'),['class'=>'form-control' .' ' .setDatePicker()['dateClass'],
          'id'=>setDatePicker()['to_date'],
          'autocomplete'=>'off',
          'width'=>'100%','placeholder' =>trans('message.commons.to_date')])
  !!}
</div>