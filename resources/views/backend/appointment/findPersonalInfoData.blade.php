{!! Form::open([
                                   'method' => 'post',
                                   'id' => 'addForm',
                                   'url' => 'personalInfo',
                               ]) !!}
<div class="row">
    <div class="form-group col-md-6 {{ setFont() }}">
        <label for="inputName">
            {{trans('appointment.full_name')}}
        </label>
        {!! Form::text('full_name',  @$personalData->full_name, [
            'class' => 'form-control',
            'required',
            'readonly',
        ]) !!}
    </div>

    <div class="form-group col-md-6 {{ setFont() }}">
        <label for="inputName">
            {{trans('appointment.email')}}
            <span class="text text-danger">
                                                        *
                                                    </span>
        </label>
        {!! Form::email('email',  @$personalData->email, [
            'class' => 'form-control',
            'placeholder' => trans('appointment.email'),
            'required',
            'readonly',
        ]) !!}
    </div>

    <div class="form-group col-md-6 {{ setFont() }}">
        <label for="inputName">
            {{trans('appointment.mobile_no')}}
            <span class="text text-danger">
                                                        *
                                                    </span>
        </label>
        {!! Form::text('mobile_no',  @$personalData->mobile_no, [
            'class' => 'form-control mobileNo',
            'placeholder' => trans('appointment.mobile_no'),
            'required',
            'readonly',
        ]) !!}
    </div>

    <div class="form-group col-md-6 {{ setFont() }}">
        <label for="inputName">
            {{trans('appointment.address')}}
            <span class="text text-danger">
                                                        *
                                                    </span>
        </label>
        {!! Form::text('address',  @$personalData->address, [
            'class' => 'form-control',
            'placeholder' => trans('appointment.address'),
            'required',
            'readonly',
        ]) !!}
    </div>


</div>
<a href="{{route('appointment.appointmentInfo')}}"
   class="btn btn-info rounded-pill float-left {{setFont()}}">
    <i class="fa fa-arrow-alt-circle-left"></i> {{trans('appointment.previous')}}
</a>
&nbsp;     &nbsp;
<button
        type="submit"
        class="btn btn-primary rounded-pill float-right {{setFont()}} "
        id="btn-add"
>

    {{ trans('appointment.next') }}
    <i class="fa fa-arrow-alt-circle-right"></i>
</button>
{!! Form::close() !!}