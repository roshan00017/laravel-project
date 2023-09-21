{!! Form::open(['method'=>'post',
    'route'=>$page_route. '.'.'store',
]) !!}

<div class="card-body {{setFont()}}">
<div class="form-group col-md-4  {{setFont()}}">
<label for="exampleInputEmail1">{{trans('chat.name') }}</label>
{!! Form::text('name',null,
    ['class'=>'form-control',
    'placeholder'=>trans('chat.name'),
    'autocomplete'=>'off',
    'required'
    ])
!!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}
</div>

<div class="form-group col-md-4  {{setFont()}}">
<label for="exampleInputEmail1">{{trans('chat.details') }}</label>
{!! Form::textarea('details',null,
    ['class'=>'form-control',
    'placeholder'=>trans('chat.group_description'),
    'autocomplete'=>'off',
    'rows'=>4,
    'required'
    ])
!!}
{!! $errors->first('name', '<small class="text text-danger">:message</small>') !!}

</div>


<button type="submit" class="btn btn-primary {{setFont()}}">{{trans('chat.create_group') }}</button>
{!! Form::close() !!}
</div>
